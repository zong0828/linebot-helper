<?php

namespace App\Service\Repository;

use App\Service\Repository\Model\User;
use Illuminate\Support\Collection;
use Log;

/**
 * db basic CRUD method
 */
class UserRepository
{
    /**
     * get user profile
     *
     * @param string $userId
     *
     * @return void
     */
    public static function get($lineId)
    {
        if (empty($lineId)) {
            return [];
        }

        $user = User::where('line_id', $lineId)->first();

        return empty($user) ? [] : $user->toArray();
    }

    public static function create($userProfile)
    {
        if (empty($userProfile)) {
            Log::info('缺少必要欄位');
            throw new \Excetption('缺少必要欄位');
        }

        return User::create($userProfile);
    }
}
