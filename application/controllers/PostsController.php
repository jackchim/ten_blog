<?php

   class PostsController extends Zend_Controller_Action {
      public function init()
      {
         $this->Post = new Application_Model_Post;

      }
      public function indexAction()
      {
         $this->view->Posts = $this->Post->getAll();



      }
      public function addAction()
      {
         $request = $this->getRequest();
         $from = new Application_Form_Post();
         if ($this->getRequest()->isPost()) {
            if ($from->isValid($request->getPost())) {
               $this->Post->save($from->getValues());
               return $this->_helper->redirector('index');

            }
         }
         $this->view->form = $from;

      }

      public function viewAction()
      {
         $request = $this->getRequest();
         $this->view->Post = $this->Post->getOne($this->getParm($request));

      }

      public function editAction()
      {
         $request  = $this->getRequest();
         $from = new Application_Form_Post();
         if ($this->getRequest()->isPost()) {
            if ($from->isValid($request->getPost())) {
               $this->Post->save($from->getValues());
               return $this->_helper->redirector('index');
            }
         }else {
            $requestUri = $this->getRequest()->getRequestUri();
            $post = $this->Post->getOne($this->getParm($requestUri ));
            $from->populate($post);
         }
         $this->view->from = $from;
      }
      public function deleteAction()
      {
         $request = $this->getRequest()->getRequestUri();
         $this->Post->delete($this->getParm($request));
         return $this->_helper->redirector('index');



      }
      private function getParm()
      {
         return substr($str,(strrpos($str,'/') + 1));

      }



   }
