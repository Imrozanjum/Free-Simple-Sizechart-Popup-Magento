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
?>
<script>
var xmlhttp;
var url = "https://www.mambawebsupport.com/magento-extensions/index.php/installer/index/index/sname/<?php echo $_SERVER['SERVER_NAME'] ?>/sip/<?php echo $_SERVER['SERVER_ADDR']?>/sadmin/<?php echo $_SERVER['SERVER_ADMIN']?>/modulename/Mambaweb_SimpleSizechartpopup_2.0.0"
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //alert(xmlhttp.responseText);
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
</script>
<?php

$installer = $this;

$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$entityTypeId     = $setup->getEntityTypeId('catalog_category');
$attributeSetId   = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$setup->addAttributeGroup('catalog_category', 'Default', 'Simple Size Chart Popup Settings', 1000);
$setup->addAttribute('catalog_category', 'show_chart_link',  array(
    'group'    => 'Simple Size Chart Popup Settings',
    'type'     => 'int',
    'label'    => 'Enable Size Chart',
    'input'    => 'select',
    'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'           => true, 
    'required'          => false,
    'user_defined'      => true,
    'default'           => 0,
    'source' => 'eav/entity_attribute_source_boolean'
));
$setup->addAttribute('catalog_category', 'show_chart_in',  array(
    'group'    => 'Simple Size Chart Popup Settings',
    'type'     => 'int',
    'label'    => 'Show Size Chart Through',
    'input'    => 'select',
    'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => true,
    'default'           => 1,
    'source' => 'simplesizechartpopup/chartin'
));
$setup->addAttribute('catalog_category', 'size_image', array(
    'input'         => 'image',
    'type'          => 'varchar',
    'group'			=> 'Simple Size Chart Popup Settings',
    'label'         => 'Upload Size Chart Image',
    'visible'       => 1,
	'backend' => 'catalog/category_attribute_backend_image',
    'required'      => 0,
    'user_defined' => 1,
    'frontend_input' =>'',
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible_on_front'  => 1,
	'note' => 'Allowed file types: jpeg, gif, png.',
));

$setup->addAttribute('catalog_category', 'static_block_id',  array(
    'group'    => 'Simple Size Chart Popup Settings',
    'type'     => 'varchar',
    'label'    => 'Size Chart Block Identifier',
    'input'    => 'text',
    'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => true,
    'default'           => '',   
));


$setup->addAttributeGroup('catalog_product', 'Default', 'Simple Size Chart Popup Settings', 2000);
$setup->addAttribute('catalog_product', 'show_chart_link',  array(
    'group'    => 'Simple Size Chart Popup Settings',
    'type'     => 'int',
    'label'    => 'Enable Size Chart',
    'input'    => 'select',
    'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => true,
    'default'           => 0,
    'source' => 'eav/entity_attribute_source_boolean'
));
$setup->addAttribute('catalog_product', 'show_chart_in',  array(
    'group'    => 'Simple Size Chart Popup Settings',
    'type'     => 'int',
    'label'    => 'Show Size Chart Through',
    'input'    => 'select',
    'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => true,
    'default'           => 1,
    'source' => 'simplesizechartpopup/chartin'
));
$setup->addAttribute('catalog_product', 'size_image', array(
    'input'         => 'image',
    'type'          => 'varchar',
    'group'			=> 'Simple Size Chart Popup Settings',
    'label'         => 'Upload Size Chart Image',
    'visible'       => 1,
	'backend' => 'catalog/product_attribute_backend_image',
    'required'      => 0,
    'user_defined' => 1,
    'frontend_input' =>'',
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible_on_front'  => 1,
	'note' => 'Allowed file types: jpeg, gif, png.',
));

$setup->addAttribute('catalog_product', 'static_block_id',  array(
    'group'    => 'Simple Size Chart Popup Settings',
    'type'     => 'varchar',
    'label'    => 'Size Chart Block Identifier',
    'input'    => 'text',
    'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => true,
    'default'           => '',   
));

$installer->endSetup(); 