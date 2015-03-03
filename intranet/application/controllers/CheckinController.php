<?php

class CheckinController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        
    }

    public function showAction()
    {
        $view = $this->view;

        $nom = $_POST['nom'];
        $cognoms = $_POST['cognoms'];
        $dni = $_POST['dni'];

        $table_cli = new Application_Model_Client();

        $select_cli = $table_cli->select();
        $select_cli->where('dni = ?', $dni)
               ->where('nom = ?', $nom)
               ->where('cognoms = ?', $cognoms);

        $row_cli = $table_cli->fetchRow($select_cli);

        if ($row_cli == NULL) {
            echo "<script type='text/javascript'>alert('El client no existeix en la base de dades');</script>";
            exit;
        }
        else {
            $view->dni = $row_cli->dni;
            $view->nom = $row_cli->nom;
            $view->cognoms = $row_cli->cognoms;
            $view->user = $row_cli->user;
            $view->email = $row_cli->email;
            $view->telefon = $row_cli->telefon;
            $view->pais = $row_cli->pais;
            $view->ciutat = $row_cli->ciutat;
        }

        $table_res = new Application_Model_Reserva();

        $select_res = $table_res->select();
        $select_res->where('dni = ?', $dni)
                   ->where('data_entrada <= NOW()')
                   ->where('data_sortida > NOW()');

        $row_res = $table_res->fetchRow($select_res);

        if ($row_res == NULL) {
            echo "<script type='text/javascript'>alert('El client no ha fet cap reserva');</script>";
            exit;
        }
        else {
            $view->id_reserva = $row_res->id_reserva;
            $view->num_adults = $row_res->num_adults;
            $view->num_nens = $row_res->num_nens;
            $view->data_entrada = $row_res->data_entrada;
            $view->data_sortida = $row_res->data_sortida;
            $view->num_habitacions = $row_res->num_habitacions;
            $view->preu = $row_res->preu;
        }

        $table_hab = new Application_Model_Habitacio();

        $select_hab = $table_hab->select();
        $select_hab->from('habitacio', numero)
                   ->where('id_reserva = ?', $row_res->id_reserva);

        $row_hab = $table_hab->fetchAll($select_hab);

        $view->hab = $row_hab;

        $view->setScriptPath('/var/www/intranet/application/views/scripts');
        $view->render('/checkin/show.phtml');
    }


}



