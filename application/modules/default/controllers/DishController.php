<?php

class DishController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_arrParam = $this->_request->getParams();

        Zend_Loader::loadClass('DishModel');
    }
    public function indexAction()
    {
        echo "dish page";
    }

    public function listAction(){
//        $date = $_POST['date'];
        $date = '2014-07-02';
        $DishModel = new DishModel();
        $DishModel->listByDate($date);


    }


}

