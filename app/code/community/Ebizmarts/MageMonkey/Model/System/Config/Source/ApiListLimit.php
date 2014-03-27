<?php

/**
 * MailChimp lists source file
 *
 * @category   Ebizmarts
 * @package    Ebizmarts_MageMonkey
 * @author     Ebizmarts Team <info@ebizmarts.com>
 * @license    http://opensource.org/licenses/osl-3.0.php
 */

class Ebizmarts_MageMonkey_Model_System_Config_Source_ApiListLimit
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => '25', 'label' => Mage::helper('monkey')->__('%s lists', '25')),
            array('value' => '50', 'label' => Mage::helper('monkey')->__('%s lists', '50')),
            array('value' => '100', 'label' => Mage::helper('monkey')->__('%s lists', '100')),
            array('value' => '150', 'label' => Mage::helper('monkey')->__('%s lists', '150')),
            array('value' => '200', 'label' => Mage::helper('monkey')->__('%s lists', '200')),
        );

    }

}
