<?php
return array(
    'context' => 'classes',
    'fields'  => array(

        // Hero
        'hero_title'       => array( 'type' => 'text',     'label' => 'Hero title',       'default' => 'Find Your Perfect Dance Class' ),
        'hero_description' => array( 'type' => 'textarea', 'label' => 'Hero description', 'default' => 'Star Dance Studio offers professional instruction tailored to your goals, from first steps to competition level. As an official member of the Cyprus Federation of Social & Sport Dance, we provide certified training for all ages starting from 3 years old.' ),

        // Section heading
        'list_heading'     => array( 'type' => 'text', 'label' => 'List of Classes heading', 'default' => 'List of Classes' ),
        'faq_heading'      => array( 'type' => 'text', 'label' => 'FAQ heading',             'default' => 'FAQs' ),

        // FAQ items
        'faq1_q' => array( 'type' => 'text',     'label' => 'FAQ 1 question', 'default' => 'What age can my child start dancing?' ),
        'faq1_a' => array( 'type' => 'textarea', 'label' => 'FAQ 1 answer',   'default' => 'We welcome dancers from age 3 and up. Our kids programs are fun and engaging, building dance skills appropriate for each age group.' ),
        'faq2_q' => array( 'type' => 'text',     'label' => 'FAQ 2 question', 'default' => 'Do I need a partner to join?' ),
        'faq2_a' => array( 'type' => 'textarea', 'label' => 'FAQ 2 answer',   'default' => 'Not at all. Many of our students join solo. We rotate partners in group classes and always ensure everyone gets equal floor time.' ),
        'faq3_q' => array( 'type' => 'text',     'label' => 'FAQ 3 question', 'default' => "I've never danced before. Which class should I start with?" ),
        'faq3_a' => array( 'type' => 'textarea', 'label' => 'FAQ 3 answer',   'default' => "We recommend starting with a beginner European Ballroom or Latin American group class. Both offer a solid technical foundation. Contact us and we'll help you choose the best starting point." ),
        'faq4_q' => array( 'type' => 'text',     'label' => 'FAQ 4 question', 'default' => 'Can I try a class before committing?' ),
        'faq4_a' => array( 'type' => 'textarea', 'label' => 'FAQ 4 answer',   'default' => "Absolutely. We offer trial classes with no obligation. It's the best way to experience the teaching style and see if the class is the right fit for you." ),
        'faq5_q' => array( 'type' => 'text',     'label' => 'FAQ 5 question', 'default' => 'Do you offer classes for competitive dancers?' ),
        'faq5_a' => array( 'type' => 'textarea', 'label' => 'FAQ 5 answer',   'default' => 'Yes. Star Dance Studio has a strong competition programme. Students who wish to compete receive focused coaching, choreography support, and guidance on selecting appropriate events and attire.' ),
        'faq6_q' => array( 'type' => 'text',     'label' => 'FAQ 6 question', 'default' => 'What should I wear to class?' ),
        'faq6_a' => array( 'type' => 'textarea', 'label' => 'FAQ 6 answer',   'default' => "Comfortable, flexible clothing is ideal. For footwear, dance shoes are preferred but not required for your first session — any clean, flat-soled shoe will do." ),
        'faq7_q' => array( 'type' => 'text',     'label' => 'FAQ 7 question', 'default' => 'How do I know which level I am?' ),
        'faq7_a' => array( 'type' => 'textarea', 'label' => 'FAQ 7 answer',   'default' => "Don't worry about labelling yourself. Come in for a trial class and our coaches will assess where you are and place you in the right group. Everyone is welcome regardless of prior experience." ),

        // CTA
        'cta_title'       => array( 'type' => 'text',     'label' => 'CTA title',       'default' => 'Ready to Start Dancing?' ),
        'cta_description' => array( 'type' => 'textarea', 'label' => 'CTA description', 'default' => "Have questions about which class is right for you? Get in touch and we'll help you find your perfect fit." ),
        'cta_btn'         => array( 'type' => 'text',     'label' => 'CTA button',      'default' => 'Contact Us' ),
    ),
);
