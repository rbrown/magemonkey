<?php

/**
 *
 * @category   Ebizmarts
 * @package    Ebizmarts_Autoresponder
 * @author     Ebizmarts Team <info@ebizmarts.com>
 * @license    http://opensource.org/licenses/osl-3.0.php
 */

$installer = $this;

$installer->startSetup();

$installer->installEntities();

$installer->endSetup();

/*$installer->getConnection()->addColumn(
    $installer->getTable('customer_entity'), 'autoresponder_token', 'varchar(255)', null, array('default' => 'null', 'type' => 'static')
);

$installer->endSetup();*/