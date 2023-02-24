<?php

namespace App\EventListener;

use Google\Service\DisplayVideo\ManualTrigger;
use Pimcore\Model\DataObject\Category;
use Pimcore\Model\DataObject\Grocery;
use App\Controller\NotificationController;
use Pimcore\Model\DataObject\Manufacturer;
use Pimcore\Model\DataObject\Seller;
use Pimcore\Model\Notification\Service\NotificationService;
use Pimcore\Model\Notification\Service;	

class EventListener
{

    public function notificationListener(\Pimcore\Event\Model\DataObjectEvent $event)
    {
        $object = $event->getObject();
        if ($object instanceof Grocery ||$object instanceof Manufacturer || $object instanceof Seller || $object instanceof Category) {
            $obj = new NotificationController;
            $className=$object->getClassName();
            $userService = new Service\UserService;
            $notificationService = new NotificationService($userService);
            $obj->sendNotification($notificationService ,$className);
        }
    }

    public function validate(\Pimcore\Event\Model\DataObjectEvent $event)
    {
        $object = $event->getObject();
        if ($object instanceof Grocery) {
            if ($object->getManufactureDate() > $object->getExpiryDate()) {
            throw new \Exception("Manufacturing date must be less Expiry date");
            }
        }
    }
}