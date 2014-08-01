<?php
class CouponModel extends Zend_Db_Table{
    protected $_name = "coupon";
    protected $_primary = "id";

    public function checkCoupon($coupon = null){
        $db = Zend_Registry::get('connectDB');

        $mysql = $db->select()
                    ->from($this->_name);

        if($coupon){
            $time = new Date();
            $mysql->where('coupon =?', $coupon);
            $mysql->where('time_exprire <=?', $time);
            $result = $db->fetchRow($mysql);
            return $result['discount'];
        }else{
            return 0;
        }
    }
}
?>