<?php

namespace App\Services;

use App\Interfaces\UserInterface;
use Illuminate\Support\Str;

class UserService
{
    private UserInterface $userInterface;

    public function __construct(UserInterface $userInterface) {
        $this->userInterface = $userInterface;
    }

    public function getUsers(array $params): array {
        $users = collect($this->userInterface->getUsers());

        if (!empty($params['q'])) {
            $q = Str::lower($params['q']);
            $users = $users->filter(function ($user) use ($q) {
                return str_contains(Str::lower($user['name']), $q) || str_contains(Str::lower($user['email']), $q);
            });
        }

        if (!empty($params['role'])) {
            $users = $users->where('role', $params['role']);
        }

        if (isset($params['is_active'])) {
            $isActive = filter_var($params['is_active'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if (!is_null($isActive)) {
                $users = $users->where('is_active', $isActive);
            }
        }

        $page = max(1, (int)($params['page'] ?? 1));
        $pageSize = (int)($params['page_size'] ?? 10);
        if ($pageSize > 50) {
            $pageSize = 50;
        }

        $total = $users->count();
        $offset = ($page - 1) * $pageSize;
        $data = $users->slice($offset, $pageSize)->values()->all();

        return [
            'data' => $data,
            'pagination' => [
                'page' => $page,
                'page_size' => $pageSize,
                'total' => $total,
                'total_pages'=> (int) ceil($total / $pageSize),
            ]
        ];
    }

    public function getUserById(int $id): ?array {
        return $this->userInterface->getUserById($id);
    }
}
