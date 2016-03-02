<?php
/**
* 
* Do not edit or add to this file if you wish to upgrade the module to newer
* versions in the future. If you wish to customize the module for your 
* needs please contact us to http://mambaweb.weebly.com/contact.html
* 
* @category    Ecommerce
* @package     Mambawebsupport_Support
* @copyright   Copyright (c) 2016 Mambaweb
* @url	       http://www.mambawebsupport.com/
*
**/

class Mambawebsupport_Support_Block_System_Config_Form_Fieldset_Awall_GetCustomized extends Mage_Adminhtml_Block_System_Config_Form_Fieldset
{
	public function render(Varien_Data_Form_Element_Abstract $element)
    {
		$html = $this->_getHeaderHtml($element);
		$html .='<div><p>Looking for some customization in any of our extension? Then <a target="_blank" href="http://mambaweb.weebly.com/contact.html" rel="nofollow">Contact us</a> to get the extension customized specially for you as you wanted.</p></div>';
		$html .= $this->_getFooterHtml($element);
		return $html;
	}
}