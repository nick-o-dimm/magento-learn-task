<?php

class Itr_ShippingInsurance_Model_Observer {

    public function checkoutControllerOnepageSaveShippingMethod($observer)
    {
        /** @var Mage_Core_Controller_Request_Http $request */
        $request = $observer->getEvent()->getRequest();

        /** @var Itr_ShippingInsurance_Helper_Data $helper */
        $helper = Mage::helper('itr_shippinginsurance');

        /** @var Mage_Sales_Model_Quote $quote */
        $quote = $observer->getQuote();

        $shippingMethod = $request->getPost('shipping_method', '');
        $carrierName = $helper->getCarrierNameFromMethod($shippingMethod);

        $isInsuranceApplied = $helper->isShippingInsuranceEnabled()
            && (bool) $request->getPost('shipping_insurance_applied')
            && $helper->isInsuranceEnabledForCarrier($carrierName);

        $insuranceFee = 0.0;
        if ($isInsuranceApplied) {
            $insuranceFee = Itr_ShippingInsurance_Model_ShippingInsurance::calcInsuranceFee($carrierName, $quote->getSubtotal());
        }
        $insuranceFee = round($insuranceFee, 2);

        $address = $observer->getQuote()->getShippingAddress();
        $address->setShippingInsuranceApplied((int)$isInsuranceApplied);
        $address->setShippingInsuranceFee($insuranceFee);
        $address->save();
    }

}
