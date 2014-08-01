<?php
/**
 * Created by PhpStorm.
 * User: Trung
 * Date: 7/24/14
 * Time: 7:13 PM
 */

class AreaDistrictModel extends Zend_Db_Table{
    protected $_name = "area_district";
    protected $_primary = "id";

    public function listAll(){
        $db = Zend_Registry::get('connectDB');
        $mysql = $db->select()
            ->from($this->_name)
            ->where('status =?', 1);

        $result = $db->fetchAll($mysql);
        return $result;
    }

    public function listByState($state_id){
        $db = Zend_Registry::get('connectDB');
        $mysql = $db->select()
                    ->from($this->_name)
                    ->where('parent_id =?', $state_id)
                    ->where('status =?', 1);

        $result = $db->fetchAll($mysql);
        return $result;
    }

    public function insertAreaDistrict($options = null){
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

    public function updateAreaDistrict($options = null, $id = null){
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

    public function deleteAreaDistrict($id = null){
        $db = Zend_Registry::get('connectDB');

        $result = $db->delete($this->_name,'id = '.$id);
    }
} 