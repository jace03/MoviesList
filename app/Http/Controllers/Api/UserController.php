<?php

namespace App\Http\Controllers\Api;

use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): JsonResponse
    {
        $users = $this->userRepository->findAll();
        return response()->json($users);
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = new User();
        $user->setName($request->name);
        $user->setEmail($request->email);
        $user->setPassword($request->password);

        $this->userRepository->save($user);

        return response()->json($user, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'string|min:6',
        ]);

        if ($request->has('name')) {
            $user->setName($request->name);
        }
        if ($request->has('email')) {
            $user->setEmail($request->email);
        }
        if ($request->has('password')) {
            $user->setPassword($request->password);
        }

        $this->userRepository->save($user);

        return response()->json($user);
    }

    public function destroy(int $id): JsonResponse
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $this->userRepository->delete($user);

        return response()->json(null, 204);
    }
}
