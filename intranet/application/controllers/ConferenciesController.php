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

    public function showAction()
    {
        $view = $this->view;

        $data = $_POST['data'];
        $durada = 24;

        $table_con = new Application_Model_Conferencia();

        $select_con = $table_con->select();
        $select_con->where('data BETWEEN ? AND DATE_ADD(?,INTERVAL ? HOUR)', $data, $data, $durada);
        $rows_con = $table_con->fetchAll($select_con);
        $view->conferencies = $rows_con;
        
        $view->setScriptPath('/var/www/intranet/application/views/scripts');
        $view->render('/conferencies/show.phtml');
    }
}



