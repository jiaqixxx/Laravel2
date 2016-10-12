<?php
namespace App\Repositories;

use App\User;
use App\Fileentry;
use PhpParser\Node\Scalar\MagicConst\File;

class FileRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function GetFile(User $user)
    {
        return Fileentry::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
