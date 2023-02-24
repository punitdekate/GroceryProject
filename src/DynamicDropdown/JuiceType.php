<?php

namespace App\DynamicDropdown;

use Pimcore\Model\DataObject\ClassDefinition\DynamicOptionsProvider\SelectOptionsProviderInterface;
use Pimcore\Model\DataObject;

/**
 * Need to provide App\DynamicDropdown\CustomOptions in options provider class
 */
class JuiceType implements SelectOptionsProviderInterface
{
    public function getDefaultValue($context, $fieldDefinition)
    {
        return "empty";
    }

    function getOptions($context, $fieldDefinition)
    {
        $items=new Dataobject\JuiceType\Listing();
        $items->setOrderKey("RAND()",false);
        $arr=[];
        foreach ($items as $item){
            array_push($arr,["value"=>$item->getJuiceType(),"key"=>$item->getJuiceType()]);
        }
        return $arr;
    }

    function hasStaticOptions($context, $fieldDefinition)
    {
        return true;
    }
}