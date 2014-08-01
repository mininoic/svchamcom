<?php
/**
 * Created by PhpStorm.
 * User: Trung
 * Date: 7/29/14
 * Time: 9:34 AM
 */

class Admin_SetcomboController extends Zend_Controller_Action{
    protected $_arrParam;
    protected $_time;
    public function init(){
        $this->_arrParam = $this->_request->getParams();
        $this->view->controller = $this->_request->getParam('controller');
        $this->view->action = $this->_request->getParam('action');

        Zend_Loader::loadClass("DishModel");
        Zend_Loader::loadClass("DishCategoryModel");
        Zend_Loader::loadClass("SetComboModel");
        Zend_Loader::LoadClass("SetComboDishModel");

        $this->_time = new DateTime();
        $this->_time->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
    }

    public function createAction(){
        $DishModel = new DishModel();
        $DishCategoryModel  = new DishCategoryModel();
        $this->view->dish_categories = $DishCategoryModel->listAll();
        $this->view->list_dish = $DishModel->listAll();


        // co du lieu post len
        if($this->getRequest()->isPost()){
            $params_info = $_POST['info'];
            $params_dishs = $_POST['dishs'];

            $time_update = $time_create = $this->_time->format('Y-m-d H:i:sP');
            $params_info['time_create'] = $time_create;
            $params_info['time_update'] = $time_update;

            $SetComboModel = new SetComboModel();
            $data_respon = $SetComboModel->insertSetCombo($params_info);
            echo $data_respon;
        }else{
            // xu ly khi khong co du lieu post len
        }
    }

    public function editAction(){
        $set_combo_id = $_GET['id'];
        $DishModel = new DishModel();
        $DishCategoryModel  = new DishCategoryModel();
        $SetComboModel = new SetComboModel();
        $SetComboDishModel = new SetComboDishModel();

        $this->view->dish_categories = $DishCategoryModel->listAll();
        $this->view->list_dish = $DishModel->listAll();
        $this->view->set_combo = $SetComboModel->getById($set_combo_id);
        $this->view->set_combo_dishs = $SetComboDishModel->listBySetComboId($set_combo_id);

        if($this->getRequest()->isPost()){
            $params_info = $_GET['info'];
        }else{

        }
    }

    public function delAction(){

    }
} 