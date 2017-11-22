<?php

class Itr_ShippingInsurance_Block_Sales_Order_Total extends Mage_Sales_Block_Order_Totals
{
    public function initTotals()
    {
        $order = $this->getParentBlock()->getOrder();
        if ((bool) $order->getShippingInsuranceApplied()) {
            $this->getParentBlock()->addTotal(new Varien_Object(array(
                'code' => 'insurancefee',
                'value' => $order->getShippingInsuranceFee(),
                'base_value' => $order->getShippingInsuranceFee(),
                'label' => Mage::helper('itr_shippinginsurance')->__('Shipping Insurance Fee'),
            )));
        }
    }
}
