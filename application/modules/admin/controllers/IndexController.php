<?php class Admin_IndexController extends Zend_Controller_Action{
    protected $_arrParam;
	public function init(){
        $layoutPath = TEMPLATE_PATH ."/admin"  ;
        $option = array (	'layout' 		=> 'index',
            'layoutPath' 	=> $layoutPath );
        Zend_Layout::startMvc ( $option );

        $this->_arrParam = $this->_request->getParams();
        $this->view->controller = $this->_request->getParam('controller');
        $this->view->action = $this->_request->getParam('action');

        Zend_Loader::loadClass("DishModel");
        Zend_Loader::loadClass("UserModel");
        Zend_Loader::loadClass('DishCategoryModel');
	}
	public function indexAction(){
		echo "admin index";
	}

    public function loginAction(){

    }

}?>