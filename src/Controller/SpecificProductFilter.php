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
        // $object =new Grocery\Listing();
        $object =Manufacturer::getById(233);

        $result = [];
        // $output=[];
        // foreach ($object as $items) {
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
            // $entries = new Category\Listing();
            // $entries->setCondition("CategoryType LIKE ?", "%o%");
            // $entries->load();
 
            // foreach($entries as $entry) 
            // {
                // array_push($result,
                //     $entry->getId(),
                //     $entry->getCategoryType()
                // );
                // array_push($output,$result);
                // $result=[];
                // $output=array(
                    // "ID"=>$entry->getId(),
                    // "Type"=>$entry->getCategoryType()
                // );
                // array_push($result,$output);
            // }
 
            
        // }
        $result=array(
            "Name"=>$object->getManufacturerName(),
            "Image"=>$object->getLogo()->getType()
        );
        return $this->json(["success" => $result]);
    }


}