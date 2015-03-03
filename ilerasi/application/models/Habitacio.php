<?php

class Application_Model_Habitacio extends Zend_Db_Table_Abstract
{
    protected $_name = 'habitacio';
    protected $_primary = array('id_reserva','numero');
}

