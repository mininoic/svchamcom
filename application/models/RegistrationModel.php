<?php
/**
 * Created by PhpStorm.
 * User: Trung
 * Date: 7/24/14
 * Time: 5:54 PM
 */

class RegistrationModel {
    protected $_name = "registration";
    protected $_id = "id";

    public function listAll(){
        $db = Zend_Registry::get('connectDB');
        $mysql = $db->select()
            ->from($this->_name)
            ->where('status =?', 1);

        $result = $db->fetchAll($mysql);
        return $result;
    }
    public function insertRegistration($options = null){
        $db = Zend_Registry::get('connectDB');
        $data = array(
            'fullname' => $options['fullname'],
            'email' => $options['email'],
            'phone' => $options['phone'],
            'address_id' => $options['address_id'],
            'content' => $options['content'],
            'status' => $options['status']
        );

        $result = $db->insert($this->_name, $data);
        return $result;
    }

    public function updateRegistration($options = null, $id = null){
        $db = Zend_Registry::get('connectDB');
        $data = array();
        if($options['name'])
            $data['fullname'] = $options['fullname'];

        if($options['email'])
            $data['email'] = $options['email'];

        if($options['phone'])
            $data['phone'] = $options['phone'];

        if($options['address_id'])
            $data['address_id'] = $options['address_id'];

        if($options['content'])
            $data['content'] = $options['content'];

        if($options['status'])
            $data['status'] = $options['status'];

        $result = $db->update($this->_name, $data, 'id = '.$id);
        return $result;
    }
} 