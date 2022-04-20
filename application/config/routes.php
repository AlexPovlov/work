<?php

return [

	'' => [
		'controller' => 'main',
		'action' => 'index',
	],

	'data/{id:\d+}' => [
		'controller' => 'main',
		'action' => 'data',
	],

	
	'admin' => [
		'controller' => 'admin',
		'action' => 'index',
	],

	'admin/delete/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'delete',
	],

	'admin/update/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'update',
	],

	'login' => [
		'controller' => 'login',
		'action' => 'index',
	],

	'logout' => [
		'controller' => 'login',
		'action' => 'logout',
	],

	
	
	
];