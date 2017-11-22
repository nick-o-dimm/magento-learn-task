<?php

class Itr_ShippingInsurance_Model_Sales_Order_Invoice_Total_Insurancefee
    extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        $order = $invoice->getOrder();

        if ((bool) $order->getShippingInsuranceApplied()) {
            $invoice->setGrandTotal($invoice->getGrandTotal() + $order->getShippingInsuranceFee());
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $order->getShippingInsuranceFee());
        }

        return $this;
    }
}
