<?php
/**
 * Created by PhpStorm.
 * User: santiago
 * Date: 9/12/14
 * Time: 4:01 PM
 */
class Ebizmarts_Autoresponder_Model_Resource_Eav_Mysql4_Setup extends Mage_Eav_Model_Entity_Setup
{
    public function getDefaultEntities()
    {

        /*'website_id'         => array(
                        'type'               => 'static',
                        'label'              => 'Associate to Website',
                        'input'              => 'select',
                        'source'             => 'customer/customer_attribute_source_website',
                        'backend'            => 'customer/customer_attribute_backend_website',
                        'sort_order'         => 10,
                        'position'           => 10,
                        'adminhtml_only'     => 1,
                    ),
                    'store_id'           => array(
                        'type'               => 'static',
                        'label'              => 'Create In',
                        'input'              => 'select',
                        'source'             => 'customer/customer_attribute_source_store',
                        'backend'            => 'customer/customer_attribute_backend_store',
                        'sort_order'         => 20,
                        'visible'            => false,
                        'adminhtml_only'     => 1,
                    ),
                    'created_in'         => array(
                        'type'               => 'varchar',
                        'label'              => 'Created From',
                        'input'              => 'text',
                        'required'           => false,
                        'sort_order'         => 20,
                        'position'           => 20,
                        'adminhtml_only'     => 1,
                    ),
                    'prefix'             => array(
                        'type'               => 'varchar',
                        'label'              => 'Prefix',
                        'input'              => 'text',
                        'required'           => false,
                        'sort_order'         => 30,
                        'visible'            => false,
                        'system'             => false,
                        'position'           => 30,
                    ),
                    'firstname'          => array(
                        'type'               => 'varchar',
                        'label'              => 'First Name',
                        'input'              => 'text',
                        'sort_order'         => 40,
                        'validate_rules'     => 'a:2:{s:15:"max_text_length";i:255;s:15:"min_text_length";i:1;}',
                        'position'           => 40,
                    ),
                    'middlename'         => array(
                        'type'               => 'varchar',
                        'label'              => 'Middle Name/Initial',
                        'input'              => 'text',
                        'required'           => false,
                        'sort_order'         => 50,
                        'visible'            => false,
                        'system'             => false,
                        'position'           => 50,
                    ),
                    'lastname'           => array(
                        'type'               => 'varchar',
                        'label'              => 'Last Name',
                        'input'              => 'text',
                        'sort_order'         => 60,
                        'validate_rules'     => 'a:2:{s:15:"max_text_length";i:255;s:15:"min_text_length";i:1;}',
                        'position'           => 60,
                    ),
                    'suffix'             => array(
                        'type'               => 'varchar',
                        'label'              => 'Suffix',
                        'input'              => 'text',
                        'required'           => false,
                        'sort_order'         => 70,
                        'visible'            => false,
                        'system'             => false,
                        'position'           => 70,
                    ),
                    'email'              => array(
                        'type'               => 'static',
                        'label'              => 'Email',
                        'input'              => 'text',
                        'sort_order'         => 80,
                        'validate_rules'     => 'a:1:{s:16:"input_validation";s:5:"email";}',
                        'position'           => 80,
                        'admin_checkout'    => 1
                    ),
                    'group_id'           => array(
                        'type'               => 'static',
                        'label'              => 'Group',
                        'input'              => 'select',
                        'source'             => 'customer/customer_attribute_source_group',
                        'sort_order'         => 25,
                        'position'           => 25,
                        'adminhtml_only'     => 1,
                        'admin_checkout'     => 1,
                    ),
                    'dob'                => array(
                        'type'               => 'datetime',
                        'label'              => 'Date Of Birth',
                        'input'              => 'date',
                        'frontend'           => 'eav/entity_attribute_frontend_datetime',
                        'backend'            => 'eav/entity_attribute_backend_datetime',
                        'required'           => false,
                        'sort_order'         => 90,
                        'visible'            => false,
                        'system'             => false,
                        'input_filter'       => 'date',
                        'validate_rules'     => 'a:1:{s:16:"input_validation";s:4:"date";}',
                        'position'           => 90,
                        'admin_checkout'     => 1,
                    ),
                    'password_hash'      => array(
                        'type'               => 'varchar',
                        'input'              => 'hidden',
                        'backend'            => 'customer/customer_attribute_backend_password',
                        'required'           => false,
                        'sort_order'         => 81,
                        'visible'            => false,
                    ),
                    'default_billing'    => array(
                        'type'               => 'int',
                        'label'              => 'Default Billing Address',
                        'input'              => 'text',
                        'backend'            => 'customer/customer_attribute_backend_billing',
                        'required'           => false,
                        'sort_order'         => 82,
                        'visible'            => false,
                    ),
                    'default_shipping'   => array(
                        'type'               => 'int',
                        'label'              => 'Default Shipping Address',
                        'input'              => 'text',
                        'backend'            => 'customer/customer_attribute_backend_shipping',
                        'required'           => false,
                        'sort_order'         => 83,
                        'visible'            => false,
                    ),
                    'taxvat'             => array(
                        'type'               => 'varchar',
                        'label'              => 'Tax/VAT Number',
                        'input'              => 'text',
                        'required'           => false,
                        'sort_order'         => 100,
                        'visible'            => false,
                        'system'             => false,
                        'validate_rules'     => 'a:1:{s:15:"max_text_length";i:255;}',
                        'position'           => 100,
                        'admin_checkout'     => 1,
                    ),
                    */
        return array(
            'customer' => array(
                'entity_model'      => 'customer/customer',
                'attribute_model'   => 'customer/attribute',
                'table'             => 'customer/entity',
                'additional_attribute_table'     => 'customer/eav_attribute',
                'entity_attribute_collection'    => 'customer/attribute_collection',
                'attributes'        => array(
                    'autoresponder_token' => array(
                        'label'             => 'Autoresponder Review Token',
                        'type'              => 'varchar',
                        //'input'             => 'text',
                        'visible'           => true,
                        'required'          => false,
                        //'sort_order'         => 110,
                        //'visible'            => false,
                        //'system'             => false,
                        //'position'           => 110,
                        //'admin_checkout'     => 1,
                    )

                )
            )
        );
    }
}