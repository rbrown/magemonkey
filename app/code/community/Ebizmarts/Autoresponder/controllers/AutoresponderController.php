<?php

/**
 *
 * @category   Ebizmarts
 * @package    Ebizmarts_Autoresponder
 * @author     Ebizmarts Team <info@ebizmarts.com>
 * @license    http://opensource.org/licenses/osl-3.0.php
 */

class Ebizmarts_Autoresponder_AutoresponderController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        if(!Mage::helper('customer')->isLoggedIn()) {
            $this->_redirect('/');
        }
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        $navigationBlock = $this->getLayout()->getBlock('customer_account_navigation');
        $this->getLayout()->getBlock('head')->setTitle($this->__('Newsletter Subscription'));
        $this->renderLayout();


    }
    public function unsubscribeAction(){
        $params = $this->getRequest()->getParams();
        if(isset($params['email'])&&isset($params['list'])&&$params['store']) {
            $collection = Mage::getModel('ebizmarts_autoresponder/unsubscribe')->getCollection();
            $collection->addFieldToFilter('main_table.email',array('eq'=>$params['email']))
                        ->addFieldToFilter('main_table.list',array('eq'=>$params['list']))
                        ->addFieldToFilter('main_table.store_id',array('eq'=>$params['store']));
            if($collection->getSize() == 0) {
                $unsubscribe = Mage::getModel('ebizmarts_autoresponder/unsubscribe');
                $unsubscribe->setEmail($params['email'])
                            ->setList($params['list'])
                            ->setStoreId($params['store']);
                $unsubscribe->save();
            }
            $customer = Mage::getModel('customer/customer');
            $customer->setStore(Mage::app()->getStore($params['store']))->loadByEmail($params['email']);
            Mage::log('customer before', null, 'Santiago.log', true);
            Mage::log($customer->getEmail(), null, 'Santiago.log', true);
            Mage::log('token before', null, 'Santiago.log', true);
            Mage::log($customer->getAutoresponderToken(), null, 'Santiago.log', true);
            $customer->setAutoresponderToken(NULL);
            $customer->save();
            Mage::log('---Customer---', null, 'Santiago.log', true);
            Mage::log($customer->getEmail(), null, 'Santiago.log', true);
            Mage::log('---Customer token2---', null, 'Santiago.log', true);
            Mage::log($customer->getAutoresponderToken(), null, 'Santiago.log', true);
        }
        $this->loadLayout();
        $this->renderLayout();
    }

    public function savelistAction()
    {
        if(!Mage::helper('customer')->isLoggedIn()) {
            $this->_redirect('/');
        }
        $params = $this->getRequest()->getParams();
        $lists = Mage::helper('ebizmarts_autoresponder')->getLists();
        $email = Mage::helper('customer')->getCustomer()->getEmail();
        $storeId = Mage::app()->getStore()->getStoreId();

        foreach($lists as $key => $list) {
            $collection = Mage::getModel('ebizmarts_autoresponder/unsubscribe')->getCollection();
            $collection->addFieldToFilter('main_table.email',array('eq'=>$email))
                        ->addFieldToFilter('main_table.list',array('eq'=>$key))
                        ->addFieldToFilter('main_table.store_id',array('eq'=>$storeId));
            if(array_key_exists($key,$params) && $collection->getSize() > 0) { //try to remove
                $collection->getFirstItem()->delete();
            }
            else if(!array_key_exists($key,$params)&&$collection->getSize() == 0){
                $unsubscribe = Mage::getModel('ebizmarts_autoresponder/unsubscribe');
                $unsubscribe->setEmail($email)
                            ->setList($key)
                            ->setStoreId($storeId);
                Mage::log($unsubscribe);
                $unsubscribe->save();
            }
        }
        Mage::getSingleton('core/session')
            ->addSuccess($this->__('Lists updated'));

        $this->_redirect('ebizautoresponder/autoresponder');
    }

    protected function _getCustomerId()
    {
        if(Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customerData = Mage::getSingleton('customer/session')->getCustomer();
            return $customerData->getIdgetId();
        }
    }

    public function getVisitedProductsConfigAction()
    {
        $params = $this->getRequest()->getParams();
        $storeId = Mage::app()->getStore()->getStoreId();
        if(Mage::getStoreConfig(Ebizmarts_Autoresponder_Model_Config::VISITED_ACTIVE,$storeId)&&Mage::getSingleton('customer/session')->isLoggedIn()) {
            if(isset($params['product_id'])) {
                $product = Mage::getModel('catalog/product')->load($params['product_id']);
                $mark = $product->getAttributeText('ebizmarts_mark_visited');
                if($mark == 'Yes') {
                    $resp['time'] = Mage::getStoreConfig(Ebizmarts_Autoresponder_Model_Config::VISITED_TIME,$storeId);
                }
                else {
                    $resp['time'] = -1;
                }
            }
        }
        else {
            $resp['time'] = -1;
        }
        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($resp));
        return;
    }
    public function markVisitedProductsAction()
    {
        $params = $this->getRequest()->getParams();
        if(!isset($params['product_id'])||!Mage::getSingleton('customer/session')->isLoggedIn()) {
            return;
        }
        $storeId = Mage::app()->getStore()->getStoreId();
        $customerId = Mage::getSingleton('customer/session')->getCustomer()->getId();
        $visited = Mage::getModel('ebizmarts_autoresponder/visited')->loadByCustomerProduct($customerId,$params['product_id'],$storeId);
        $visited->setCustomerId($customerId)
                ->setProductId($params['product_id'])
                ->setStoreId($storeId)
                ->setVisitedAt(Mage::getModel('core/date')->gmtDate())
                ->save();
    }

    public function loadquoteAction()
    {
        $params = $this->getRequest()->getParams();
        if(isset($params['id']))
        {
            //restore the quote
//            Mage::log($params['id']);


            $quote = Mage::getModel('customer/customer')->load($params['id']);
            Mage::log('---Customer---', null, 'Santiago.log', true);
            Mage::log($quote->getEmail(), null, 'Santiago.log', true);
            Mage::log('---Customer token---', null, 'Santiago.log', true);
            Mage::log($quote->getAutoresponderToken(), null, 'Santiago.log', true);
            $url = Mage::getStoreConfig(Ebizmarts_Autoresponder_Model_Config::PAGE,$quote->getStoreId()).'/id/'.$params['itemId'];
            if(isset($params['token'])){
                $url .= '/token/'.$params['token'];
            }
            if(!isset($params['token2']) || (isset($params['token2'])&&$params['token2']!=$quote->getAutoresponderToken())) {
                //Mage::getSingleton('customer/session')->addNotice("Your review token is incorrect");
                $this->_redirect($url);
            }
            else {
                $session = Mage::getSingleton('customer/session');
                $session->loginById($params['id']);
                $this->_redirect($url);
            }
        }else{
            $url = 'review/product/list/id/'.$params['itemId'];
            $this->_redirect($url);
        }
    }
}