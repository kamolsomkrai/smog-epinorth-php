<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'bsVersion'=>'5.x',
    'jwt'=>[
        'id' => 'UNIQUE-JWT-IDENTIFIER',  //a unique identifier for the JWT, typically a random string
        'expire' => 2628000 * 12,  //the short-lived JWT token is here set to expire after 5 min.
//        'expire' => 600,  //the short-lived JWT token is here set to expire after 5 min.
    ]
];
