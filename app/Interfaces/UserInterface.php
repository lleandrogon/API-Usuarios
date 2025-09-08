<?php

namespace App\Interfaces;

interface UserInterface
{
    public function getUsers(): array;

    public function getUserById(int $id): ?array;
}
