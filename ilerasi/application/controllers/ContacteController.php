<?php

class ContacteController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function okAction()
    {
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $assumpte = $_POST['assumpte'];
        $missatge = $_POST['missatge'];
        $desti = "contacte@ilerasi.com";
        $headers = "MIME-Version: 1.0\r\n";

        $cos_array = array($missatge, $email);

        $cos = implode(". email: ", $cos_array);

        mail($desti,$assumpte,$cos,$headers);

        $this->_redirect("/contacte/ok");
    }


}



