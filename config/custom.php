<?php

return [
	'url_s' => env('URL_S', 'http://192.168.1.1:1020/api/v1/'),
	'captcha_secret_key' => env("GOOGLE_PRIVATE_KEY", "6LcXcDoUAAAAAC2z_V0YXJyqldFQUkEhRz7oILJK"),
	'session_pre' => env('SESSION_PRE', '_'),
	'version' => env('VERSION', '1.1'),
];