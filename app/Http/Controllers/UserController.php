<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\UserRole;
use App\UserRoleEnum;

use App\Http\Requests\NewUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Validation\Rules\Enum;

class UserController extends Controller
{
    public function me(Request $request)
    {
        return $this->response(data: $request->user()->toResource());
    }

    public function newUser(NewUserRequest $request)
    {
        $data = $request->validated();

        $clientRoleId = UserRole::where('code', UserRoleEnum::CLIENT->value)->value('id');

        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'role_id' => 3,
        ]);

        return $this->success(message: 'User created successfully', status: 201, data: $user->toResource());
    }   

    public function setRole(Request $request)
    {
        $admin = $request->user();
        if ($admin->role->code !== UserRoleEnum::ADMIN->value) {
            abort(403, 'You are not authorized to assign roles.');
        }

        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role'    => ['required', new Enum(UserRoleEnum::class)],
        ]);

        $user = User::findOrFail($data['user_id']);
        $role = UserRole::where('code', $data['role'])->first();

        if (!$role) {
            return $this->error('Invalid role code', 422);
        }

        $user->update(['role_id' => $role->id]);

        return $this->success(message: 'Role assigned successfully');
    }

    public function login(LoginUserRequest $request)
    {
        $data = $request->validated();

        $user = User::where('phone', $data['phone'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'phone' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success(message: 'Login successful', status: 200, data: ["token" => $token]);
    }

    public function update(Request $request)
    {
        $request->user()->update($request->only('name'));

        return $this->success(message: 'User updated successfully', status: 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success(message: 'Logged out successfully', status: 200);
    }
}
