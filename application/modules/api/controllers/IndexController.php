<?php class Api_IndexController extends Zend_Controller_Action{
    protected $_arrParam;
    protected $_time;
	public function init(){
        $this->_arrParam = $this->_request->getParams();
        $this->view->controller = $this->_request->getParam('controller');
        $this->view->action = $this->_request->getParam('action');

        Zend_Loader::loadClass("DishModel");
        Zend_Loader::loadClass("UserModel");
        Zend_Loader::loadClass("CouponModel");
        Zend_Loader::loadClass("OrderModel");

        $this->_time = new DateTime();
        $this->_time->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
	}
	public function indexAction(){
		echo "admin index";die;
	}
    public function infouserAction(){

    }
    public function listDishAction(){

    }
    public function listDishCategory(){

    }


    // dat hang
    public function orderAction(){
        //model
        $CouponModel = new CouponModel();
        $DishModel = new DishModel();
        $OrderModel = new OrderModel();

        //$data = $_POST;
        $data = array(
            'coupon' => 'abc',
            'dishs' => array(
                array(
                    'dishId' => '1',
                    'number' => '2'
                ),
                array(
                    'dishId' => '2',
                    'number' => '1'
                ),
            ),
            'discount' => '0.09',
            'time_create' => '2014/7/15 3:03:39',
            'address_delivery' => '',
            'phone' => '',
            'time_delivery' => ''
        );

        //xu ly don hang

        $total_paid = 0;
        $dishs_paid = 0;
        $dishs = $data['dishs'];
        foreach($dishs as $dish){
            $result_price_dish = $DishModel->getPriceDish($dish['dishId']);
            if($result_price_dish){
                $dishs_paid += $result_price_dish['price'] * $dish['number'];
            }else{
                $data_respon = array(
                    'status' => 'error',
                    'message' => 'Món ăn bạn đưa vào lỗi!'
                );
                return $this->_helper->json->sendJson($data_respon);
                die;
            }
        }

        // - check coupon
        $res_checkCoupon = $CouponModel->checkCoupon($data['coupon']);

        // - check discount
        $time = new Date();

        //xu ly thanh toan


    }

    public function checkCouponAction(){
        //model
        $CouponModel = new CouponModel();

        $coupon = $_POST['c'];
        $discount = $CouponModel->checkCoupon($coupon);

        $data_respon = array();

        if($discount > 0){
            $data_respon = array(
                'status' => 'fail',
                'message' => ''
            );
        }else{
            $data_respon = array(
                'status' => 'success',
                'data' => $discount
            );
        }
        die;
    }
}?>