<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class OrderEditInputFilter extends InputFilter {

    public function __construct() {
        $this->add(array(
            'name' => 'customerName',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 0,
                        'max' => 255,
                    ),
                ),
            ),
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
        ));

        $this->add(array(
            'name' => 'payment',
            'required' => true,
            'filters' => array(
                array('name' => 'Int')
            ),
        ));

        $this->add(array(
            'name' => 'payment',
            'required' => true,
            'filters' => array(
                array('name' => 'Int')
            ),
        ));
        
                     $this->add(array(
            'name' => 'payment',
            'required' => true,
            'filters' => array(
                array('name' => 'Int')
            ),

        ));
    }

}
