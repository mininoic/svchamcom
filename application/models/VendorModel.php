<?php
/**
 * Created by PhpStorm.
 * User: Trung
 * Date: 7/24/14
 * Time: 2:55 PM
 */

class VendorModel {
    protected $_name = 'vendor';
    protected $_primary = 'id';

    public function listAll(){
        $db = Zend_Registry::get('connectDB');
        $mysql = $db->select()
            ->from($this->_name)
            ->where('status =?', 1);
        $result = $db->fetchAll($mysql);
        return $result;
    }

    public function insertVendor($options = null){
        $db = Zend_Registry::get('connectDB');
        $data = array(
            'name' => $options['name'],
            'logo' => $options['logo'],
            'desc' => $options['desc'],
            'address_id' => $options['address_id'],
            'phone' => $options['phone'],
            'time_start' => $options['time_start'],
            'time_expire' => $options['time_expire'],
            'time_update' => $options['time_update'],
            'scope' => $options['scope'],
            'status' => $options['status']
        );

        $result = $db->insert($this->_name, $data);
        return $result;
    }

    public function updateVendor($options = null, $id = null){
        $db = Zend_Registry::get('connectDB');

        $data = array();
        if($options['name'])
            $data['name'] = $options['name'];

        if($options['logo'])
            $data['logo'] = $options['logo'];

        if($options['desc'])
            $data['desc'] = $options['desc'];

        if($options['address_id'])
            $data['address_id'] = $options['address_id'];

        if($options['phone'])
            $data['phone'] = $options['phone'];

        if($options['time_start'])
            $data['time_start'] = $options['time_start'];

        if($options['time_expire'])
            $data['time_expire'] = $options['time_expire'];

        if($options['time_update'])
            $data['time_update'] = $options['time_update'];

        if($options['scope'])
            $data['scope'] = $options['scope'];

        if($options['status'])
            $data['status'] = $options['status'];

        $result = $db->update($this->_name, $data, 'id = '.$id);
        return $result;
    }

    public function deleteVendor($id = null){
        $db = Zend_Registry::get('connectDB');

        $result = $db->delete($this->_name, 'id ='.$id);
        return $result;
    }
} 