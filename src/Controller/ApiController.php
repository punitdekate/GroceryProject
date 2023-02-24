<?php

namespace App\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Brand;
use Pimcore\Model\DataObject\Grocery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Pimcore\Model\Dataobject;
use Symfony\Component\Routing\Annotation\Route;



class ApiController extends FrontendController
{
    /**
     * @param Request $request
     * @return Response
     */

    /**
     * @Route("/Data", name="DataApi", methods={"GET"})
     */
    public function DataApi(Request $request)
    {
        $value = strtolower($request->get("Category"));
        $product= strtolower($request->get("Product"));
        if ($value == "beverages") {
            $data = new Grocery\Listing();
            foreach ($data as $key => $value) {
                $Coffee = $value->getFoodCategory()->getCoffee();
                $Tea = $value->getFoodCategory()->getTea();
                $Juice = $value->getFoodCategory()->getJuices();
                $Water = $value->getFoodCategory()->getWater();
                if ($Coffee != NULL) {
                    $smallOutput[] = array(
                        "ItemID" => $Coffee->getItemId(),
                        "ItemName" => $Coffee->getName(),
                        "TasteType" => $Coffee->getBeanType(),
                        "BiscuitType" => $Coffee->getFormFactor(),
                        "Flavour" => $Coffee->getFlavour(),
                        "Weight" => $Coffee->getWeight()->getValue(),
                        "PackOff" => $Coffee->getPackOff(),
                        "Ingredients" => $Coffee->getIngrediant(),
                        "Container" => $Coffee->getContainerType(),
                        "EAN" => $Coffee->getEAN()
                    );
                } elseif ($Tea != NULL) {
                    $smallOutput[] = array(
                        "ItemID" => $Tea->getItemId(),
                        "ItemName" => $Tea->getName(),
                        "TasteType" => $Tea->getTeaType(),
                        "Weight" => $Tea->getWeight()->getValue(),
                        "PackOff" => $Tea->getPackOff(),
                        "Ingredients" => $Tea->getIngrediant(),
                        "Container" => $Tea->getContainerType(),
                        "EAN" => $Tea->getEAN()
                    );
                } elseif ($Juice != NULL) {
                    $smallOutput[] = array(
                        "ItemID" => $Juice->getItemId(),
                        "ItemName" => $Juice->getName(),
                        "TasteType" => $Juice->getJuiceType(),
                        "IsPulpy" => $Juice->getIsPulpy(),
                        "Flavour" => $Juice->getFlavour(),
                        "Weight" => $Juice->getWeight()->getValue(),
                        "PackOff" => $Juice->getPackOff(),
                        "Ingredients" => $Juice->getIngrediant(),
                        "Container" => $Juice->getContainerType(),
                        "EAN" => $Juice->getEAN()
                    );
                } elseif ($Water != NULL) {
                    $smallOutput[] = array(
                        "ItemID" => $Water->getItemId(),
                        "ItemName" => $Water->getName(),
                        "TasteType" => $Water->getWaterType(),
                        "PackOff" => $Water->getPackOff(),
                        "Container" => $Water->getContainerType(),
                        "EAN" => $Water->getEAN()
                    );
                }
                if($smallOutput!=NULL)
                {
                $output[] = array(
                    "SKU" => $value->getSKU(),
                    "Description" => $value->getDescription(),
                    "FoodType" => $value->getFoodType(),
                    "Price" => $value->getPrice()->getValue(),
                    "ShelfLife" => $value->getShelfLife()->getValue(),
                    "Category" => $value->getCategoryRelation()[0]->getCategoryType(),
                    "ManufacturingDate" => $value->getManufactureDate(),
                    "ExpiryDate" => $value->getExpiryDate(),
                    "Snacks" => $smallOutput,
                    // "Manufacture"=>$value->getManufactureRelation()->getManufacturerName(),
                    // "Packer"=>$value->getPackerRelation()[0]->getPackerName(),
                    // "Seller"=>$value->getSellerRelation()->getSellerId()
                );
                } 
                $smallOutput = [];
            }
        }
        elseif ($value == "packagedfood") {
            $data = new Grocery\Listing();
            $output=[];
            foreach ($data as $key => $value) {
                $Baking = $value->getFoodCategory()->getBaking();
                $Chocolate = $value->getFoodCategory()->getChocolate();
                $Jams=$value->getFoodCategory()->getJams();
                $Honey = $value->getFoodCategory()->getHoney();
                $Pasta = $value->getFoodCategory()->getPasta();
                $Spreads = $value->getFoodCategory()->getSpreads();
                $PackageOutput = [];
                if ($Chocolate != NULL) {
                    $PackageOutput[] = array(
                        "ItemID" => $Chocolate->getItemId(),
                        "ItemName" => $Chocolate->getName(),
                        "products" => $Chocolate->getproducts(),
                        // "Weight" => $Chocolate->getWeight()->getValue(),
                        "PackOff" => $Chocolate->getPackOff(),
                        "Ingredients" => $Chocolate->getIngredients(),
                        "Container" => $Chocolate->getContainerType(),
                        "form" => $Chocolate->getform()
                    );
                } elseif ($Baking != NULL) {
                    $PackageOutput[] = array(
                        "ItemID" => $Baking->getItemId(),
                        "ItemName" => $Baking->getName(),
                        "TasteType" => $Baking->getProducts(),
                        "Flavour" => $Baking->getFlavour(),
                        // "Weight" => $Baking->getWeight()->getValue(),
                        "PackOff" => $Baking->getPackOff(),
                        "Ingredients" => $Baking->getIngredients(),
                        "Container" => $Baking->getContainerType(),
                        "EAN" => $Baking->getForm()
                    );
                } elseif ($Honey != NULL) {
                    $PackageOutput[] = array(
                        "ItemID" => $Honey->getItemId(),
                        "ItemName" => $Honey->getName(),
                        // "Weight" => $Honey->getQuantity()->getValue(),
                        "Ingredients" => $Honey->getIngredients(),
                        "Container" => $Honey->getContainerType(),
                    );
                } elseif ($Jams != NULL) {
                    $PackageOutput[] = array(
                        "ItemID" => $Jams->getItemId(),
                        "ItemName" => $Jams->getName(),
                        // "Weight" => $Honey->getQuantity()->getValue(),
                        "Ingredients" => $Jams->getIngredients(),
                        "Container" => $Jams->getContainerType(),
                    );
                } elseif ($Pasta != NULL) {
                    $PackageOutput[] = array(
                        "ItemID" => $Pasta->getItemId(),
                        "ItemName" => $Pasta->getName(),
                        "TasteType" => $Pasta->getTypes(),
                        "Flavour" => $Pasta->getIngredient(),
                        // "Weight" => $Pasta->getQuantity()->getValue(),
                        "PackOff" => $Pasta->getFlavour(),
                        "Container" => $Pasta->getContainerType()
                    );
                } elseif ($Spreads != NULL) {
                    $PackageOutput[] = array(
                        "ItemID" => $Spreads->getItemId(),
                        "ItemName" => $Spreads->getName(),
                        "TasteType" => $Spreads->getTypes(),
                        "Flavour" => $Spreads->getIngredient(),
                        // "Weight" => $Spreads->getQuantity()->getValue(),
                        "PackOff" => $Spreads->getFlavour(),
                        "Container" => $Spreads->getContainerType()
                    );
                }
                if($PackageOutput!=NULL)
                {
                    $output[] = array(
                    "SKU" => $value->getSKU(),
                    "Description" => $value->getDescription(),
                    "FoodType" => $value->getFoodType(),
                    "Price" => $value->getPrice()->getValue(),
                    "ShelfLife" => $value->getShelfLife()->getValue(),
                    "Category" => $value->getCategoryRelation()[0]->getCategoryType(),
                    "ManufacturingDate" => $value->getManufactureDate(),
                    "ExpiryDate" => $value->getExpiryDate(),
                    "PackagedFood" => $PackageOutput
                );
                }
               
            }
        }
        elseif($value=="snacks")
        {
            $data = new Grocery\Listing();
        foreach ($data as $key => $value) {
            $Biscuits = $value->getFoodCategory()->getBiscuits();
            $Namkeen = $value->getFoodCategory()->getNamkeen();
            if ($Biscuits != NULL) {
                $smallOutput[] = array(
                    "ItemID" => $Biscuits->getItemId(),
                    "ItemName" => $Biscuits->getName(),
                    "TasteType" => $Biscuits->getTasteType(),
                    "BiscuitType" => $Biscuits->getBiscuitType(),
                    "Flavour" => $Biscuits->getFlavour(),
                    "Weight" => $Biscuits->getWeight()->getValue(),
                    "QuantityOfItem" => $Biscuits->getQuantityOfItem(),
                    "PackOff" => $Biscuits->getPackOff(),
                    "Ingredients" => $Biscuits->getIngrediant(),
                    "Container" => $Biscuits->getContainerType(),
                    "EAN" => $Biscuits->getEAN()
                );
            } elseif ($Namkeen != NULL) {
                $smallOutput[] = array(
                    "ItemID" => $Namkeen->getItemId(),
                    "ItemName" => $Namkeen->getName(),
                    "TasteType" => $Namkeen->getTasteType(),
                    "BiscuitType" => $Namkeen->getSnacktype(),
                    "Flavour" => $Namkeen->getFlavour(),
                    "Weight" => $Namkeen->getWeight()->getValue(),
                    "QuantityOfItem" => $Namkeen->getQuantityOfItem(),
                    "PackOff" => $Namkeen->getPackOff(),
                    "Ingredients" => $Namkeen->getIngrediant(),
                    "Container" => $Namkeen->getContainerType(),
                    "EAN" => $Namkeen->getEAN()
                );
            }
            if($smallOutput!=NULL)
            {
                $output[] = array(
                    "SKU" => $value->getSKU(),
                    "Description" => $value->getDescription(),
                    "FoodType" => $value->getFoodType(),
                    "Price" => $value->getPrice()->getValue(),
                    "ShelfLife" => $value->getShelfLife()->getValue(),
                    // "Category" => $value->getCategory(),
                    "ManufacturingDate" => $value->getManufacutureDate(),
                    "ExpiryDate" => $value->getExpiryDate(),
                    "Snacks" => $smallOutput
            );
            }
            $smallOutput = [];
        }
        }
        elseif($value=="staples")
        {
            $data=new Grocery\Listing();
            foreach ($data as $key => $value) {
                $DalAndPulses=$value->getFoodCategory()->getDalAndPules();
                $GheeAndOils=$value->getFoodCategory()->getGheeAndOils();
                $RiceAndRiceProducts=$value->getFoodCategory()->getRiceAndRiceProducts();
                $SugarJaggeryAndSalt=$value->getFoodCategory()->getSugarJaggeryAndSalt();
                if ($DalAndPulses != NULL) {
                $smallOutput[] = array(
                    "ModelName" => $DalAndPulses->getModelName(),
                    "ProductType" => $DalAndPulses->getProductType(),
                    "Quantity" => $DalAndPulses->getQuantity()->getValue(),
                    "Form" => $DalAndPulses->getForm(),
                    "Polished" => $DalAndPulses->getPolished(),
                    "Organic" => $DalAndPulses->getOrganic(),
                    "MaximumShelf" => $DalAndPulses->getMaximumShelf(),
                    "NutrientContent" => $DalAndPulses->getNutrientContent(),
                    "ContainerType" => $DalAndPulses->getContainerType(),
                );
                }
                elseif($GheeAndOils!=NULL){
                    $smallOutput[]=array(
                    "ModelName" => $GheeAndOils->getModelName(),
                    "OilType" => $GheeAndOils->getOilType(),
                    "Quantity" => $GheeAndOils->getQuantity()->getValue(),
                    "UsedFor" => $GheeAndOils->getUsedFor(),
                    "ProcessingType" => $GheeAndOils->getProcessingType(),
                    "MaximumShelfLife" => $GheeAndOils->getMaximumShelfLife(),
                    "FoodPreference" => $GheeAndOils->getFoodPreference(),
                    "Organic" => $GheeAndOils->getOrganic(),
                    "AddedPreservatives" => $GheeAndOils->getAddedPreservatives(),
                    "Ingredients" =>$GheeAndOils->getIngredients(),
                    "Nutrients" =>$GheeAndOils->getNutrient(),
                    "ContainerType" => $GheeAndOils->getContainerType(),
                    );
                }
                elseif($RiceAndRiceProducts!=NULL){
                    $smallOutput[]=array(
                    "ModelName" => $RiceAndRiceProducts->getModelName(),
                    "RiceType" => $RiceAndRiceProducts->getRiceType(),
                    "Color" => $RiceAndRiceProducts->getColor(),
                    "Quantity" => $RiceAndRiceProducts->getQuantity()->getValue(),
                    "GrainSize" => $RiceAndRiceProducts->getGrainSize(),
                    "MaximumShelfLife" => $RiceAndRiceProducts->getMaximumShelfLife(),
                    "Nutrient" => $RiceAndRiceProducts->getNutrient(),
                    "ContainerType" => $RiceAndRiceProducts->getContainerType(),
                    );
                }
                elseif($SugarJaggeryAndSalt!=NULL){
                    $smallOutput[]=array(
                        "ModelName" => $SugarJaggeryAndSalt->getModelName(),
                        "RiceType" => $SugarJaggeryAndSalt->getRiceType(),
                        "Color" => $SugarJaggeryAndSalt->getColor(),
                        "Quantity" => $SugarJaggeryAndSalt->getQuantity()->getValue(),
                        "GrainSize" => $SugarJaggeryAndSalt->getGrainSize(),
                        "MaximumShelfLife" => $SugarJaggeryAndSalt->getMaximumShelfLife(),
                        "Nutrient" => $SugarJaggeryAndSalt->getNutrient(),
                        "Form" => $SugarJaggeryAndSalt->getForm(),
                        "Organic" => $SugarJaggeryAndSalt->getOrganic(),
                        "DietaryPreference"=>$SugarJaggeryAndSalt->getDietaryPreferance(),
                        "ContainerType" => $SugarJaggeryAndSalt->getContainerType(),
                    );
                }

                if($smallOutput!=NULL)
                {
                $output[] = array(
                    "SKU" => $value->getSKU(),
                    "Description" => $value->getDescription(),
                    "FoodType" => $value->getFoodType(),
                    "Price" => $value->getPrice()->getValue(),
                    "ShelfLife" => $value->getShelfLife()->getValue(),
                    // "Category" => $value->getCategory(),
                    "ManufacturingDate" => $value->getManufacutureDate(),
                    "ExpiryDate" => $value->getExpiryDate(),
                    "Snacks" => $smallOutput
                );
                }
            $smallOutput = [];
                
            }

        }
        else{
            return $this->json(["Oops!!" => "Enter right category!!! Ex.Beverages,PackagedFood,Snacks,Staples"]);
        }
        if($output!=NULL)
        {
            return $this->json(["success" => true, "data" => $output]);
        }
        else{
            return $this->json(["Status" => "No product is there!!!"]);
        }
    }

}