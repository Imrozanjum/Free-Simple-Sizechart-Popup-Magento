<?php
/**
* 
* Do not edit or add to this file if you wish to upgrade the module to newer
* versions in the future. If you wish to customize the module for your 
* needs please contact us to http://mambaweb.weebly.com/contact.html
* 
* @category    Ecommerce
* @package     Mambaweb_SimpleSizechartpopup
* @copyright   Copyright (c) 2016 Mambaweb
* @url	       http://goworktoupwork.com/category/downloads/magento-extensions/
*
*
*
*/
class Mambaweb_SimpleSizechartpopup_Model_Type extends Varien_Object
{
    const IMAGE	= 1;
    const BLOCK	= 2;

    static public function toOptionArray()
    {
        return array(
            self::IMAGE   => Mage::helper('simplesizechartpopup')->__('Image'),
            self::BLOCK   => Mage::helper('simplesizechartpopup')->__('Block'),
			
        );
    }
}