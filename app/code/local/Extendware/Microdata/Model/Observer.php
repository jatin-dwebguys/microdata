<?php

include(Mage::getBaseDir('lib') . '/simple_html_dom.php');

class Extendware_Microdata_Model_Observer extends Varien_Object {

    public function coreBlockAbstractToHtmlAfter(Varien_Event_Observer $observer) {




        $block = $observer->getBlock();
        if ($block instanceof Mage_Catalog_Block_Product_View) {
            $html = $observer->getTransport()->getHtml();
            $myFormHtml = 'Get your form HTML';
            
            $html = str_get_html($html);
           
            foreach($html->find('div[class="product-view"]') as $key => $p_tags) {
                   $p_tags->{'typeof'}= 'Product';
                $p_tags->{'vocab'} = 'http://schema.org/';
                    
            }

            $html = $myFormHtml . $html;
            $observer->getTransport()->setHtml($html);
        }
    }

}

