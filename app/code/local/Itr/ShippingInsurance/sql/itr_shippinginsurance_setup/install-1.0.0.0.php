<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

/**
 * Adding Extra Column to sales_flat_quote_address
 * to store the shipping insurance fields
 */
$sales_quote_address = $installer->getTable('sales/quote_address');
$installer->getConnection()
    ->addColumn($sales_quote_address, 'shipping_insurance_applied', array(
        'type'     => Varien_Db_Ddl_Table::TYPE_BOOLEAN,
        'nullable' => false,
        'default'  => 0,
        'comment'  => 'Shipping insurance is used'
    ));
$installer->getConnection()
    ->addColumn($sales_quote_address, 'shipping_insurance_fee', array(
        'type'     => Varien_Db_Ddl_Table::TYPE_DECIMAL,
        'length'   => '12,4',
        'nullable' => false,
        'default'  => '0.0000',
        'comment'  => 'Shipping insurance Fee'
    ));

/**
 * Adding Extra Column to sales_flat_order
 * to store the shipping insurance fields
 */
$sales_order = $installer->getTable('sales/order');
$installer->getConnection()
    ->addColumn($sales_order, 'shipping_insurance_applied', array(
        'type'     => Varien_Db_Ddl_Table::TYPE_BOOLEAN,
        'nullable' => false,
        'default'  => 0,
        'comment'  => 'Shipping insurance is used'
    ));
$installer->getConnection()
    ->addColumn($sales_order, 'shipping_insurance_fee', array(
        'type'     => Varien_Db_Ddl_Table::TYPE_DECIMAL,
        'length'   => '12,4',
        'nullable' => false,
        'default'  => '0.0000',
        'comment'  => 'Shipping insurance Fee'
    ));
