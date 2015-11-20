<?php

class Extendware_Microdata_Model_Observer extends Varien_Object {
  
    
    public function coreBlockAbstractToHtmlAfter(Varien_Event_Observer $observer)
    {
         $block = $observer->getBlock();
        if ($block instanceof Mage_Catalog_Block_Product_View) {
            $html = $observer->getTransport()->getHtml();
            $myFormHtml = 'Get your form HTML';
            $html = $myFormHtml . $html;
            $observer->getTransport()->setHtml($html);
        }
        
    }
}
