<?php

class MassatgesController extends Zend_Controller_Action
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
        $tipus = $_POST['tipus'];
        $sala = $_POST['sala'];
        $responsable = $_POST['responsable'];
        $preu = $_POST['preu'];

        $now   = date('Y-m-d H:i:s');

        $table_fac = new Application_Model_Factura();
        $select_fac = $table_fac->select();
        $select_fac->from('factura', id_factura)
                   ->where('id_reserva = ?', $id_reserva);
        $row_fac = $table_fac->fetchRow($select_fac);
        $id_factura = $row_fac->id_factura;

        $table_mas = new Application_Model_Massatge();
        $data_mas = array(
            'tipus' => $tipus,
            'sala' => $sala,
            'responsable' => $responsable,
            'preu' => $preu,
            'data' => $now,
            'id_factura' => $id_factura,
        );
        $table_mas->insert($data_mas);

        $this->_redirect("/massatges/ok");
    }

    public function okAction()
    {
        // action body
    }


}





