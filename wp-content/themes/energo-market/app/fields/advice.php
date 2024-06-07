<?php
/**
 * Global Settings Page
 */

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$advice = new FieldsBuilder('Expert advice');

$advice
    ->setLocation('post_type', '==', 'advices');

$advice
    ->addImage('advice_image', [
      'label' => 'Image',
      'instructions' => '',
      'required' => 0,
      'return_format' => 'array',
      'preview_size' => 'thumbnail',
      'library' => 'all',
      'mime_types' => '',
    ])
    ->addTextarea('text', [
      'label' => 'Text',
      'instructions' => '',
      'required' => 0,
      'default_value' => '',
      'placeholder' => '',
      'maxlength' => '',
      'rows' => '2',
      'new_lines' => '', // Possible values are 'wpautop', 'br', or ''.
    ]);



return $advice;
