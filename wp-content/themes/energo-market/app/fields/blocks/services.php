<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$services = new FieldsBuilder('Services 1');

$services
  ->setLocation('block', '==', 'acf/services');

$services
  ->addTab('tab_services', [
    'label' => 'Услуги',
    'instructions' => '',
    'required' => 0,
    'default_value' => '',
    'placeholder' => '',
    'prepend' => '',
    'append' => '',
    'maxlength' => '',
  ])
  ->addText('title', [
    'label' => 'Title',
    'instructions' => '',
    'required' => 0,
    'default_value' => '',
    'placeholder' => '',
    'prepend' => '',
    'append' => '',
    'maxlength' => '',
  ]);


return $services;
