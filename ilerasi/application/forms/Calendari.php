<?php

class Application_Form_Calendari extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');

        $this->addElement('text', 'arribada', array(
                'required' => true,
            ));

        $this->addElement('text', 'sortida', array(
            'required' => true,
            ));

        $this->addElement('text', 'adults', array(
            'required' => true,
            ));

        $this->addElement('text', 'nens', array(
            'required' => true,
            ));

        $this->addElement('text', 'habitacio', array(
            'required' => true,
            ));
        
    }


}

