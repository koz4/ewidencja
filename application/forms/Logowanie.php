<?php

class Application_Form_Logowanie extends Zend_Form
{
    public function __construct($options = null) {
        parent::__construct($options);
    
        $this->setName('loguj');
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('User name:')
                ->setRequired();
        
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password:')
                ->setRequired(true);
        
        $loguj = new Zend_Form_Element_Submit('loguj');
        $loguj->setLabel('Zaloguj');
        
        $this->addElements(array($username ,$password ,$loguj));
        $this->setMethod('post');
        $this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/uwierzytelnianie/loguj');
        
        
    }

    public function init()
    {
    }

}

