<?php

return [
    'mail' => [
        'generic_recipient' => 'recipient',
        'greeting' => 'Dear :name,',
        'subject' => '[:name] Password Reset Notification',
        'intro' => 'We received a password reset request for your :name account. To reset your password open the application and enter the following token:',
        'token' => 'Your password reset token is: **:token**',
        'outro1' => 'If you did not request this reset, then no further action will be required. The reset token will expire 60 minutes after being requested.',
        'outro2' => 'Thank you for using :name.',
        'salutation' => "Greetings,  \n   \n   \nTeam :name"
    ],
    'token' => 'password reset token',
];
