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
class Mambaweb_SimpleSizechartpopup_Model_Observer extends Mage_Core_Model_Config_Data
{

	public function save()
    {
		
		$data = $this->_getData('fieldset_data');
		
  		$obj = Mage::helper('simplesizechartpopup/data');
		
		if($data['status'])
		{
			if($data['serial_key'] != '')
			{
				 $serialkey = $data['serial_key'];
				 if($obj->canRun($serialkey))
				{
					  return parent::save();
				}
				 else
				{
					 Mage::throwException($obj->getAdminMessage());
				}
			}
			else
			{
				  Mage::throwException($obj->getAdminMessage());
			}
		}
		
    }	
}