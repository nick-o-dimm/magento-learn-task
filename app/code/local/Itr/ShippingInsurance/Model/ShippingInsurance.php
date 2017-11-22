<?php

class Itr_ShippingInsurance_Model_ShippingInsurance extends Mage_Core_Model_Abstract
{

    public static function getAllowedCarriers()
    {
        $result = array();
        $carriers = Mage::getSingleton('shipping/config')->getAllCarriers();
        foreach ($carriers as $carrierCode => $carrierModel) {
            if (!$carrierModel->isActive()) {
                continue;
            }
            if (Mage::helper('itr_shippinginsurance')->isInsuranceEnabledForCarrier($carrierCode)) {
                $result[] = $carrierCode;
            }
        }
        return $result;
    }

    public static function calcInsuranceFee($carrierCode, $itemPrice)
    {
        $rateType = (int) Mage::getStoreConfig('carriers/' . $carrierCode . '/insurance_rate_type');
        $rateValue = (float) Mage::getStoreConfig('carriers/' . $carrierCode . '/insurance_rate_value');

        if ($rateType === Itr_ShippingInsurance_Model_System_Config_Insurance_Ratetype::TYPE_FIXED_PRICE) {
            $insuranceFee = $rateValue;
        } else {
            $insuranceFee = $itemPrice * $rateValue/100;
        }

        return $insuranceFee;
    }

}
