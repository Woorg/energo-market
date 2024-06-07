<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$portfolio = new FieldsBuilder('Advices 1');

$portfolio
  ->setLocation('block', '==', 'acf/advices');

$portfolio
  ->addTab('tab_advices', [
    'label' => 'Советы',
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
   ->addPageLink('link', [
    'label' => 'Page Link Field',
    'type' => 'page_link',
    'instructions' => '',
    'required' => 0,
    'post_type' => ['advices'],
    'taxonomy' => [],
    'allow_null' => 0,
    'allow_archives' => 1,
    'multiple' => 0,
  ])
  ->addText('button_text', [
    'label' => 'Button text',
    'instructions' => '',
    'required' => 0,
    'default_value' => '',
    'placeholder' => '',
    'prepend' => '',
    'append' => '',
    'maxlength' => '',
  ]);

return $portfolio;
