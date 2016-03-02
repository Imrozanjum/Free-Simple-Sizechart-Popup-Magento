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
<?php

$installer = $this;

$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

$setup->updateAttribute('catalog_category','show_chart_in','note','Leave this blank to use Global settings');

$setup->updateAttribute('catalog_category','size_image','note','Allowed file types: jpeg, gif, png., Leave this blank to use Global settings');

$setup->updateAttribute('catalog_category','static_block_id','note','Leave this blank to use Global settings');

$setup->updateAttribute('catalog_product','show_chart_in','note','Leave this blank to use Category/Global settings');

$setup->updateAttribute('catalog_product','size_image','note','Allowed file types: jpeg, gif, png., Leave this blank to use Category/Global settings');

$setup->updateAttribute('catalog_product','static_block_id','note','Leave this blank to use Category/Global settings');

$installer->endSetup(); 