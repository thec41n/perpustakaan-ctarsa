<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        // Hanya user dengan role 'admin' yang bisa membuat kategori
        return $user->role === 'admin';
    }

    public function update(User $user, Category $category)
    {
        // Hanya user dengan role 'admin' yang bisa mengupdate kategori
        return $user->role === 'admin';
    }

    public function delete(User $user, Category $category)
    {
        // Hanya user dengan role 'admin' yang bisa menghapus kategori
        return $user->role === 'admin';
    }
}
