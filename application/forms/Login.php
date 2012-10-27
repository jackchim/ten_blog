<?php
   class Application_Form_Login extends Zend_Form {
      public function init()
      {
         $this->setMethod('post');
         $this->addElement('text','first_name',array(
            'label' => 'First_name ',
            'required' => true,
            'filters' => array('StringTrim'),
         ));
         $this->addElement('text','last_name',array(
            'label' => 'Last_name',
            'required' => true,

         ));
         $this->addElement('submit','submit'array(
            'ignore' => true,
            'label' => 'Login',

         ));
      }
   }
