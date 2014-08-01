<?php
/**
 * Created by PhpStorm.
 * User: Trung
 * Date: 7/28/14
 * Time: 2:46 PM
 */

class Api_OrderController extends Zend_Controller_Action{
    public function init(){
        $this->_arrParam = $this->_request->getParams();
        $this->view->controller = $this->_request->getParam('controller');
        $this->view->action = $this->_request->getParam('action');

        Zend_Loader::loadClass("DishModel");
        Zend_Loader::loadClass("UserModel");
        Zend_Loader::loadClass("CouponModel");
        Zend_Loader::loadClass("OrderModel");
        Zend_Loader::loadClass("AddressModel");
        Zend_Loader::loadClass("AreaCountryModel");
        Zend_Loader::loadClass("AreaStateModel");
        Zend_Loader::loadClass("AreaDistrictModel");

        $this->_time = new DateTime();
        $this->_time->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
    }

    public function createOrderAction(){

    }
} 