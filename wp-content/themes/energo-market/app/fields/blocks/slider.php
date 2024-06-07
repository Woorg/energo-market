<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$slider = new FieldsBuilder('Slider 1');

$slider
  ->setLocation('block', '==', 'acf/slider');

$slider
  ->addTab('tab_slider', [
    'label' => 'Слайдер',
    'instructions' => '',
    'required' => 0,
    'default_value' => '',
    'placeholder' => '',
    'prepend' => '',
    'append' => '',
    'maxlength' => '',
  ]);


return $slider;
