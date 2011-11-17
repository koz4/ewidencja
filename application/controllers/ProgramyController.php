<?php

class ProgramyController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listaAction()
    {
       $programyTBL = new Application_Model_Programy();
       $this->view->programy = $programyTBL->fetchAll();
    }


}



