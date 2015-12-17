<?php

class TM_SuggestPage_Block_Cart extends Mage_Checkout_Block_Cart_Sidebar
{
    protected function _prepareLayout()
    {
        if (!Mage::registry('product')) {
            $productId = Mage::getSingleton('checkout/session')->getSuggestpageProductId();
            if (!$productId) {
                return false;
            }

            $product = Mage::getModel('catalog/product')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->load($productId);
            if (!$product->getId()) {
                return false;
            }
            Mage::register('product', $product);
        }
    }

    public function getLastAddedQuoteItem()
    {
        if (!Mage::registry('suggestpage_quote_item')) {
            $itemId = Mage::getSingleton('checkout/session')->getSuggestpageQuoteItemId();
            if (!$itemId) {
                return false;
            }

            $item = $this->getQuote()->getItemsCollection()->getItemById($itemId);
            if (!$item->getId()) {
                return false;
            }
            Mage::register('suggestpage_quote_item', $item);
        }
        return Mage::registry('suggestpage_quote_item');
    }
}
