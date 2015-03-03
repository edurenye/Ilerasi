<?php

class Application_Model_Productes extends Zend_Db_Table_Abstract
{
    protected $_name = 'productes';
    protected $_primary = 'id_producte';
    protected $_sequence = true;
}

