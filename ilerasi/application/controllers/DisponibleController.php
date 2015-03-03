<?php

/**
 * Description of fotosController
 *
 * @author eduard
 */
class DisponibleController extends Zend_Controller_Action {
    public function indexAction()
    {
        $arribada = $_POST['arribada'];
        $sortida = $_POST['sortida'];
        $adults = $_POST['adults'];
        $nens = $_POST['nens'];
        $habitacio = $_POST['habitacio'];
        $places = $adults + $nens;
        $capacitat = $habitacio*6;

        $max_hab = 32;

        if (($nens/4) > $habitacio) {
            $this->_redirect("/index/fail");
        }

        if (($adults/2) > $habitacio) {
            $this->_redirect("/index/fail");
        }

        if ($habitacio > $places) {
            $this->_redirect("/index/fail");
        }

        if ($capacitat < $places) {
            $this->_redirect("/index/fail");
        }

        $table_res = new Application_Model_Reserva();

        $select_res = $table_res->select();
        $select_res->from('reserva', id_reserva)
                   ->where("data_sortida > $arribada OR data_entrada < $sortida");
        $rows_res = $table_res->fetchAll($select_res);
        foreach ($rows_res as $value_res) {
            $table_hab = new Application_Model_Habitacio();
            $select_hab = $table_hab->select();
            $select_hab->from('habitacio', numero)
                       ->where('id_reserva = ?', $value_res->id_reserva);
            $rows_hab = $table_hab->fetchAll($select_hab);
            $x;
            foreach ($rows_hab as $value_hab) {
                $x++;
                $max_hab--;
                $hab_ocu[$x] = $value_hab->numero;
            }
        }
        if ($max_hab >= $habitacio) {
            $namespace = new Zend_Session_Namespace ('disp');
            $_SESSION['disp'] = array ("arribada" => $arribada,
                                       "sortida" => $sortida,
                                       "adults" => $adults,
                                       "nens" => $nens,
                                       "habitacio" => $habitacio,
                                       "hab_ocu" => $hab_ocu);
            $this->_redirect("/reserves/index");
        }
        else {
            $this->_redirect("/index/fail");
        }
    }
}
?>
