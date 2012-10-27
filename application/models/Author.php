<?php
class Application_Model_Author extends Zend_Db_Table_Abstract {

   protected $_name = 'authors';

   public function init()
   {
      $this->db = new Zend_Registry::get('db');
   }

   public function getOne($id)
   {
      $select = $this->db->select()->form('authors')->where("id='$id'");
      return array_pop($this->db->query($select)->fetchAll());
      
      // code...
   }
   public function getLookup($id)
   {
      $select = $this->db->select()->form('authors')
      ->where("first_name = '$data[first_name]'")
      ->where("last_name = '$data[last_name]'");
      return array_pop($this->db->query($select)->fetchAll());

      // code...
   }
}
?>
