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
class Mambaweb_SimpleSizechartpopup_Model_Effect extends Varien_Object
{
    const STATUS_HOVER	= 1;
    const STATUS_LIGHTBOX	= 2;

    static public function toOptionArray()
    {
        return array(
            self::STATUS_HOVER   => Mage::helper('simplesizechartpopup')->__('Hover'),
            self::STATUS_LIGHTBOX   => Mage::helper('simplesizechartpopup')->__('Click')
        );
    }
}