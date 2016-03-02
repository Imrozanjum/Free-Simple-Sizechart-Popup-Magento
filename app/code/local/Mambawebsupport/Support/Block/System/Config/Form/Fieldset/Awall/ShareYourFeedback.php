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

class Mambawebsupport_Support_Block_System_Config_Form_Fieldset_Awall_ShareYourFeedback extends Mage_Adminhtml_Block_System_Config_Form_Fieldset
{
	public function render(Varien_Data_Form_Element_Abstract $element)
    {
		$html = $this->_getHeaderHtml($element);
		$html .='<div><p>If you want this extensions to get even better, <strong>we need your testimonials and feedback!</strong> Email your Feedback to <a target="_blank" href="mailto:mamba.adm@gmail.com">mailto:mamba.adm@gmail.com</a> or use the <a target="_blank" href="http://mambaweb.weebly.com/contact.html" rel="nofollow">Contact Us</a>. Your ideas, suggestions and enthusiasm will help us serve you more!</p></div>';
		$html .= $this->_getFooterHtml($element);
		return $html;
	}

}