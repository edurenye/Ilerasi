<?php

class TreballadorsController extends Zend_Controller_Action
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

        $nom = $_POST['nom'];
        $cognoms = $_POST['cognoms'];
        $dni = $_POST['dni'];
        $now = date('Y-m-d H:i:s');

        $table_con_tre_tip = new Application_Model_Contracte();
        $select_con_tre_tip = $table_con_tre_tip->select();
        $select_con_tre_tip->setIntegrityCheck(false);
        $select_con_tre_tip->from('contracte', array('indefinit','data_inici','data_fi','complement','antiguitat'))
                           ->join('treballador','contracte.dni=treballador.dni',array('dni','nom','cognoms','num_ss','telefon','email','ciutat','edat'))
                           ->join('tipus','contracte.id_tipus=tipus.id_tipus',array('descripcio','salari'))
                           ->where('treballador.dni = ?', $dni)
                           ->where('treballador.nom = ?', $nom)
                           ->where('treballador.cognoms = ?', $cognoms)
                           ->where('(contracte.indefinit=1 AND contracte.data_inici <= NOW()) OR (contracte.indefinit=NULL AND contracte.data_inici <= NOW() AND contracte.data_fi >= NOW())');
        $row_con_tre_tip = $table_con_tre_tip->fetchRow($select_con_tre_tip);

        if ($row_con_tre_tip == NULL) {
            echo "<script type='text/javascript'>alert('El treballador o el contracte no existeix en la base de dades');</script>";
            exit;
        }
        else {
            $view->dni = $row_con_tre_tip->dni;
            $view->nom = $row_con_tre_tip->nom;
            $view->cognoms = $row_con_tre_tip->cognoms;
            $view->salari = $row_con_tre_tip->salari;
            $view->tipus = $row_con_tre_tip->descripcio;
            $view->complement = $row_con_tre_tip->complement;
            $view->indefinit = $row_con_tre_tip->indefinit;
            $view->data_inici = $row_con_tre_tip->data_inici;
            $view->data_fi = $row_con_tre_tip->data_fi;
            $view->antiguitat = $row_con_tre_tip->antiguitat;
        }

        $total = 0;
        $total_ant = 0;
        $total_ant = $total_ant + $antiguitat;

        function restaFechas($dFecIni, $dFecFin)
            {
                $dFecIni = str_replace("-","",$dFecIni);
                $dFecIni = str_replace("/","",$dFecIni);
                $dFecFin = str_replace("-","",$dFecFin);
                $dFecFin = str_replace("/","",$dFecFin);

                preg_match( "/([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})/", $dFecIni, $aFecIni);
                preg_match( "/([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})/", $dFecFin, $aFecFin);

                $date1 = mktime(0,0,0,$aFecIni[2], $aFecIni[1], $aFecIni[3]);
                $date2 = mktime(0,0,0,$aFecFin[2], $aFecFin[1], $aFecFin[3]);

                return round(($date2 - $date1) / (60 * 60 * 24));
            }
        $f_inici = date('d-m-Y', strtotime($data_inici));
        $dies_ant = restaFechas($f_inici, date(d-m-Y));
        $anys_ant = $dies_ant / 365;
        $anys_ant = floor($anys_ant);
        $data_ant = $anys_ant / 5;
        $data_ant = floor($data_ant);
        $total_ant = $total_ant * $data_ant;
        $total = $total + $row_con_tre_tip->salari + $row_con_tre_tip->complement + $total_ant;

        $view->total_ant = $total_ant;
        $view->total = $total;

        $view->setScriptPath('/var/www/intranet/application/views/scripts');
        $view->render('/treballadors/show.phtml');
    }


}



