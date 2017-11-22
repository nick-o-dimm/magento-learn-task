<?php

class Itr_ShippingInsurance_Model_Sales_Order_Creditmemo_Total_Insurancefee
    extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
    {
        $order = $creditmemo->getOrder();

        if ((bool) $order->getShippingInsuranceApplied()) {
            $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $order->getShippingInsuranceFee());
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $order->getShippingInsuranceFee());
        }

        return $this;
    }
}
