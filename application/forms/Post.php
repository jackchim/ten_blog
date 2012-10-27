<?php
class Application_Form_Post extends Zend_Form {
   public function init()
   {
      $this->setMethod('post');
      $this->addElement('text','title',array(
         'label' => 'Title:',
         'required' => true,
         'filters' => array('StringTrim'),
         ));
      $this->addElement('textarea','content',array(
         
         'label' => 'Post:',
         'required' => true,
         ));
      $this->addElement('hidden','id');
      $this->addElement('submit','submit',array(
         'ignore' => true,
         'label' => 'Post it!',
         'class' => 'btn success',
         ));
   }

}
