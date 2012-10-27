<?php
   class ErrorController extends Zend_Controller_Action {

      public function errorAction()
      {
         $error = $this->_getParm('error_handler');
         switch ($error->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:

               $this->getResponse()->setHttpResponseCode(404);
               $this->view->message = 'Page not found!';
               // code...
               break;

            default:
               // code...
               $this->getResponse()->setHttpResponseCode(500);
               $this->view->message = 'Application error';

               break;
            }
            if ($log = $this->getLog()) {
               $log->crit($this->view->message,$errors->exception );

               // code...
            }
            if ($this->getInvokeArg('displayExceptions') == true) {
               $this->view->exception = $errors->exception;
               // code...
            }
            $this->view->request = $errors->request;

         }
         public function getLog()
         {
            $bootstrap = $this->getInvokeArg('bootstrap');
            if (!$bootstrap->hasPluginResource('Log')) {
               // code...
               return FALSE;
            }
            $log = $bootstrap->getResource('Log');
            return $log;
         }
      }

