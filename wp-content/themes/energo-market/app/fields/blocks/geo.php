<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$geo = new FieldsBuilder('Geo');

$geo
  ->setLocation('block', '==', 'acf/geo');

$geo
  ->addTab('tab_geo', [
    'label' => 'Отзывы',
    'instructions' => '',
    'required' => 0,
    'default_value' => '',
    'placeholder' => '',
    'prepend' => '',
    'append' => '',
    'maxlength' => '',
  ])
  ->addTextarea('title', [
    'label' => 'Title',
    'rows' => '2',
    'new_lines' => 'br', // Possible values are 'wpautop', 'br', or ''.
  ])
  ->addRepeater('stats', [
    'label' => 'Статистика',
    'instructions' => '',
    'required' => 0,
    'min' => 0,
    'max' => 0,
    'layout' => 'table',
    'button_label' => '',
  ])
  ->addText('num', [
    'label' => 'Num',
    'instructions' => '',
    'required' => 0,
    'default_value' => '',
    'placeholder' => '',
    'prepend' => '',
    'append' => '',
    'maxlength' => '',
  ])
  ->addText('text', [
    'label' => 'Text',
    'instructions' => '',
    'required' => 0,
    'default_value' => '',
    'placeholder' => '',
    'prepend' => '',
    'append' => '',
    'maxlength' => '',
  ]);


return $geo;
