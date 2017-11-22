<?php

class Itr_ShippingInsurance_Model_Sales_Quote_Address_Total_Insurancefee
    extends Mage_Sales_Model_Quote_Address_Total_Abstract
{

    public function __construct()
    {
        $this->setCode('insurancefee');
    }

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);

        $this->_setAmount(0);
        $this->_setBaseAmount(0);

        $items = $this->_getAddressItems($address);
        if (!count($items)) {
            return $this;
        }

        if ((bool) $address->getShippingInsuranceApplied()) {
            $address->setGrandTotal($address->getGrandTotal() + $address->getShippingInsuranceFee());
            $address->setBaseGrandTotal($address->getBaseGrandTotal() + $address->getShippingInsuranceFee());
        }

        return $this;
    }

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        parent::fetch($address);

        if ((bool) $address->getShippingInsuranceApplied()) {
            $fee = $address->getShippingInsuranceFee();
            $address->addTotal(array(
                'code'  => $this->getCode(),
                'title' => Mage::helper('itr_shippinginsurance')->__('Shipping Insurance Fee'),
                'value' => $fee
            ));
        }

        return $this;
    }
}
