<?php
   class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
      protected function _initAll()
      {
         $this->bootstrap('db');
         Zend_Registry::set('db',$this->getResource('db'));

         $route = new Zend_Controller_Router_Route('/',array('controller' =>'posts' ,
         'action'=>'index',
      ));

      Zend_Controller_Front::getInstance()->getRouter()->addRoute('/',$route);

      $session = new Zend_Session_Namespace();
      Zend_Registry::set('author',@$_SESSION['author']);
   }



}
