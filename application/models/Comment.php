<?php
class Application_Model_Comment extends Zend_Db_Table_Abstract {

   protected $_name = 'comments';
   public function init()
   {
      $this->db = Zend_Registry::get('db');
      require_once dirname(__FILE__).'/../utils/Crypto.php';
   }

   public function save($data)
   {
      $author = Zend_Registry::get('author');
      if (empty($data['author_id'])) {
         $data['author_id'] = $author['id'];

         // code...
      }
      if (empty($data['id'])) {
         $data['id'] = Crypto::uuid();

         // code...
      }
      return $this->insert($data);
   }
   }
?>
