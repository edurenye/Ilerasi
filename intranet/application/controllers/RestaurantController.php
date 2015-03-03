<?php

class RestaurantController extends Zend_Controller_Action
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
        $aliment = $_POST['aliment'];

        $now   = date('Y-m-d H:i:s');

        $table_fac = new Application_Model_Factura();
        $select_fac = $table_fac->select();
        $select_fac->from('factura', id_factura)
                   ->where('id_reserva = ?', $id_reserva);
        $row_fac = $table_fac->fetchRow($select_fac);
        $id_factura = $row_fac->id_factura;

        $table_men = new Application_Model_Menu();
        $select_men = $table_men->select();
        $select_men->from('menu', id_menu)
                   ->where('aliment = ?', $aliment);
        $row_men = $table_men->fetchRow($select_men);

        $id_menu = $row_men->id_menu;

        $table_con = new Application_Model_Consumeix();
        $data_con = array(
            'data' => $now,
            'id_menu' => $id_menu,
            'id_factura' => $id_factura,
        );
        $table_con->insert($data_con);

        $this->_redirect("/restaurant/ok");
    }

    public function okAction()
    {
        // action body
    }


}





