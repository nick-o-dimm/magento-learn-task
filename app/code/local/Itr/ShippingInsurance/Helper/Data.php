<?php

class Itr_ShippingInsurance_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function isShippingInsuranceEnabled()
    {
        return (bool) Mage::getStoreConfig('shippinginsurance/option/active');
    }

    public function isInsuranceEnabledForCarrier($carrierCode)
    {
        return (bool) Mage::getStoreConfig('carriers/'.$carrierCode.'/insurance_enabled');
    }

    public function getCarrierNameFromMethod($shippingMethod)
    {
        $pos = strpos($shippingMethod, '_');
        $carrierName = substr($shippingMethod, 0, $pos);

        return $carrierName;
    }

}
