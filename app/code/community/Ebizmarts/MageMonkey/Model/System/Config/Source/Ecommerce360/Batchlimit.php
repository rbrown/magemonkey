<?php

/**
 * Ecommerce360 Batch Limit config source options
 *
 * @category   Ebizmarts
 * @package    Ebizmarts_MageMonkey
 * @author     Ebizmarts Team <info@ebizmarts.com>
 * @license    http://opensource.org/licenses/osl-3.0.php
 */

class Ebizmarts_MageMonkey_Model_System_Config_Source_Ecommerce360_Batchlimit
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 0, 'label' => Mage::helper('monkey')->__('-- Disabled --')),
            array('value' => 100, 'label' => Mage::helper('monkey')->__('100')),
            array('value' => 500, 'label' => Mage::helper('monkey')->__('500')),
            array('value' => 1000, 'label' => Mage::helper('monkey')->__('1000')),
            array('value' => 5000, 'label' => Mage::helper('monkey')->__('5000'))
        );
    }
}