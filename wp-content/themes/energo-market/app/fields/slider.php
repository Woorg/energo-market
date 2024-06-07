<?php
/**
 * Global Settings Page
 */

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$slider = new FieldsBuilder('Slider');

$slider
    ->setLocation('post_type', '==', 'slider');

$slider
    ->addImage('image', [
        'label' => 'Image',
        'instructions' => '',
        'required' => 0,
        'return_format' => 'id',
        'preview_size' => 'thumbnail',
        'library' => 'all',
    ])
    ->addRepeater('advantages', [
        'label' => 'Advantages',
        'instructions' => '',
        'required' => 0,
        'layout' => 'table',
    ])
    ->addText('term', [
        'label' => 'Term',
    ])
    ->addText('desc', [
        'label' => 'Description',
    ])
    ->endRepeater()
    ->addTextarea('title', [
        'label' => 'Title',
        'rows' => '2',
        'new_lines' => 'br', // Possible values are 'wpautop', 'br', or ''.
    ])
    ->addTextarea('text', [
        'label' => 'Text',
        'rows' => '2',
        'new_lines' => '', // Possible values are 'wpautop', 'br', or ''.
    ])
    ->addText('button_text', [
        'label' => 'Button text',
    ]);


return $slider;
