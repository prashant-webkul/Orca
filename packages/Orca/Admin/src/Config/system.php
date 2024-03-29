<?php

return [
    [
        'key' => 'audience',
        'name' => 'admin::app.admin.system.audience',
        'sort' => 3,
    ], [
        'key' => 'audience.settings',
        'name' => 'admin::app.admin.system.settings',
        'sort' => 1,
    ], [
        'key' => 'audience.settings.address',
        'name' => 'admin::app.admin.system.address',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'street_lines',
                'title' => 'admin::app.admin.system.street-lines',
                'type' => 'text',
                'validation' => 'between:1,4',
                'channel_based' => true
            ]
        ]
    ], [
        'key' => 'audience.settings.newsletter',
        'name' => 'admin::app.admin.system.newsletter',
        'sort' => 2,
        'fields' => [
            [
                'name' => 'subscription',
                'title' => 'admin::app.admin.system.newsletter-subscription',
                'type' => 'boolean',
            ]
        ],
    ], [
        'key' => 'audience.settings.email',
        'name' => 'admin::app.admin.system.email',
        'sort' => 3,
        'fields' => [
            [
                'name' => 'verification',
                'title' => 'admin::app.admin.system.email-verification',
                'type' => 'boolean'
            ]
        ],
    ], [
        'key' => 'general',
        'name' => 'admin::app.admin.system.general',
        'sort' => 4,
    ], [
        'key' => 'general.general',
        'name' => 'admin::app.admin.system.general',
        'sort' => 1,
    ], [
        'key' => 'general.general.locale_options',
        'name' => 'admin::app.admin.system.locale-options',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'weight_unit',
                'title' => 'admin::app.admin.system.weight-unit',
                'type' => 'select',
                'options' => [
                    [
                        'title' => 'lbs',
                        'value' => 'lbs'
                    ], [
                        'title' => 'kgs',
                        'value' => 'kgs'
                    ]
                ],
                'channel_based' => true,
            ]
        ]
    ],[
        'key' => 'general.content',
        'name' => 'admin::app.admin.system.content',
        'sort' => 2,
    ], [
        'key' => 'general.content.footer',
        'name' => 'admin::app.admin.system.footer',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'footer_content',
                'title' => 'admin::app.admin.system.footer-content',
                'type' => 'text',
                'channel_based' => true,
                'locale_based' => true
            ]
        ]
    ], [
        'key' => 'general.design',
        'name' => 'admin::app.admin.system.design',
        'sort' => 3,
    ], [
        'key' => 'general.design.admin_logo',
        'name' => 'admin::app.admin.system.admin-logo',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'logo_image',
                'title' => 'admin::app.admin.system.logo-image',
                'type' => 'image',
                'channel_based' => true,
            ]
        ]
    ],
];