<?php
class DishCategoryModel extends Zend_Db_Table{
    protected $_name = "dish_categories";
    protected $_primary = "id";

    public function listAll(){
        $db = Zend_Registry::get('connectDB');
        $mysql = $db->select()
                    ->from($this->_name)
                    ->where('status =?', 1);

        $result = $db->fetchAll($mysql);
        return $result;
    }
    public function insertDishCategory($options = null){
        $db = Zend_Registry::get('connectDB');
        $data = array(
            'name' => $options['name'],
            'desc' => $options['desc'],
            'status' => $options['status']
        );

        $result = $db->insert($this->_name, $data);
        return $result;
    }

    public function updateDishCategory($options = null, $id = null){
        $db = Zend_Registry::get('connectDB');
        $data = array();
        if($options['name'])
              $data['name'] = $options['name'];

        if($options['desc'])
            $data['desc'] = $options['desc'];

        if($options['status'])
            $data['status'] = $options['status'];

        $result = $db->update($this->_name, $data, 'id = '.$id);
        return $result;
    }

    public function deleteDishCategory($id = null){
        $db = Zend_Registry::get('connectDB');

        $result = $db->delete($this->_name,'id = '.$id);
    }
}
?>