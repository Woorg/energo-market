<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$projects = new FieldsBuilder('Projects 1');

$projects
  ->setLocation('block', '==', 'acf/projects');

$projects
  ->addTab('tab_reviews', [
    'label' => 'Реализованные проекты',
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
    'label' => 'Link',
    'type' => 'page_link',
    'instructions' => '',
    'required' => 0,
    'wrapper' => [
        'width' => '',
        'class' => '',
        'id' => '',
    ],
    'post_type' => ['projects'],
    'taxonomy' => [],
    'allow_null' => 0,
    'allow_archives' => 1,
    'multiple' => 0,
  ]);


return $projects;
