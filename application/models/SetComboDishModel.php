<?php
/**
 * Created by PhpStorm.
 * User: Trung
 * Date: 7/29/14
 * Time: 9:53 AM
 */

class SetComboDishModel extends Zend_Db_Table{
    protected $_name = "set_combo_dish";
    protected $_primary = "id";

    public function listBySetComboId($set_combo_id = null){
        $db = Zend_Registry::get('connectDB');
        $mysql = $db->select()
                    ->from($this->_name)
                    ->where('set_combo_id =?', $set_combo_id);

        $result = $db->fetchRow($mysql);
        return $result;
    }

    public function insertSetComboDish($options = null){
        $db = Zend_Registry::get('connectDB');

        $data = array(
            'dish_id' => $options['dish_id'],
            'set_combo_id' => $options['set_combo_id'],
            'number' => $options['number']
        );

        $result = $db->insert($this->_name, $data);
        return $result;
    }

    public function delSetComboDish($set_combo_id =  null){
        $db = Zend_Registry::get('connectDB');
        $result = $db->delete($this->_name, 'set_combo_id ='.$set_combo_id);

        return $result;
    }
} 