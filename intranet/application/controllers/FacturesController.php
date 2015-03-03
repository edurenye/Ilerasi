<?php

class FacturesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function showAction()
    {
        $id_reserva = $_POST['id_reserva'];

        $view = $this->view;

        $table_fac = new Application_Model_Factura();
        $select_fac = $table_fac->select();
        $select_fac->from('factura', id_factura)
                   ->where('id_reserva = ?', $id_reserva);
        $row_fac = $table_fac->fetchRow($select_fac);
        $id_factura = $row_fac->id_factura;

        $table_res = new Application_Model_Reserva();
        $select_res = $table_res->select();
        $select_res->from('reserva', array(preu, dni))
                   ->where('id_reserva = ?', $id_reserva);
        $row_res = $table_res->fetchRow($select_res);

        if ($row_res == NULL) {
            echo "<script type='text/javascript'>alert('El client no ha fet cap reserva');</script>";
            exit;
        }
        else {
            $view->id_reserva = $id_reserva;
            $view->preu_res = $row_res->preu;
            $dni = $row_res->dni;
        }

        $table_cli = new Application_Model_Client();
        $select_cli = $table_cli->select();
        $select_cli->from('client', array(nom, cognoms))
               ->where('dni = ?', $dni);
        $row_cli = $table_cli->fetchRow($select_cli);

        $view->dni = $dni;
        $view->nom = $row_cli->nom;
        $view->cognoms = $row_cli->cognoms;

        $table_spa = new Application_Model_Spa();
        $select_spa = $table_spa->select();
        $select_spa->from('spa', array(preu, data))
                   ->where('id_factura = ?', $id_factura);
        $rows_spa = $table_spa->fetchAll($select_spa);
        $view->spa = $rows_spa;

        $table_con_men = new Application_Model_Consumeix();
        $select_con_men = $table_con_men->select();
        $select_con_men->setIntegrityCheck(false);
        $select_con_men->from('menu',array('aliment','preu'))
                   ->join('consumeix','menu.id_menu=consumeix.id_menu','data')
                   ->where('consumeix.id_factura = ?', $id_factura);
        $rows_con_men = $table_con_men->fetchAll($select_con_men);
        $view->con_men = $rows_con_men;

        $table_usa_pro = new Application_Model_Usa();
        $select_usa_pro = $table_usa_pro->select();
        $select_usa_pro->setIntegrityCheck(false);
        $select_usa_pro->from('productes',array('aliment','preu'))
                   ->join('usa','productes.id_producte=usa.id_producte','quantitat')
                   ->where('usa.id_factura = ?', $id_factura);
        $rows_usa_pro = $table_usa_pro->fetchAll($select_usa_pro);
        $view->usa_pro = $rows_usa_pro;

        $table_mas = new Application_Model_Massatge();
        $select_mas = $table_mas->select();
        $select_mas->from('massatge', array(preu, data, tipus))
                   ->where('id_factura = ?', $id_factura);
        $rows_mas = $table_mas->fetchAll($select_mas);
        $view->mas = $rows_mas;
        
        $view->setScriptPath('/var/www/intranet/application/views/scripts');
        $view->render('/factures/show.phtml');
    }


}



