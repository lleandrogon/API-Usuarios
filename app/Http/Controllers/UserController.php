<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function index(Request $request) {
        $validated = $request->validate([
            'page'      => 'sometimes|integer|min:1',
            'page_size' => 'sometimes|integer|min:1|max:50',
            'q'         => 'sometimes|string',
            'role'      => 'sometimes|string',
            'is_active' => 'sometimes|string',
        ]);

        $result = $this->userService->getUsers($validated);

        return response()->json($result, 200);
    }

    public function show(int $id) {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json([
                'error' => 'Usuário não encontrado'
            ], 404);
        }

        return response()->json($user, 200);
    }
}
