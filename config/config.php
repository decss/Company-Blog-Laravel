<?php

return [
    'theme' => env('THEME', 'pink'),
    'sliderPath' => 'slider-cycle',
    'indexPortfolioCount' => 5,
    'indexArticlesCount' => 3,
    'paginate' => 2,

    'recentComments' => 2,
    'recentPortfolios' => 2,
    'portfoliosCount' => 3,

    'mailAdmin' => env('MAIL_ADMIN', ''),

    'articles_img' => [
        'max' => ['width' => 816, 'height' => 282],
        'mini' => ['width' => 55, 'height' => 55]
    ],

    'image' => [
        'width' => 1024,
        'height' => 768
    ],

];