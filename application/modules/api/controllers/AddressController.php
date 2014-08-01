<?php
/**
 * Created by PhpStorm.
 * User: Trung
 * Date: 7/24/14
 * Time: 7:08 PM
 */

class Api_AddressController extends Zend_Controller_Action{
    protected $_arrParam;

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

    public function listCountryAction(){
        $AreaStateModel = new AreaStateModel();
        $rows = $AreaStateModel->listAll();

        $this->getHelper('json')->sendJson($rows);
    }

    public function listStateAction(){
//        $this->_arrParam['f'];
        $country_id = $this->_arrParam['v'];
        $AreaStateModel = new AreaStateModel($country_id);
        $rows = $AreaStateModel->listAll();

        $this->getHelper('json')->sendJson($rows);
    }

    public function listDistrictAction(){
        $AreaDistrictModel = new AreaDistrictModel();

        $state_id = $_GET['v'];
        $rows = $AreaDistrictModel->listByState($state_id);

        $this->getHelper('json')->sendJson($rows);
    }
} 