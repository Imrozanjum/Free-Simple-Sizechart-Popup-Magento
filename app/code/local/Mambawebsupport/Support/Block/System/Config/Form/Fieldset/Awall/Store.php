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

class AW_All_Block_System_Config_Form_Fieldset_Awall_Store extends Mage_Adminhtml_Block_System_Config_Form_Fieldset
{
    protected $_dummyElement;
    protected $_fieldRenderer;
    protected $_values;

    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $html = '<div id="' . $element->getId() . '"></div>';
        return $html;		
    }
}
?>
