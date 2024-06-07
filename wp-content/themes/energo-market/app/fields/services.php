<?php
/**
 * Global Settings Page
 */

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$services = new FieldsBuilder('Services');

$services
    ->setLocation('post_type', '==', 'services');

$services
    ->addText('services_mark', [
        'label' => 'Кому',
    ])
    ->addTextarea('services_text', [
        'label' => 'Text',
        'rows' => '4',
        'new_lines' => '', // Possible values are 'wpautop', 'br', or ''.
    ]);


return $services;
