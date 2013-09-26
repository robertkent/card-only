<?php

class Creare_CardOnly_Model_Observer
{
	public function cardOnly(Varien_Event_Observer $observer)
	{
		$event           = $observer->getEvent();
        $method          = $event->getMethodInstance();
        $result          = $event->getResult();
		$cardonly		 = false;
		
		foreach (Mage::getSingleton('checkout/cart')->getQuote()->getAllVisibleItems() as $item)
		{
			$product = Mage::getModel('catalog/product')->load($item->getProductId());
			if($product->getCardOnly()){
				$cardonly = true;	
			}
		}

		if($method->getCode() == "checkmo" && $cardonly){
			$result->isAvailable = false;
		}
		
	}
}