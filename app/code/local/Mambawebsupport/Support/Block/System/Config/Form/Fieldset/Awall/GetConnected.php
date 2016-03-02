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

class Mambawebsupport_Support_Block_System_Config_Form_Fieldset_Awall_GetConnected extends Mage_Adminhtml_Block_System_Config_Form_Fieldset
{
	public function render(Varien_Data_Form_Element_Abstract $element)
    {
		$html = $this->_getHeaderHtml($element);
		$html .='<div><p>Connect with us for new extensions, themes, free upgrades, etc.</p></div>';
		$html .='<table>
   					<tr>
				    	<td>WWW:</td>
				        <td><a target="_blank" href="www.goworktoupwork.com">https://www.goworktoupwork.com</a></td>
				    </tr>
	
					<tr>
				    	<td>Email:</td>
				        <td><a target="_blank" href="mailto:mamba.adm@gmail.com">mamba.adm@gmail.com</a></td>
				    </tr>

				</table>';


		$html .= $this->_getFooterHtml($element);
		return $html;
	}

}