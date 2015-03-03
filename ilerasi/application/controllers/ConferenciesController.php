<?php

class ConferenciesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        $namespace = new Zend_Session_Namespace ('user');

        if ($_SESSION['user'] == '') {
            $this->_redirect("/auth/index");
        }
        
        $responsable = $namespace->dni;
        $ponent = $_POST['ponent'];
        $data = $_POST['data'];
        $durada = $_POST['durada'];
        $tema = $_POST['tema'];

        $table_con = new Application_Model_Conferencia();
        $select_con = $table_con->select();
        $select_con->from('conferencia', id_conferencia)
                   ->where('data BETWEEN ? AND DATE_ADD(?,INTERVAL ? MINUTE)', $data, $data, $durada);
        $rows_con = $table_con->fetchAll($select_con);

        if ($rows_con == NULL) {
            echo "<script type='text/javascript'>alert ('La sala de conferencies està ocupada')</script>";
            $this->_redirect("/conferencies/index");
        }

        $data_con = array(
            'ponent' => $ponent,
            'data' => $data,
            'durada' => $durada,
            'tema' => $tema,
            'responsable' => $responsable
        );
        $table_con->insert($data_con);

        $this->_redirect("/conferencies/ok");
    }

    public function okAction()
    {
        // action body
    }


}





