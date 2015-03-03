<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        
    }

    public function loginAction()
    {
        $user = $_POST['user'];
        $password = $_POST['password'];
        $table = new Application_Model_Client();

        $select = $table->select();
        $select->where('user = ?', $user)
               ->where('password = ?', $password);

        $row = $table->fetchRow($select);

        if ($row == NULL) {
            $this->_redirect("/auth/fail?user=$user");
        }
        else {
            $namespace = new Zend_Session_Namespace ('user');
            $_SESSION['user'] = $row;
            return $this->_helper->redirector('index', 'index');
        }
        
    }

    public function failAction()
    {
        $user = $_GET['user'];
    }

    public function logoutAction()
    {
        Zend_Session :: destroy (true);
        return $this->_helper->redirector('index', 'index');
    }

    public function signinAction()
    {
        // action body
    }

    public function registreAction()
    {
        $user = $_POST['user'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $nom = $_POST['nom'];
        $cognoms = $_POST['cognoms'];
        $dni = $_POST['dni'];
        $tel = $_POST['tel'];
        $pais = $_POST['pais'];
        $ciutat = $_POST['ciutat'];

        $table_cli = new Application_Model_Client();
        $data_cli = array(
            'dni' => $dni,
            'nom' => $nom,
            'cognoms' => $cognoms,
            'user' => $user,
            'password' => $password,
            'email' => $email,
            'telefon' => $tel,
            'pais' => $pais,
            'ciutat' => $ciutat
        );
        $table_cli->insert($data_cli);

        $namespace = new Zend_Session_Namespace ('user');
        $select = $table_cli->select();
        $select->where('user = ?', $user)
               ->where('password = ?', $password);

        $row = $table_cli->fetchRow($select);
        
        $_SESSION['user'] = $row;
        return $this->_helper->redirector('success', 'auth');
    }

    public function successAction()
    {
        $namespace = new Zend_Session_Namespace ('disp');
        if (isset ($_SESSION['disp'])) {
            $this->_redirect("/reserves/index");
        }
        else {
            $this->_redirect("/index/index");
        }
    }


}











