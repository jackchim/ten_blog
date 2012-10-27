<?php

   class CommentsController extends Zend_Controller_Action {
   public function init()
   {
      $this->Comment = new Application_Model_Comment;
      $this->Post = new Application_Model_Post;
   }
   public function addAction()
   {
      $requestUri = $this->getRequest()->getRequestUri();
      $this->view->Post = $this->Post->getById($this->getParm($requestUri));
      $request = $this->getRequest();
      $form = new Application_Model_Comment();

      if ($this->getRequest()->isPost()) {
         if ($form->isValid($request->getPost())) {
            $this->Comment->save($form->getValues());
            $data = $form->getValues();
            $post = $this->Post->getById($data['post_id']);
            return $this->_helper->redirector->gotoUrl('/posts/view/'.$post['slug']);

            // code...
         }
         // code...
      }
      $this->view->form = $form;
      
      
      
   }
   private function getParm()
   {
      return substr($str,(strrpos($str,'/') + 1));

   }
   
   
   }
