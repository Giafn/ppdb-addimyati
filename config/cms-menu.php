<?php

return [
	[
		'code'		 => 'dashboard',
		'name'		 => "Dashboard",
		'label'		 => "dashboard",
		'icon'		 => "dashboard",
		'route_name' => "cmsDashboard",
		'module'	 => [
			'code' => 'dashboard',
			'task' => []
		],
		'child'      => [],
	],
	[
		'code'		 => 'system',
		'name'		 => "System",
		'label'		 => "system",
		'icon'		 => "cog",
		'route_name' => "",
		'module' 	 => [],
		'child'      => [
			[
				'code'		 => "user-level",
				'name'		 => "User Level",
				'label'		 => "userLevel",
				'icon'		 => "",
				'route_name' => "cmsUserLevel",
				'module' 	 => [
					'code' => 'user-level',
					'task' => []
				]
			],
			[
				'code'		 => "user",
				'name'		 => "User",
				'label'		 => "user",
				'icon'		 => "",
				'route_name' => "cmsUser",
				'module' 	 => [
					'code' => 'user',
					'task' => []
				]
			],
		],
	],
	[
		'code'		 => 'master',
		'name'		 => "Master",
		'label'		 => "master",
		'icon'		 => "cog",
		'route_name' => "",
		'module' 	 => [],
		'child'      => [
			[
				'code'		 => "ppdb",
				'name'		 => "PPDB Setting",
				'label'		 => "ppdbSetting",
				'icon'		 => "",
				'route_name' => "cmsPpdbSetting",
				'module' 	 => [
					'code' => 'ppdb',
					'task' => []
				]
			],
			[
				'code'		 => "nominalAdministrasi",
				'name'		 => "Nominal Administrasi",
				'label'		 => "nominalAdministrasi",
				'icon'		 => "",
				'route_name' => "cmsNominalAdministrasi",
				'module' 	 => [
					'code' => 'nominalAdministrasi',
					'task' => []
				]
			],
			[
				'code'		 => "jurusan",
				'name'		 => "Jurusan",
				'label'		 => "jurusan",
				'icon'		 => "",
				'route_name' => "cmsJurusan",
				'module' 	 => [
					'code' => 'jurusan',
					'task' => []
				]
			],

		],
	],
	[
		'code'		 => 'listPendaftar',
		'name'		 => "List Pendaftar",
		'label'		 => "listPendaftar",
		'icon'		 => "dashboard",
		'route_name' => "cmsListPendaftar",
		'module'	 => [
			'code' => 'listPendaftar',
			'task' => []
		],
		'child'      => [],
	],
	[
		'code'		 => 'pembayaran',
		'name'		 => "Pembayaran",
		'label'		 => "pembayaran",
		'icon'		 => "dashboard",
		'route_name' => "cmsPembayaran",
		'module'	 => [
			'code' => 'pembayaran',
			'task' => []
		],
		'child'      => [],
	],
];