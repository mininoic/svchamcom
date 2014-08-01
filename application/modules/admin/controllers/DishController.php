<?php
/**
 * Created by PhpStorm.
 * User: Trung
 * Date: 7/24/14
 * Time: 6:44 PM
 */

class Admin_DishController extends Zend_Controller_Action{
    protected $_arrParam;
    protected $_time;

    public function init(){
        $layoutPath = TEMPLATE_PATH ."/admin"  ;
        $option = array (	'layout' 		=> 'index',
            'layoutPath' 	=> $layoutPath );
        Zend_Layout::startMvc ( $option );

        $this->_arrParam = $this->_request->getParams();
        $this->view->controller = $this->_request->getParam('controller');
        $this->view->action = $this->_request->getParam('action');

        Zend_Loader::loadClass("DishModel");
        Zend_Loader::LoadClass('DishCategoryModel');
        Zend_Loader::LoadClass('UploadHandler');

        $this->_time = new DateTime();
        $this->_time->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
    }

    public function createAction(){
        $DishCategoryModel = new DishCategoryModel();
        $this->view->dish_categories = $DishCategoryModel->listAll();

        if($this->getRequest()->isPost()){
            $params = $_POST;
            // tao time create, time update
            $time_update = $time_create = $this->_time->format('Y-m-d H:i:sP');
            $params['time_create'] = $time_create;
            $params['time_update'] = $time_update;

            if(!isset($params['status'])) $params['status'] = 1;
            $DishModel = new DishModel();
            $DishModel->insertDish($params);

            $this->view->params = $params;
        }
    }

    public function editAction(){
        $id = $_GET['id'];

        $DishCategoryModel = new DishCategoryModel();
        $this->view->dish_categories = $DishCategoryModel->listAll();

        $DishModel = new DishModel();
        $this->view->dish = $DishModel->getDishById($id);


        if($this->getRequest()->isPost()){
            $params = $_POST;

            // tao time create, time update
            $time_update = $this->_time->format('Y-m-d H:i:sP');
            $params['time_update'] = $time_update;

            $DishModel = new DishModel();
            $data_respon = $DishModel->updateDish($params, $id);
            echo $data_respon;
        }
    }

    public function delAction(){
        $id = $_GET['id'];

        $DishModel = new DishModel();
        $data_respon = $DishModel->deleteDish($id);
        echo $data_respon;
    }
    public function uploadAction(){
        error_reporting(E_ALL | E_STRICT);
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        $UploadHandler = new UploadHandler();
    }
} 