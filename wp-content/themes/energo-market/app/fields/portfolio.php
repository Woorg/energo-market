<?php
/**
 * Global Settings Page
 */

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$portfolio = new FieldsBuilder('Portfolio');

$portfolio
    ->setLocation('post_type', '==', 'portfolio');

$portfolio
  ->addRepeater('slider', [
    'label' => 'Слайдер',
    'instructions' => '',
    'required' => 0,
    'min' => 0,
    'max' => 0,
    'layout' => 'block',
    'button_label' => '',
  ])
  ->addImage('slider_image', [
    'label' => 'Image',
    'instructions' => '',
    'required' => 0,
    'return_format' => 'array',
    'preview_size' => 'thumbnail',
    'library' => 'all',
  ])
  ->addText('slider_title', [
    'label' => 'Title',
    'instructions' => '',
    'required' => 0,
    'default_value' => '',
    'placeholder' => '',
    'prepend' => '',
    'append' => '',
    'maxlength' => '',
  ])
  ->addFile('slider_file', [
    'label' => 'File',
    'instructions' => '',
    'required' => 0,
    'return_format' => 'array',
    'library' => 'all',
    'min_size' => '',
    'max_size' => '',
    'mime_types' => '',
  ])
  ->addPageLink('slider_link', [
    'label' => 'Ссылка',
    'type' => 'page_link',
    'instructions' => '',
    'required' => 0,
    'post_type' => [],
    'taxonomy' => [],
    'allow_null' => 0,
    'allow_archives' => 1,
    'multiple' => 0,
  ])
  ->addTextarea('slider_text', [
    'label' => 'Text',
    'instructions' => '',
    'required' => 0,
    'default_value' => '',
    'placeholder' => '',
    'maxlength' => '',
    'rows' => '4',
    'new_lines' => '', // Possible values are 'wpautop', 'br', or ''.
  ])
  ->endRepeater();

return $portfolio;
