<?php

class Itr_ShippingInsurance_Model_System_Config_Insurance_Ratetype
{
    const TYPE_FIXED_PRICE = 0;
    const TYPE_PERCENT = 1;

    protected $_options;

    public function __construct()
    {
        $this->_options = array(
            array(
                'value' => self::TYPE_FIXED_PRICE,
                'label' => Mage::helper('itr_shippinginsurance')->__('Fixed Price')
            ),
            array(
                'value' => self::TYPE_PERCENT,
                'label' => Mage::helper('itr_shippinginsurance')->__('Percent')
            ),
        );
    }

    public function toOptionArray()
    {
        return $this->_options;
    }
}
