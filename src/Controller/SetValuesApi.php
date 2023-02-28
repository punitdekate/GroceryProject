<?php

namespace App\Controller;

use Google\Service\YouTube;
use GraphQL\Utils\Value;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Category;
use Pimcore\Model\DataObject\Grocery;
// use Pimcore\Model\DataObject\Staples\Category;
use Pimcore\Model\DataObject\Manufacturer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Pimcore\Model\Dataobject;
use Symfony\Component\Routing\Annotation\Route;



class SetValuesApi extends FrontendController
{
    /**
     * @param Request $request
     * @return Response
     */

    /**
     * @Route("/SetTest", name="SetTestApi", methods={"POST"})
     */
    public function SetTest(Request $request): Response
    {
        $result=[];
        $newObject = new Manufacturer();
        $newObject->setKey(\Pimcore\Model\Element\Service::getValidKey('TestObject', 'object'));
        $newObject->setParentId(231);
        $newObject->setManufacturerName("Jaadu");
        // $newObject->setLogo()
        $newObject->save();
        return $this->json(["success" => $result]);
    }
}