<?php

class SpaController extends Zend_Controller_Action
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
        $id_reserva = $_POST['id_reserva'];
        $durada = $_POST['durada'];

        $preu = $durada * 0.86;
        $now   = date('Y-m-d H:i:s');
        $conta = 0;

        $table_spa = new Application_Model_Spa();
        $select_spa = $table_spa->select();
        $select_spa->where('data BETWEEN ? AND DATE_ADD(?,INTERVAL ? MINUTE)', $now, $now, $durada);
        $rows_spa = $table_spa->fetchAll($select_spa);

        foreach ($rows_spa as $value_spa) {
            $conta++;
        }
        if ($conta >= 30) {
            echo "<script type='text/javascript'>alert ('La ocupació del SPA ha arrivat al seu punt màxim')</script>";
            $this->_redirect("/spa/index");
        }

        $table_fac = new Application_Model_Factura();
        $select_fac = $table_fac->select();
        $select_fac->from('factura', id_factura)
                   ->where('id_reserva = ?', $id_reserva);
        $row_fac = $table_fac->fetchRow($select_fac);

        $id_factura = $row_fac->id_factura;

        $data_spa = array(
            'durada' => $durada,
            'preu' => $preu,
            'data' => $now,
            'id_factura' => $id_factura,
        );
        $table_spa->insert($data_spa);

        $this->_redirect("/spa/ok");
    }

    public function okAction()
    {
        // action body
    }


}





