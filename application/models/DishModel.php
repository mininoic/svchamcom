<?php
class DishModel extends Zend_Db_Table{
    protected $_name = 'dish';
    protected $_primary = 'id';

    public function listAll(){
        $db = Zend_Registry::get('connectDB');
        $mysql = $db->select()
                    ->from($this->_name)
                    ->where('status =?', 1);

        $result = $db->fetchAll($mysql);
        return $result;
    }

    public function getDishById($id = null){
        $db = Zend_Registry::get('connectDB');
        $mysql = $db->select()
                    ->from($this->_name)
                    ->where('id =?', $id)
                    ->where('status =?', 1);

        $result = $db->fetchRow($mysql);
        return $result;
    }

    public function listByCategory($category_id = null){
        $db = Zend_Registry::get('connectDB');
        $mysql = $db->select()
            ->from($this->_name)
            ->where('status =?', 1);

        if($category_id){
            $mysql->where('category_id =?', $category_id);
        }

        $result = $db->fetchAll($mysql);
        return $result;
    }

    public function getPriceDish($id){
        $db = Zend_Registry::get('connectDB');
        $mysql = $db->select()
                    ->from($this->_name)
                    ->where('id =?', $id);

        $result = $db->fetchRow($mysql);
        return $result;
    }

    public function insertDish($options = null){
        $db = Zend_Registry::get('connectDB');
        $data = array(
            'dish_category_id' => $options['dish_category_id'],
            'name' => $options['name'],
            'short_desc' => $options['short_desc'],
            'long_desc' => $options['long_desc'],
            'avatar' => $options['avatar'],
            'cover' => $options['cover'],
            'price' => $options['price'],
            'nutrition_value' => $options['nutrition_value'],
            'quality' => $options['quality'],
            'time_create' => $options['time_create'],
            'time_update' => $options['time_update'],
            'status' => $options['status']
        );

        $result = $db->insert($this->_name, $data);
        return $result;
    }

    public function updateDish($options = null, $id = null){
        $db = Zend_Registry::get('connectDB');
        $data = array();
        if($options['dish_category_id'])
            $data['dish_category_id'] = $options['dish_category_id'];

        if($options['name'])
            $data['name'] = $options['name'];

        if($options['short_desc'])
            $data['short_desc'] = $options['short_desc'];

        if($options['long_desc'])
            $data['long_desc'] = $options['long_desc'];

        if($options['img'])
            $data['img'] = $options['img'];

        if($options['price'])
            $data['price'] = $options['price'];

        if($options['quality'])
            $data['quality'] = $options['quality'];

        if($options['price'])
            $data['price'] = $options['price'];

        if($options['status'])
            $data['status'] = $options['status'];

        $data['time_update'] = $options['time_update'];

        $result = $db->update($this->_name, $data, 'id = '.$id);
        return $result;
    }

    public function deleteDish($id){
        $db = Zend_Registry::get('connectDB');

        $result = $db->delete($this->_name, 'id = '.$id);
        return  $result;
    }
}