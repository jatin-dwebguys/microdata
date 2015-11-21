<?php

include(Mage::getBaseDir('lib') . '/simple_html_dom.php');

class Extendware_Microdata_Model_Observer extends Varien_Object {

    public function coreBlockAbstractToHtmlAfter(Varien_Event_Observer $observer) {
        $enable = Mage::getStoreConfig('microdatasection/micro/ismandatory');

        $containerselector = Mage::getStoreConfig('microdatasection/micro/containgerselector');
        $namecontainer = Mage::getStoreConfig('microdatasection/micro/namecontainer');
        $pricecontainer = Mage::getStoreConfig('microdatasection/micro/pricecontainer');
        $shortdescription = Mage::getStoreConfig('microdatasection/micro/descriptionselector');
        $reviewrating = Mage::getStoreConfig('microdatasection/micro/reviewrating');
        $offerprice = Mage::getStoreConfig('microdatasection/micro/offerprice');
        $offerpricebox = Mage::getStoreConfig('microdatasection/micro/offerpricebox');
        Mage::log($pricecontainer);
       
        if ($enable == 1) {
            $block = $observer->getBlock();

            if ($block instanceof Mage_Catalog_Block_Product_View) {
                $html = $observer->getTransport()->getHtml();
                //$object = new simple_html_dom();
               // $htmll=$object->load($html);
                $html = str_get_html($html);
              
                /*
                 * attribute set for main containger
                 */
                foreach ($html->find($containerselector) as $key => $p_tags) {
                    $p_tags->{'typeof'} = 'Product';
                    $p_tags->{'vocab'} = 'http://schema.org/';
                }
                
              
                /*
                 * attribute set for name div 
                 */
                foreach ($html->find($namecontainer) as $key => $name) {
                    $name->{'property'} = 'name';
                }
                /*
                 * attribute set for price div 
                 */
                foreach ($html->find($pricecontainer) as $key => $price) {
                    $price->{'property'} = 'price';
                }
                /*
                 * attribute set for short description div 
                 */
                foreach ($html->find($shortdescription) as $key => $description) {
                    $description->{'property'} = 'description';
                }
                
                /*
                 * attribute set for rating 
                 */
                foreach ($html->find($reviewrating) as $key => $rating) {
                    $rating->{'property'} = 'description';
                }
                
                 /*
                 * attribute set for offer price
                 */
                foreach ($html->find($offerprice) as $key => $offer) {
                    $offer->{'typeof'} = 'Offer';
                    $offer->{'property'} = 'offers';
                }
                foreach ($html->find($offerpricebox) as $key => $offer) {
                   $offer->{'property'} = 'price';
                }
              
                $observer->getTransport()->setHtml($html);
            }
        }
    }

}

