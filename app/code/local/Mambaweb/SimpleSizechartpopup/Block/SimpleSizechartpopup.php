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
class Mambaweb_SimpleSizechartpopup_Block_SimpleSizechartpopup extends Mage_Core_Block_Template
{
	public $helper;
	public function _prepareLayout()
    {
		$this->helper = Mage::helper('simplesizechartpopup/data');
		return parent::_prepareLayout();
    }
    
    public function getSimpleSizechartpopup()
    { 
        if (!$this->hasData('simplesizechartpopup')) {
            $this->setData('simplesizechartpopup', Mage::registry('simplesizechartpopup'));
        }
        return $this->getData('simplesizechartpopup');
        
    }
	public function getProduct()
    {
		$_product = Mage::getModel('catalog/product')->load(Mage::registry('current_product')->getId());
		return $_product;
    }
	public function getChartLink()
	{
		$linktitle = "";
		$linktype = $this->helper->getChartLink();
		$linkcolor=$this->helper->getTextColor();
		$linktitle1= $this->helper->getChartLinkTitle();
		switch($linktype)
		{
			case 1:			
				$linktitle='<a href="#sizechartlightbox" id="button" class="fancybox fancychartbox" style="color:#'.$linkcolor.'">'.$this->helper->getChartLinkTitle().'</a>';
				break;
			case 2:
				$image= $this->helper->getLinkImage();
				$imageLink = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'simplesizechartpopup/'.$this->helper->getLinkImage();
				if($image!='')
				{
					$linktitle='<a href="#sizechartlightbox" id="button" class="fancybox fancychartbox" ><img style=" height:20px;" alt="Size Chart" src="'.$imageLink.'"/></a>';
				}
				else{
					$linktitle='<a href="#sizechartlightbox" id="button" class="fancybox fancychartbox" style="color:#'.$linkcolor.'">'.$this->helper->getChartLinkTitle().'</a>';
				}
				break;
			case 3:
				$image= $this->helper->getLinkImage();
				$imageLink =  Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'simplesizechartpopup/'.$this->helper->getLinkImage();
				if($image!='')
				{
					if($linktitle1!='')
					{
						$linktitle='<a href="#sizechartlightbox" id="button" class="fancybox fancychartbox"><img style="   height:20px;" src="'.$imageLink.'" alt="sizechartimage"/><div style="color:#'.$linkcolor.'">'.$this->helper->getChartLinkTitle().'</div></a>';
					}
					else
					{
						$linktitle='<a href="#sizechartlightbox" id="button" class="fancybox fancychartbox"><img style="   height:20px;" src="'.$imageLink.'" alt="sizechartimage"/><div style="color:#'.$linkcolor.'">Size Chart</div></a>';

					}
				}
				else
				{
					if($linktitle1!='')
					{	
						$linktitle='<a href="#sizechartlightbox" id="button" class="fancybox fancychartbox" ><div style="color:#'.$linkcolor.'">'.$linktitle1.'</div></a>';					
					}
					else
					{	
						$linktitle='4<a href="#sizechartlightbox" id="button" class="fancybox fancychartbox" ><div style="color:#'.$linkcolor.'">Size Chart</div></a>';
					}
				}
				break;
				
		}
		return $linktitle;
	}
	/*get chart source function begins*/
	public function getChartSource()
	{		
		$_product = $this->getProduct();
		$baseUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);		
		$_category_id = $_product->getCategoryId();
		$_category = Mage::getModel('catalog/category')->load($_category_id);	
		$imagelink=$this->helper->getChartImage();
		if(isset($imagelink) && $imagelink!='')
		{
			$link = $baseUrl .'simplesizechartpopup/'.$this->helper->getChartImage();
		}
		else
		{
			$link='';
		}
		/*Followinng code will be implemented if Yes is set in is set in Show Size Chart Link product */
		if( isset($_product['show_chart_link']) && $_product['show_chart_link']==1)
		{	
			if(isset($_product['show_chart_in'])&&($_product['show_chart_in']==1))
			{
			
				if(isset($_product['size_image']) &&($_product['size_image']!=''))
				{
					$link = $baseUrl .'catalog/product/'.$_product['size_image'];
					$imagelink = '<img src="'.$link.'"/>';		
					return $imagelink;
				}
				/* this is used to fetch category image if no size chart image is not found in product*/
				else 
				{
					$categories = $_product->getCategoryIds(); 
					
					if(isset($_category['size_image']) && ($_category['size_image']!=''))
					{
						$link = $baseUrl .'catalog/category/'.$_category['size_image'];
						$imagelink = '<img src="'.$link.'"/>';	
						return $imagelink;		
										
					}
						
					else
					/*this code will be executed if neither image is loaded in product or category*/
					{
						$link = $baseUrl .'simplesizechartpopup/'.$this->helper->getChartImage();
						$imagelink = '<img src="'.$link.'"/>';	
						return $imagelink;
					}
				}
			}
			else 
			/*this code will be executed in case of block is selected in product*/
			{
				if(isset($_product['show_chart_in'])&&($_product['show_chart_in']==2))
				{
					if(isset($_product['static_block_id']) &&($_product['static_block_id']!=''))
					{
						$html = "<div class='for_block'>";	
						$html .= $this->getLayout()->createBlock('cms/block')->setBlockId($_product['static_block_id'])->toHtml();
						$html .= "</div>";	
						return $html;					
					}
					/*this will fetch for category block in case of missing of product block is absent*/
					else
					{
						if(isset($_category['static_block_id']) && ($_category['static_block_id']!=''))
						{
								
							$html = "<div class='for_block'>";	
							$html .= $this->getLayout()->createBlock('cms/block')->setBlockId($_category['static_block_id'])->toHtml();
							$html .= "</div>";	
							return $html;						
						}
						/*the following code will display global block if both product and category block are absent*/
						else 
						{
							$html = "<div class='for_block'>";
							$gblock=$this->helper->getChartBlock();	
							$html .= $this->getLayout()->createBlock('cms/block')->setBlockId($gblock)->toHtml();
							$html .= "</div>";	
							return $html;	
						}
					}			
				}	
			}		
		}
	/*this code will be executed in caseShow Size Chart Link is set no in  product and yes in category*/
	else 
	
	if(isset($_category['show_chart_link']) && $_category['show_chart_link']==1)
	{
		if(isset($_category['show_chart_in']) && $_category['show_chart_in']==1)
		{
			if(isset($_category['size_image']) && ($_category['size_image']!=''))
						{
							$link = $baseUrl .'catalog/category/'.$_category['size_image'];
							$imagelink = '<img src="'.$link.'"/>';					
							return $imagelink;							
						}
						else{
						$link = $baseUrl .'simplesizechartpopup/'.$this->helper->getChartImage();
							$imagelink = '<img src="'.$link.'"/>';	
							return $imagelink;}
		}
		else
		{
			if(isset($_category['show_chart_in']) && $_category['show_chart_in']==2)
				{
					if(isset($_category['static_block_id']) && ($_category['static_block_id']!=''))
					{
						$html = "<div class='for_block'>";	
						$html .= $this->getLayout()->createBlock('cms/block')->setBlockId($_category['static_block_id'])->toHtml();
						$html .= "</div>";	
						return $html;						
					}
					else 
					{
						$html = "<div class='for_block'>";
						$gblock=$this->helper->getChartBlock();	
						$html .= $this->getLayout()->createBlock('cms/block')->setBlockId($gblock)->toHtml();
						$html .= "</div>";	
					return $html;	
					}
				}
			
		}		
	}
	/*this code will be executed in caseShow Size Chart Link is set no in both product category */
	else
	{ 
		$global=Mage::getStoreConfig('simplesizechartpopup/license_status_group/status');
			if($global =='2')
			{ 
			$type=Mage::getStoreConfig('simplesizechartpopup/general_setting/sizecharttype');
			if($type==1)
			{
				$link = $baseUrl .'simplesizechartpopup/'.$this->helper->getChartImage();
							$imagelink = '<img src="'.$link.'"/>';	
							return $imagelink;
			}
			else
			{
				$html = "<div class='for_block'>";
				$gblock=$this->helper->getChartBlock();	
				$html .= $this->getLayout()->createBlock('cms/block')->setBlockId($gblock)->toHtml();
				$html .= "</div>";	
				return $html;
			}
			}
		else {return false;}
	}
	}	/*get chart source function ends here*/
}