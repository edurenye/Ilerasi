<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_helper->layout->disableLayout();
    }

    public function failAction()
    {
        $this->_helper->layout->disableLayout();
    }

    public function loginAction()
    {
        $user = $_POST['user'];
        $password = $_POST['password'];
        $table_tre = new Application_Model_Treballador();

        $select_tre = $table_tre->select();
        $select_tre->where('user = ?', $user)
               ->where('password = ?', $password);

        $row_tre = $table_tre->fetchRow($select_tre);

        if ($row_tre == NULL) {
            $this->_redirect("/auth/fail?user=$user");
        }
        else {
            $namespace = new Zend_Session_Namespace ('user');
            $_SESSION['user'] = $row_tre;
            return $this->_helper->redirector('index', 'index');
        }
    }

    public function logoutAction()
    {
        Zend_Session :: destroy (true);
        return $this->_helper->redirector('index', 'index');
    }
    
}





