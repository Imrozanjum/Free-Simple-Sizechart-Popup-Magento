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
class Mambaweb_SimpleSizechartpopup_Model_Status extends Varien_Object
{
    const STATUS_ENABLED	= 1;
    const STATUS_DISABLED	= 0;
	const STATUS_ALL		= 2;

    static public function toOptionArray()
    {
        return array(
            self::STATUS_ENABLED    => Mage::helper('simplesizechartpopup')->__('Enable for Specific Products'),
			self::STATUS_ALL		=> Mage::helper('simplesizechartpopup')->__('Enable for All Products'),
            self::STATUS_DISABLED   => Mage::helper('simplesizechartpopup')->__('Disable')
        );
    }
}