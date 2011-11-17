<?php

class UwierzytelnianieController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function logujAction() {

        if (Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('index/index');
        }
        
        $request = $this->getRequest();
        $form = new Application_Form_Logowanie();
        
       
        if ($request->isPost()) {
            if($form->isValid($this->_request->getPost())){
                $authAdapter = $this->getAuthAdapter();
                
                $username = $form->getValue('username');
                $password = $form->getValue('password');
                
                $authAdapter->setIdentity($username)
                        ->setCredential($password);
                $auth = Zend_Auth::getInstance();
                
                $result = $auth->authenticate($authAdapter);
                if ($result->isValid()) {
                      $identity = $authAdapter->getResultRowObject();
                      $authStorage = $auth->getStorage();
                      $authStorage->write($identity);
                      $this->_redirect('index/index');
                } else {
                    $this->view->errorMsg = 'Wprowadz poprawne dane do logowania!';
               }
            }
        }


        $this->view->form = $form;
    }

    public function wylogujAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('index/index');
    }

    private function getAuthAdapter() {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        $authAdapter->setTableName('uzytkownicy')
                    ->setIdentityColumn('username')
                    ->setCredentialColumn('password');

        return $authAdapter;
    }

}

