<?php
   class Application_Model_Post extends Zend_Db_Table_Abstract {

      protected $_name = 'posts';
      public function init()
      {
         $this->db = Zend_Registry::get('db');
         require_once dirname(__FILE__) . '/../utils/Crypto.php';

      }

      public function getAll()
      {
         $post = $this->fetchAll($this->select()->order('created DESC'));
         $final = array();
         foreach ($posts as $post) {
            $tmp = $post->toArray();
            $select = $this->db->select()->form('authors')->where("id = '$post->author_id'");
            $author = array_pop($this->db->query($select)->fetchAll());
            $select = $this->db->select()->from('comments')->where("post_id = '$post->id'");
            $comments = $this->db->query($select)->fetchAll();
            $tmp['author'] = $author;
            $tmp['comments'] = $comments;
            $final[] = $tmp;



            // code...
         }
         return $final;

      }

      public function getOne($slug)
      {
         $select = $this->db->select()->form('posts')->where("slug = '$slug'");

         $post =  array_pop($this->db->query($select)->fetchAll());
         $select = $this->db->select()->form('authors')->where("id = '$post[author_id]'");
         $author = array_pop($this->db->query($select)->fetchAll());
         $post['author'] = $author;
         $select = $this->db->select()->form('comments')->where("post_id = '$post[id]'");
         $comments = $this->db->query($select)->fetchAll();
         $tmp =array();
         foreach ($comments as $comment) {
            // code...
            $select = $this->db->select()->form('authors')->where("id = '$comment[author_id]'");
            $comment['author'] = array_pop($this->db->query($select)->fetchAll());
            $tmp[] = $comment;

         }
         $post['comments'] = $tmp;
         return $post;



      }
      public function getById($id)
      {
         $select = $this->db->select()->form('posts')->where("id = '$id'");
         $post  = array_pop($this->db->query($select)->fetchAll());
         return $post;
      }

      public function delete($id)
      {
         $this->db->query("DELETE FROM posts WHERE id = '$id'");
         return true;
      }
      public function save($data)
      {
         $author = Zend_Registry::get('author');
         if (empty($data['author_id'])) {
            $data['author_id'] = $author;
         }
         if (empty($data['slug'])) {
            $data['slug'] = $this->makeSlug($data['title']);

         }
         if (empty($data['id'])) {
            $data['id'] = Crypto::uuid();
            $this->db->beginTransaction();
            try {
               $this->db->insert('posts', $data);
               $this->db->query('UPDATE authors SET `number_of_posts` = (`number_of_posts` + 1) '. 'WHERE id= \'' . $data['author_id'] . '\'');
               $this->db->commit();
            }catch(Exception $e){
               $this->db->rollBack();
               echo $e->getMessage();

            }
            return true;
            // code...
         }else {
            $this->db->update('post', $data,'id = \''.$data['id']. '\'');
         }

      }

      public function makeSlug($titleStr)
      {
         return str_replace(' ','-',$titleStr);
      }




   }
?>
