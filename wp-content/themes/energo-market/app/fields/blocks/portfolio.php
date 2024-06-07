<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$portfolio = new FieldsBuilder('Portfolio 1');

$portfolio
  ->setLocation('block', '==', 'acf/portfolio');

$portfolio
  ->addTab('tab_reviews', [
    'label' => 'Портфолио',
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
  ->addRepeater('list', [
    'label' => 'Список',
    'instructions' => '',
    'required' => 0,
    'layout' => 'table',
    'button_label' => '',
  ])
  ->addTextarea('list_item', [
    'label' => 'Text',
    'instructions' => '',
    'required' => 0,
    'default_value' => '',
    'placeholder' => '',
    'prepend' => '',
    'append' => '',
    'maxlength' => '',
    'rows' => '2',
    'new_lines' => '', // Possible values are 'wpautop', 'br', or ''.
  ])
  ->endRepeater()
  ->addPageLink('link', [
    'label' => 'Link',
    'type' => 'page_link',
    'instructions' => '',
    'required' => 0,
    'post_type' => ['portfolio'],
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
