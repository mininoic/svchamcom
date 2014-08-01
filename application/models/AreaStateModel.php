<?php
/**
 * Created by PhpStorm.
 * User: Trung
 * Date: 7/24/14
 * Time: 7:13 PM
 */

class AreaStateModel extends Zend_Db_Table{
    protected $_name = "area_state";
    protected $_primary = "id";

    public function listAll($country_id = null){
        $db = Zend_Registry::get('connectDB');
        $mysql = $db->select()
            ->from($this->_name);

        if($country_id){
            $mysql->where('parent_id =?', $country_id);
        }
        $mysql->where('status =?', 1);

        $result = $db->fetchAll($mysql);
        return $result;
    }
    public function insertAreaState($options = null){
        $db = Zend_Registry::get('connectDB');
        $data = array(
            'parent_id' => $options['parent_id'],
            'name' => $options['name'],
            'desc' => $options['desc'],
            'status' => $options['status']
        );

        $result = $db->insert($this->_name, $data);
        return $result;
    }

    public function updateAreaState($options = null, $id = null){
        $db = Zend_Registry::get('connectDB');
        $data = array();
        if($options['parent_id'])
            $data['parent_id'] = $options['parent_id'];

        if($options['name'])
            $data['name'] = $options['name'];

        if($options['desc'])
            $data['desc'] = $options['desc'];

        if($options['status'])
            $data['status'] = $options['status'];

        $result = $db->update($this->_name, $data, 'id = '.$id);
        return $result;
    }

    public function deleteAreaState($id = null){
        $db = Zend_Registry::get('connectDB');

        $result = $db->delete($this->_name,'id = '.$id);
    }
} 