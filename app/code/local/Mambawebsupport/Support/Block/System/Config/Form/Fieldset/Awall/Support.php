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

class Mambawebsupport_Support_Block_System_Config_Form_Fieldset_Awall_Support extends Mage_Adminhtml_Block_System_Config_Form_Fieldset
{
	 protected $_dummyElement;
    protected $_fieldRenderer;
    protected $_values;
	
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $html = $this->_getHeaderHtml($element);
		$iam[] = array('label' => $this->__('Please Select'), 'value' => '');
		$iam[] = array('label' => $this->__('Developer'), 'value' => 'Developer');
		$iam[] = array('label' => $this->__('Store Owner'), 'value' => 'Storeowner');
		
        $fields = array(
            array('type' => 'text', 'name' => 'name', 'label' => $this->__('Your Name <span class="required">*</span>'), 'class' => 'required-entry'),
            array('type' => 'text', 'name' => 'email', 'label' => $this->__('Sender Email <span class="required">*</span>'), 'class' => 'required-entry validate-email'),
			array('type' => 'text', 'name' => 'license', 'label' => $this->__('Licensed Domain <span class="required">*</span>'), 'class' => 'input-text required-entry  product-custom-option validate-url'),
            array('type' => 'text', 'name' => 'subject', 'label' => $this->__('Subject <span class="required">*</span>'), 'class' => 'required-entry'),
			array('type' => 'select', 'name' => 'iam', 'label' => $this->__('I am <span class="required">*</span>'), 'values' => $iam, 'class' => 'required-entry'),           
            array('type' => 'select', 'name' => 'reason', 'label' => $this->__('Reason <span class="required">*</span>'), 'values' => $this->_getReasons(), 'class' => 'required-entry'),           
            array('type' => 'textarea', 'name' => 'message', 'label' => $this->__('Message <span class="required">*</span>'), 'class' => 'required-entry'),			
            array('type' => 'label', 'name' => 'send', 'after_element_html' => '<div class="right"><button type="button" class="scalable save" onclick="mambawebsupportSupport()">' . $this->__('Send') . '</button></div><div class="notice" id="ajax-response"></div>'),
			
        );
	    
        foreach ($fields as $field) {
            $html .= $this->_getFieldHtml($element, $field);
        }
        $html .= $this->_getFooterHtml($element);
        return $html;
    }

    protected function _getFieldRenderer()
    {
        if (empty($this->_fieldRenderer)) {
            $this->_fieldRenderer = Mage::getBlockSingleton('adminhtml/system_config_form_field');
        }
        return $this->_fieldRenderer;
    }

    protected function _getReasons()
    {
       $modules = array_keys((array)Mage::getConfig()->getNode('modules')->children());

        sort($modules);

        $reasons[] = array('label' => $this->__('Please select'), 'value' => '');
        foreach ($modules as $moduleName) {
			$moduleConfig = Mage::getConfig()->getNode('modules/' . $moduleName);
            list($namespace, $extension) = explode('_', $moduleName, 2);
            if ($namespace != 'Mambaweb') {
                continue;
            }			
			if($moduleName == 'Mambawebsupport_Support')
			{
                continue;
            }
			if(!$moduleConfig->name)
			{
				continue;
			}
            //$moduleConfig = Mage::getConfig()->getNode('modules/' . $moduleName);
			$reasons[] = array('label' => $moduleConfig->name . " Support", 'value' => $moduleConfig->name);
           //$reasons[$moduleName->name] = $moduleConfig->name;
        }
		$reasons[] = array('label' => $this->__('Other Support'), 'value' => 'Other Support');
        return $reasons;
    }
	
    protected function _getFooterHtml($element)
    {
        $ajaxUrl = $this->getUrl('support/adminhtml_support/sendmail');
        $html = parent::_getFooterHtml($element);
        $html = '<h4>' . $this->__('Visit ') . '<span style="color: #ea7601; font-weight: normal; text-decoration: underline;">https://www.mambawebsupport.com/magento-extensions/</span></h4>' . $html;
        $html .= Mage::helper('adminhtml/js')->getScript("            
            supportForm = new varienForm($('{$element->getHtmlId()}'));
            mambawebsupportSupport = function(){
				if (supportForm.validator.validate()){
					var request = new Ajax.Request(
                        '{$ajaxUrl}',
                        {
                            method:'post',							
                            onSuccess: function () {
        								alert('Mail has been sent successfully. We will be in touch with you within a short time.');
										document.getElementById('name').value = '';
										document.getElementById('email').value = '';
										document.getElementById('license').value = '';
										document.getElementById('subject').value = '';
										document.getElementById('reason').value = '';
										document.getElementById('message').value = '';
										document.getElementById('iam').value = '';
    									},							
                            parameters: Form.serialize($('{$element->getHtmlId()}'))
                        }
                    );
                }
            }
            successResponse = function(transport){
                if (transport && transport.responseText){
                    try{
                        response = eval('(' + transport.responseText + ')');						
                    }
                    catch (e) {
                        response = {};
                    }
                }
                if ((typeof response.message) == 'string') {
                    $('ajax-response').update(response.message);
                } else {
                   $('ajax-response').update(response.message.join(\"\\n\"));
                }
				alert('test1');
                new PeriodicalExecuter(function(pe){ $('ajax-response').update(''); pe.stop(); }, 5);
            }
        ");

        return $html;
    }

    protected function _getFieldHtml($fieldset, $field)
    {
        $type = $field['type'];
        unset($field['type']);
        $field = $fieldset->addField($field['name'], $type, $field)->setRenderer($this->_getFieldRenderer());

        return $field->toHtml();
    }
}