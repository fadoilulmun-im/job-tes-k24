<?php

return [
  'default_password' => env('DEFAULT_PASSWORD', '123456'),
  'role' => [
    'administrator' => env('ROLE_ADMININSTRATOR_ID', 1),
    'member' => env('ROLE_MEMBER_ID', 2),
  ],
];