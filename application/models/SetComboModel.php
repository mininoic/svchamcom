<?php
/**
 * Created by PhpStorm.
 * User: Trung
 * Date: 7/24/14
 * Time: 4:10 PM
 */

class SetComboModel {
    protected $_name = 'set_combo';
    protected $_id = 'id';

    public function getById($id = null){
        $db = Zend_Registry::get('connectDB');
        $mysql = $db->select()
                    ->from($this->_name)
                    ->where('id =?', $id)
                    ->where('status =?', 1);

        $result = $db->fetchRow($mysql);
        return $result;
    }

    public function listAll(){
        $db = Zend_Registry::get('connectDB');
        $mysql = $db->select()
                    ->from($this->_name)
                    ->where('status =?', 1);
        $result = $db->fetchAll($mysql);
        return $result;
    }

    public function insertSetCombo($options = null){
        $db = Zend_Registry::get('connectDB');
        $data = array(
            'name' => $options['name'],
            'img' => $options['img'],
            'short_desc' => $options['short_desc'],
            'long_desc' => $options['long_desc'],
            'status' => $options['status']
        );

        $result = $db->insert($this->_name, $data);
        return $result;
    }

    public function updateSetCombo($options = null, $id = null){
        $db = Zend_Registry::get('connectDB');

        $data = array();
        if($options['name'])
            $data['name'] = $options['name'];

        if($options['img'])
            $data['img'] = $options['img'];

        if($options['short_desc'])
            $data['short_desc'] = $options['short_desc'];

        if($options['long_desc'])
            $data['long_desc'] = $options['long_desc'];

        if($options['status'])
            $data['status'] = $options['status'];

        $result = $db->update($this->_name, $data, 'id = '.$id);
        return $result;
    }

    public function deleteSetCombo($id = null){
        $db = Zend_Registry::get('connectDB');

        $result = $db->delete($this->_name, 'id ='.$id);
        return $result;
    }
} 