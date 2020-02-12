<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '2413616205634982',
        'client_secret' => '447014a3711340098efb0a45baa8bbb9',
        'redirect' => 'https://frames.co.ke',
    ],

    'google' => [
        'client_id' => '277467703693-n4gkd8196k891sgmq42h2d1ft9aspnqj.apps.googleusercontent.com',
        'client_secret' => 'Tj_2oJxtwtecWvhOUqnWXnUD',
        'redirect' => 'https://frames.co.ke/google/redirect.php'
    ],

];
