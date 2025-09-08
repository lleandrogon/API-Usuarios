<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use Illuminate\Support\Facades\File;

class UserRepository implements UserInterface
{
    private string $path;

    public function __construct() {
        $this->path = storage_path('app/mock-users.json');
    }

    private function readJson(): array {
        if (!File::exists($this->path)) {
            return [];
        }

        $json = File::get($this->path);
        $data = json_decode($json, true);

        return is_array($data) ? $data : [];
    }

    public function getUsers(): array {
        return $this->readJson();
    }

    public function getUserById(int $id): ?array {
        $users = $this->readJson();
        foreach ($users as $user) {
            if ($user['id'] === $id) {
                return $user;
            }
        }

        return null;
    }
}
