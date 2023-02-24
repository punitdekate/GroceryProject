<?php

namespace App\DynamicDropdown;

use Pimcore\Model\DataObject\ClassDefinition\DynamicOptionsProvider\SelectOptionsProviderInterface;
use Pimcore\Model\DataObject;

/**
 * Need to provide App\DynamicDropdown\CustomOptions in options provider class
 */
class CategoryType implements SelectOptionsProviderInterface
{
    public function getDefaultValue($context, $fieldDefinition)
    {
        return "empty";
    }

    function getOptions($context, $fieldDefinition)
    {
        $items=new Dataobject\Category\Listing();
        $items->setOrderKey("RAND()",false);
        $arr=[];
        foreach ($items as $item){
            array_push($arr,["value"=>$item->getCategoryType(),"key"=>$item->getCategoryType()]);
        }
        return $arr;
    }

    function hasStaticOptions($context, $fieldDefinition)
    {
        return true;
    }
}