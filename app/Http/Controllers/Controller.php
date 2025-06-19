<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function response($data, $status = 200)
    {
        $data = [
            'data' => $data,
        ];
        return response()->json($data, $status);
    }

    public function error($message, $status = 400, $data = [])
    {
        $data = [
            'success' => false,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($data, $status);
    }

    public function success($message, $status = 200, $data = [])
    {
        $data = [
            'success' => true,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($data, $status);
    }
}
