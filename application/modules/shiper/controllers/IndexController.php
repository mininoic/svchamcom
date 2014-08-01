<?php

class Shiper_IndexController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->_arrParam = $this->_request->getParams();
    }
    public function indexAction()
    {
        echo "home page";die;
    }
}

