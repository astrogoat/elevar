<?php

return [
    'sources' => [
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
        'fbclid',
        'gclid',
        'ttclid',
        'irclickid',
        'user_id',
    ],

    /*
    * If you want to override the automatic injection of views
    * into some areas of your application so you to include
    * them yourself then you disable each in this array.
    */
    'include-frontend-views' => [
        'head' => true,
        'body' => true,
        'end' => true,
    ],
];
