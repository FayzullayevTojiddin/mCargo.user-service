<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserInternalController extends Controller
{
    public function show($id): JsonResponse
    {
        $user = User::findOrFail($id);

        if(! $user) {
            return $this->error(message: 'User not found', status: 400);
        }

        return $this->response(data: $user->toResource(), status: 200);
    }

    public function bulkShow(Request $request): JsonResponse
    {
        $ids = $request->input('ids');
        if (!is_array($ids) || empty($ids)) {
            return $this->error(message: 'Invalid or empty ids array', status: 422);
        }
        $users = User::select()->whereIn('id', $ids)->get();
        return $this->response(data: UserResource::collection($users), status: 200);
    }
}
