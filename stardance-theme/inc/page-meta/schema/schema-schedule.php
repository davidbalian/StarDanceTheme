<?php
return array(
    'context' => 'schedule',
    'fields'  => array(
        'hero_title'       => array( 'type' => 'text',     'label' => 'Hero title',       'default' => 'Class Timetable' ),
        'hero_description' => array( 'type' => 'textarea', 'label' => 'Hero description', 'default' => 'View our weekly class schedule below. Classes run Monday through Friday at our Limassol studio. Contact us if you have questions about specific classes or to arrange a trial session.' ),
        'cta_title'        => array( 'type' => 'text',     'label' => 'CTA title',        'default' => 'Questions About Our Schedule?' ),
        'cta_description'  => array( 'type' => 'textarea', 'label' => 'CTA description',  'default' => "Looking for a specific class time or want to book a private lesson? Get in touch and we'll help you find the best option." ),
        'cta_btn'          => array( 'type' => 'text',     'label' => 'CTA button',       'default' => 'Contact Us' ),
    ),
);
