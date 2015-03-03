<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        $namespace = new Zend_Session_Namespace ('user');
        if ($_SESSION['user']) {
            
        }
        else {
            $this->_redirect("/auth/index");
        }
        
    }
}





