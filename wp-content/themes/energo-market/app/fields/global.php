<?php
/**
 * Global Settings Page
 */

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Настройки темы',
        'menu_title' => 'Настройки темы',
        'menu_slug' => 'global-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

$builder = new FieldsBuilder('Main');

$builder
    ->setLocation('options_page', '==', 'global-settings');

// Tab

$builder
    ->addTab('tab_field', [
        'label' => 'Главные',
    ]);

// logo

$builder
    ->addImage('logo', [
        'label' => 'Логотип',
        'instructions' => '',
        'required' => 0,
        'return_format' => 'id',
        'preview_size' => 'thumbnail',
        'library' => 'all',

    ])
    ->addText('phone', [
        'label' => 'Телефон',
        'instructions' => '',
        'required' => 0,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
    ])
    ->addText('copyright', [
        'label' => 'Копирайт',
        'instructions' => '',
        'required' => 0,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
    ])
    ->addGroup('created', [
        'label' => 'Created',
        'instructions' => '',
        'required' => 0,
        'layout' => 'block',
    ])
    ->addText('created_link', [
        'label' => 'Ссылка',
        'instructions' => '',
        'required' => 0,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
    ])
    ->addImage('created_image', [
        'label' => 'Image',
        'instructions' => '',
        'required' => 0,
        'return_format' => 'array',
        'preview_size' => 'thumbnail',
        'library' => 'all',
    ])
    ->endGroup();

// Tab

$builder
    ->addTab('tab_field_popups', [
        'label' => 'Попапы',
        'instructions' => '',
        'required' => 0,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
    ])
    ->addTextarea('form_title_1', [
      'label' => 'Заголовок формы отправить запрос',
      'instructions' => '',
      'required' => 0,
      'default_value' => '',
      'placeholder' => '',
      'maxlength' => '',
      'rows' => '2',
      'new_lines' => 'br', // Possible values are 'wpautop', 'br', or ''.
    ])
    ->addText('form_shortcode_1', [
        'label' => 'Форма отправить запрос',
        'instructions' => '',
        'required' => 0,

        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
    ]);


return $builder;
