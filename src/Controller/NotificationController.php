<?php

namespace App\Controller;

use Pimcore\Model\Notification\Service\NotificationService;

class NotificationController
{
    public function sendNotification(NotificationService $notificationService, $className)
    {
        //$element = Asset::getById(1); // Optional

        $notificationService->sendToUser(
            18, // User recipient
            14, // User sender 0 - system
            'Object created of '.$className,
            'object created using csv'
            //$element // Optional linked element
        );
    }
}