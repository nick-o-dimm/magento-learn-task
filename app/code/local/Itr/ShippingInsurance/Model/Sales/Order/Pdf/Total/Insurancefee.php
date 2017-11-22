<?php

class Itr_ShippingInsurance_Model_Sales_Order_Pdf_Total_Insurancefee extends Mage_Sales_Model_Order_Pdf_Total_Default
{

    public function getTotalsForDisplay()
    {
        $result = parent::getTotalsForDisplay();

        $order = $this->getOrder();

        if ((bool) $order->getShippingInsuranceApplied()) {
            $result[0]['amount'] = $order->formatPriceTxt( $order->getShippingInsuranceFee() );
        }

        return $result;
    }

}