<?php
namespace App\Controller;
 
use Exception;
use Pimcore\Model\DataObject\Concrete;
use Pimcore\Model\DataObject\ClassDefinition\CalculatorClassInterface;
use Pimcore\Model\DataObject\Data\CalculatedValue;
use Symfony\Bridge\Monolog\Logger;
 
class Calculator implements CalculatorClassInterface
{
    public function getCalculatedValueForEditMode(Concrete $object, CalculatedValue $context): string {
        $result = $this->compute($object, $context);
        return $result;
    }
    public function compute(Concrete $object, CalculatedValue $context):string {
        if ($context->getFieldname() == "OfferPrice") {
            // echo $object->getDiscountPercentage();
            // exit;
            // if($object->getDiscountPercentage()<=100)
            // {
            //     return $object->getActualPrice()-($object->getActualPrice() * ($object->getDiscountPercentage()/100));
            // }
            // else{
            //     $logger=new Logger('Calculator');
            //     $logger->error("Percentage should be less or equal to 100");
            //     return false;
            // }
            try{
                if($object->getDiscountPercentage()>100)
                {
                    throw new Exception('% should be less than 100');
                }
                return $object->getActualPrice()-($object->getActualPrice() * ($object->getDiscountPercentage()/100));
            }
            catch(Exception $e)
            {
                return $e->getMessage();
            }
        }
        // else {
        //     $logger=new Logger('Calculator');
        //     $logger->error("Percentage should be less or equal to 100");
        //     return "Percentage should be less or equal to 100";
        // }
    }
    
} 