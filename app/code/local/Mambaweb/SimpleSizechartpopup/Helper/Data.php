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
class Mambaweb_SimpleSizechartpopup_Helper_Data extends Mage_Core_Helper_Abstract
{

const MULTIPLE_FILTERS_DELIMITER = ',';	

	public function getChartLink()
	{
		return Mage::getStoreConfig('simplesizechartpopup/general_setting/chart_link', Mage::app()->getStore());
	}
	public function getChartLinkTitle()
	{
		return Mage::getStoreConfig('simplesizechartpopup/general_setting/linktitle', Mage::app()->getStore());
	}
	public function getLinkImage()
	{
		return Mage::getStoreConfig('simplesizechartpopup/general_setting/linkimage', Mage::app()->getStore());
	}
	public function getEffect()
	{
		return Mage::getStoreConfig('simplesizechartpopup/general_setting/effect', Mage::app()->getStore());
	}
	public function getChartImage()
	{	
		return Mage::getStoreConfig('simplesizechartpopup/general_setting/chartimage', Mage::app()->getStore());
	}
	public function getTextColor()
	{
		return Mage::getStoreConfig('simplesizechartpopup/general_setting/scptextcolor', Mage::app()->getStore());
	}
	public function getChartBlock()
	{
		return Mage::getStoreConfig('simplesizechartpopup/general_setting/chartblock', Mage::app()->getStore());
	}
	
	public function getJsBasedOnConfig()
    {
        $magentoVersion = Mage::getVersion();
        if (version_compare($magentoVersion, '1.9', '<='))
		{
            return 'simplesizechartpopup/jquery-1.10.2.min.js';
        }
        else 
		{
            return null;
        }
    }
	
	public function getDomain ()
		{
		
			 $domain = $this->getStoreDomain();
			$temp = explode('.', $domain);
			$exceptions = array(
				'co.uk',
				'com.au',
				'com.hk',
				'co.nz',
				'co.in',
				'com.sg'
				);

				$count = count($temp);
				$last = $temp[($count-2)] . '.' . $temp[($count-1)];

				if(in_array($last, $exceptions))	{
					$new_domain = $temp[($count-3)] . '.' . $temp[($count-2)] . '.' . $temp[($count-1)];
				}
				else	{
					$new_domain = $temp[($count-2)] . '.' . $temp[($count-1)];
				}
				return $new_domain;
		}


		public function checkEntry ($domain, $serial)
		{
			$key = sha1(base64_decode('U2l6aW5nUG9wdXA='));
			if(sha1($key.$domain) == $serial)
			{
				return true;
			}
			return false;
		}


		public function isEnabled()
		{
			if(Mage::getStoreConfig('simplesizechartpopup/license_status_group/status', Mage::app()->getStore()) != '0') {
				return true;
			}
			return false;
			
		}
		public function getStoreDomain()
		{
			
			$store = Mage::getSingleton('adminhtml/config_data')->getStore();
			$web = Mage::getSingleton('adminhtml/config_data')->getWebsite();		
			$code= "";
			
			if($web!=="" && $store!=="")
			{
				$code = $store;	
			}
			else if($web=="base")
			{
				return $_SERVER['SERVER_NAME'];
			}
			else if($web!=="")
			{
				$code = $web;
			}
			else
			{
				return $_SERVER['SERVER_NAME'];	
			}
			
			$store_id = Mage::getModel('core/store')->load($code)->getId();
			$new_domain = Mage::app()->getStore($store_id)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);
			return substr($new_domain,0,	strlen($new_domain)-1);
		}


		public function canRun ($temp="")
		{
			return true;
		}


		public function getMessage ()
		{
			return base64_decode('PGRpdiBzdHlsZT0iYm9yZGVyOjNweCBzb2xpZCAjRkYwMDAwOyBtYXJnaW46MTVweCAwOyBwYWRkaW5nOjVweDsiPiBMaWNlbnNlIG9mIDxiPkluZGllcyBTaXplIENoYXJ0IFBvcHVwPC9iPiBtb2R1bGUgaGFzIGJlZW4gdmlvbGF0ZWQuIFRvIGdldCBsaWNlbnNlIHNlcmlhbCBrZXkgcGxlYXNlIHZpc2l0IDxiPmh0dHBzOi8vd3d3LmluZGllc2luYy5jb20vbWFnZW50by1leHRlbnNpb25zL2NvbnRhY3RzPC9iPjwvZGl2Pg==');
		}
		public function getAdminMessage ()
		{
			return base64_decode('PGRpdj4gTGljZW5zZSBvZiA8Yj5JbmRpZXMgU2l6ZSBDaGFydCBQb3B1cDwvYj4gbW9kdWxlIGhhcyBiZWVuIHZpb2xhdGVkLiBUbyBnZXQgbGljZW5zZSBzZXJpYWwga2V5IHBsZWFzZSB2aXNpdCA8Yj5odHRwczovL3d3dy5pbmRpZXNpbmMuY29tL21hZ2VudG8tZXh0ZW5zaW9ucy9jb250YWN0czwvYj48L2Rpdj4=');
		}
}