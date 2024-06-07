<?php
/**
 * Global Settings Page
 */

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$services_categories = new FieldsBuilder('Services categories');

$services_categories
    ->setLocation('taxonomy', '==', 'services-categories');

$services_categories
    ->addTextarea('title', [
        'label' => 'Title',
        'instructions' => '',
        'required' => 0,
        'rows' => '2',
        'new_lines' => 'br', // Possible values are 'wpautop', 'br', or ''.
    ]);



return $services_categories;
