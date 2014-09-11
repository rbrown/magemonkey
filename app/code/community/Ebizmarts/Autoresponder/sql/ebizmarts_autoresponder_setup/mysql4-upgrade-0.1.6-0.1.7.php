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

$installer->run("

	ALTER TABLE customer_entity ADD autoresponder_token varchar(255) after disable_auto_group_change;
");

$installer->endSetup();