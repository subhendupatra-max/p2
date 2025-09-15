<?php

namespace App\Traits;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

/**
 * Trait FlashMessages
 * @package App\Traits
 */

trait NotificationTrait
{
    public function saveNotification($data)
    {
        try {
            $notificationSave = Notification::create($data);
            return $notificationSave;
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
    }

    public function getAllNotifications()
    {
        try {
            $allNotification = Notification::where('user_id', Auth::user()->id)->latest()->get();
            if ($allNotification) {
                return $allNotification;
            } else {
                return array();
            }
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
    }

    public function countUnReadNotification()
    {
        try {
            $allNotificationCount = Notification::where(['user_id' => Auth::user()->id, 'is_read' => 0])->count();
            if ($allNotificationCount) {
                return $allNotificationCount;
            } else {
                return 0;
            }
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
    }
}
