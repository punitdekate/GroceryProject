<?php

namespace App\Controller;

use Google\Service\YouTube;
use GraphQL\Utils\Value;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Brand;
use Pimcore\Model\DataObject\Grocery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Pimcore\Model\Dataobject;
use Symfony\Component\Routing\Annotation\Route;



class SpecificProductFilter extends FrontendController
{
    /**
     * @param Request $request
     * @return Response
     */

    /**
     * @Route("/SpecificProduct", name="SpecificProductApi", methods={"GET"})
     */
    public function SpecificProductFilter(Request $request): Response
    {
        $output = strtolower($request->get("Product"));
        $data = new Grocery\Listing();
        $data->setOrderKey("RAND()", false);
        $result = [];
        foreach ($data as $item) {
            $foodCategoryRelation = strtolower($item->getCategoryRelation()[0]->getCategoryType());
            if ($foodCategoryRelation != NULL) {
                $children = $item->getChildren([DataObject::OBJECT_TYPE_VARIANT]);
                if ($foodCategoryRelation == $output && $children != NULL) {
                    $result[] = array(
                        "SKU" => $item->getSKU(),
                        "Description" => $item->getDescription(),
                        "FoodType" => $item->getFoodType(),
                        "Price" => $item->getPrice()->getValue(),
                        "ShelfLife" => $item->getShelfLife()->getValue(),
                        "ManufacturingDate" => $item->getManufactureDate(),
                        "ExpiryDate" => $item->getExpiryDate(),
                    );
                }
            } else {
                return $this->json(["Failed!!" => "Enter Valid Product"]);
            }
        }
        return $this->json(["success" => $result]);
    }

    /**
     * @Route("/Test", name="TestApi", methods={"GET"})
     */
    public function TestApi(Request $request): Response //Api code for Relation 
    {
        $object =new Grocery\Listing();
        $result = [];
        $output=[];
        foreach ($object as $items) {
            // $category = $items->getCategoryRelation();
            // foreach ($category as $value) {
            //     array_push($result , $items->getId(), $value->getCategoryType());
            // }
            // $imagePath=$items->getMainImage();
            // if($imagePath!=NULL)
            // {
            //     $output=array("category"=>$result,"Image"=>$imagePath->getFullPath());
            // }
            // else{
            //     $output=array("category"=>$result,"Image"=>"");
            // }
            $localizedField=$items->getLocalizedfields()->getLocalizedValue("en");
            array_push($result,
                $items->getId(),
                $localizedField
            );
            $output=array($result);
            
        }
        return $this->json(["success" => $output]);
    }


}