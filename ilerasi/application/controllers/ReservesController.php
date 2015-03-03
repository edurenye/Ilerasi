<?php

class ReservesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $namespace = new Zend_Session_Namespace ('disp');

        $max_hab = 32;
        $i = 0;
        $lliure = array();

        $arribada = $_SESSION['disp']['arribada'];
        $sortida = $_SESSION['disp']['sortida'];
        $adults = $_SESSION['disp']['adults'];
        $nens = $_SESSION['disp']['nens'];
        $habitacio = $_SESSION['disp']['habitacio'];
        $hab_ocu = $_SESSION['disp']['hab_ocu'];

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

        $h_total = $adults + $nens;
        $f_total = $h_total / $habitacio;
        $p_adults = $adults * 30;
        $p_nens = $nens * 10;
        $f_arribada = date('d-m-Y', strtotime($arribada));
        $f_sortida = date('d-m-Y', strtotime($sortida));
        $dies = restaFechas($f_arribada, $f_sortida);
        $nits = $dies - 1;
        $p_habitacio = ($habitacio * 30) / $f_total;
        $p_suma = $p_nens + $p_adults + $p_habitacio;
        $preu= $p_suma * $nits;

        while (count($lliure) < $habitacio) {
            $ale = rand(1,$max_hab);
            foreach ($hab_ocu as $value_ocu) {
                if ($ale == $value_ocu) {
                    continue 2;
                }
                else {
                    foreach ($lliure as $value_lliure) {
                        if ($ale == $value_lliure) {
                            continue 3;
                        }
                    }
                }
            }
            $i++;
            $lliure[$i] = $ale;
        }
        $_SESSION['disp']['lliure'] = $lliure;
        $_SESSION['disp']['preu'] = $preu;
    }

    public function confirmAction()
    {
        $namespace = new Zend_Session_Namespace ('user');
        if ($_SESSION['user'] == '') {
            $this->_redirect("/auth/index");
        }

        $arribada = $_SESSION['disp']['arribada'];
        $sortida = $_SESSION['disp']['sortida'];
        $adults = $_SESSION['disp']['adults'];
        $nens = $_SESSION['disp']['nens'];
        $habitacio = $_SESSION['disp']['habitacio'];
        $hab_ocu = $_SESSION['disp']['hab_ocu'];
        $lliure = $_SESSION['disp']['lliure'];
        $preu = $_SESSION['disp']['preu'];
        $dni = $_SESSION['user']->dni;

        $table_res = new Application_Model_Reserva();
        $data_res = array(
            'num_adults' => $adults,
            'num_nens' => $nens,
            'data_entrada' => $arribada,
            'data_sortida' => $sortida,
            'num_habitacions' => $habitacio,
            'dni' => $dni,
            'preu' => $preu
        );
        $table_res->insert($data_res);
        
        $select_res = $table_res->select();
        $select_res->from('reserva', id_reserva)
                   ->where('dni = ?', $dni)
                   ->where('data_entrada = ?', $arribada)
                   ->where('data_sortida = ?', $sortida);
        $row_res = $table_res->fetchRow($select_res);

        $table_fac = new Application_Model_Factura();
        $data_fac = array(
            'id_reserva' => $row_res->id_reserva
        );
        $table_fac->insert($data_fac);

        $table_hab = new Application_Model_Habitacio();
        foreach ($lliure as $value_lliure) {
            $data_hab = array(
                'id_reserva' => $row_res->id_reserva,
                'numero' => $value_lliure
            );
            $table_hab->insert($data_hab);
        }

        unset ($_SESSION['disp']);
        $this->_redirect("/reserves/success");
    }

    public function cancelAction()
    {
        $namespace = new Zend_Session_Namespace ('disp');
        unset ($_SESSION['disp']);
        $this->_redirect("/index/index");
    }

    public function showAction()
    {
        $namespace = new Zend_Session_Namespace ('user');
        if ($_SESSION['user'] == '') {
            $this->_redirect("/auth/index");
        }
        $dni = $_SESSION['user']->dni;
        $table_res = new Application_Model_Reserva();
        $select_res = $table_res->select();
        $select_res->where('dni = ?', $dni);
        $rows_res = $table_res->fetchAll($select_res);

        $view = $this->view;
        
        $view->res = $rows_res;

        $view->setScriptPath('/var/www/ilerasi/application/views/scripts');
        $view->render('/reserves/show.phtml');
    }

    public function successAction()
    {
        
    }


}









