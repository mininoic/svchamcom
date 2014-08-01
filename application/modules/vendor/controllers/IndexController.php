<?php class Vendor_IndexController extends Zend_Controller_Action{
    protected $_arrParam;
    public function init(){
        $layoutPath = TEMPLATE_PATH ."/vendor";
        $option = array (	'layout' 		=> 'index',
            'layoutPath' 	=> $layoutPath );
        Zend_Layout::startMvc ( $option );

        $this->_arrParam = $this->_request->getParams();
        $this->view->controller = $this->_request->getParam('controller');
        $this->view->action = $this->_request->getParam('action');

        Zend_Loader::loadClass("DishModel");
        Zend_Loader::loadClass("UserModel");
        Zend_Loader::loadClass('OrderModel');
        Zend_Loader::loadClass('OrderVendorModel');
    }
	public function indexAction(){
		echo "vendor index";die;
	}
}?>