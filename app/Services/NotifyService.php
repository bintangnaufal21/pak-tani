<?php

namespace App\Services;

use App\Models\Notification;

class NotifyService
{
    /**
     * Create a notification for a user.
     *
     * @param  int    $userId
     * @param  string $type
     * @param  array  $data
     * @return \App\Models\Notification
     */
    public static function notify(int $userId, string $type, array $data = [])
    {
        return Notification::create([
            'user_id' => $userId,
            'type'    => $type,
            'data'    => $data,
        ]);
    }
}
