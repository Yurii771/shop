<?php

namespace Admin\Form;

use Zend\Form\Form;

class CategoryAddForm extends Form {

	public function __construct($name = null) {
		// we want to ignore the name passed
		parent::__construct('categoryAddForm');
		$this->setAttribute('method', 'post');
		$this->setAttribute('class', 'bs-example form-horizontal');
		$this->add(array(
			'name' => 'name',
			'type' => 'text',
			'options' => array(
                            'label' => 'Название категории',
                            'min' => 3,
                            'max' => 100,
			),
			'attributes' => array(
                            'placeholder' => 'Name',
                            'class' => 'form-control',
                            'required' => 'required',
			),
		));
		$this->add(array(
			'name' => 'parent',
			'type' => 'select',
			'options' => array(
                            'label' => 'Главная категория',
			),
			'attributes' => array(
                            'class' => 'form-control',
			),
		));
		$this->add(array(
			'name' => 'submit',
			'type' => 'Submit',
			'attributes' => array(
				'value' => 'Добавить',
				'class' => 'btn btn-info',
			),
		));
	}

}
