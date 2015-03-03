<?php

class MinibarController extends Zend_Controller_Action
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
        $producte = $_POST['producte'];
        $quantitat = $_POST['quantitat'];

        $table_fac = new Application_Model_Factura();
        $select_fac = $table_fac->select();
        $select_fac->from('factura', id_factura)
                   ->where('id_reserva = ?', $id_reserva);
        $row_fac = $table_fac->fetchRow($select_fac);
        $id_factura = $row_fac->id_factura;

        $table_pro = new Application_Model_Productes();
        $select_pro = $table_pro->select();
        $select_pro->from('productes', id_producte)
                   ->where('aliment = ?', $producte);
        $row_pro = $table_pro->fetchRow($select_pro);
        $id_producte = $row_pro->id_producte;

        $table_usa = new Application_Model_Usa();
        $data_usa = array(
            'quantitat' => $quantitat,
            'id_producte' => $id_producte,
            'id_factura' => $id_factura,
        );
        $table_usa->insert($data_usa);

        $this->_redirect("/minibar/ok");
    }

    public function okAction()
    {
        // action body
    }


}





