<?php
   class Application_Form_Comment extends Zend_Form {

      public function init()
      {
         $this->setMethod('post');
         $this->addElement('textarea','body',array(
            'label' => 'Comment:',
            'required'=> true ,
            'filters' => array('StringTrim'),

         ));
         $this->addElement('hidden','post_id');
         $this->addElement('submit','submit',array(
            'ignore' => true,
            'label' => 'Comment!',
            'class' => 'btn success'
         ));

      }


   }
