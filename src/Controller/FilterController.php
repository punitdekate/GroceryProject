<?php

namespace App\Controller;

use GraphQL\Utils\Value;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Brand;
use Pimcore\Model\DataObject\Grocery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Pimcore\Model\Dataobject;
use Symfony\Component\Routing\Annotation\Route;



class FilterController extends FrontendController
{
    /**
     * @param Request $request
     * @return Response
     */

    /**
     * @Route("/Juice", name="JuiceApi", methods={"GET","POST"})
     */
    public function JuiceFilter(Request $request) :Response
    {
        $output = strtolower($request->get("name"));
        $data = new Grocery\Listing();
        $data->setOrderKey("RAND()", false);
        $result=[];
        foreach ($data as $item) {
            if($item->getFoodCategory()&&$item->getFoodCategory()->getJuices())
            {
                $input = strtolower($item->getFoodCategory()->getJuices()->getJuiceType());
                $juices=$item->getFoodCategory()->getJuices();
                if( $output == $input)
                {
                    $result[]=array(
                        "SKU" => $item->getSKU(),
                        "Description" => $item->getDescription(),
                        "FoodType" => $item->getFoodType(),
                        "Price" => $item->getPrice()->getValue(),
                        "ShelfLife" => $item->getShelfLife()->getValue(),
                        "Category" => $item->getCategory()[0]->getCategoryType(),
                        "ManufacturingDate" => $item->getManufactureDate(),
                        "ExpiryDate" => $item->getExpiryDate(),
                        "ItemID" => $juices->getItemId(),
                        "ItemName" => $juices->getName(),
                        "TasteType" => $juices->getJuiceType(),
                        "IsPulpy" => $juices->getIsPulpy(),
                        "Flavour" => $juices->getFlavour(),
                        "PackOff" => $juices->getPackOff(),
                        "Ingredients" => $juices->getIngrediant(),
                        "Container" => $juices->getContainerType(),
                        "EAN" => $juices->getEAN()
                    );
                }
            }
        }
        if(empty($result))
        {
            return $this->json(["Empty!!" => "No Product Is Available"]);
        }
        return $this->json(["success" =>$result]);
    }

    /**
     * @Route("/Coffee", name="CoffeeApi", methods={"GET","POST"})
     */
    public function CoffeeFilter(Request $request) :Response
    {
        $output = strtolower($request->get("name"));
        $data = new Grocery\Listing();
        $data->setOrderKey("RAND()", false);
        $result=[];
        foreach ($data as $item) {
            if($item->getFoodCategory()&&$item->getFoodCategory()->getCoffee())
            {
                $input = strtolower($item->getFoodCategory()->getJuices()->getJuiceType());
                $juices=$item->getFoodCategory()->getJuices();
                if( $output == $input)
                {
                    $result[]=array(
                        "SKU" => $item->getSKU(),
                        "Description" => $item->getDescription(),
                        "FoodType" => $item->getFoodType(),
                        "Price" => $item->getPrice()->getValue(),
                        "ShelfLife" => $item->getShelfLife()->getValue(),
                        "Category" => $item->getCategory(),
                        "ManufacturingDate" => $item->getManufactureDate(),
                        "ExpiryDate" => $item->getExpiryDate(),
                        "ItemID" => $juices->getItemId(),
                        "ItemName" => $juices->getName(),
                        "TasteType" => $juices->getJuiceType(),
                        "IsPulpy" => $juices->getIsPulpy(),
                        "Flavour" => $juices->getFlavour(),
                        "PackOff" => $juices->getPackOff(),
                        "Ingredients" => $juices->getIngrediant(),
                        "Container" => $juices->getContainerType(),
                        "EAN" => $juices->getEAN()
                    );
                }
            }
        }
        return $this->json(["success" => $result]);
    }
}
