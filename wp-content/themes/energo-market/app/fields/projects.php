<?php
/**
 * Global Settings Page
 */

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$projects = new FieldsBuilder('Projects');

$projects
    ->setLocation('post_type', '==', 'projects');

$projects
    ->addText('reviews_project', [
        'label' => 'Проект',
        'instructions' => '',
        'required' => 0,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
    ])
    ->addImage('reviews_image', [
        'label' => 'Photo',
        'instructions' => '',
        'required' => 0,
        'return_format' => 'array',
        'preview_size' => 'thumbnail',
        'library' => 'all',
    ])
    ->addTextarea('reviews_text', [
        'label' => 'Text',
        'rows' => '4',
        'new_lines' => '', // Possible values are 'wpautop', 'br', or ''.
    ]);


return $projects;
