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
		'code'		 => 'informasi',
		'name'		 => "Informasi",
		'label'		 => "informasi",
		'icon'		 => "info",
		'route_name' => "",
		'module' 	 => [],
		'child'      => [
			[
				'code'		 => "alurPendaftaran",
				'name'		 => "Alur Pendaftaran",
				'label'		 => "alurPendaftaran",
				'icon'		 => "",
				'route_name' => "cmsAlurPendaftaran",
				'module' 	 => [
					'code' => 'alurPendaftaran',
					'task' => []
				]
			],
			[
				'code'		 => "faq",
				'name'		 => "FAQ",
				'label'		 => "faq",
				'icon'		 => "",
				'route_name' => "cmsFaq",
				'module' 	 => [
					'code' => 'faq',
					'task' => []
				]
			],
		],
	],
	[
		'code'		 => 'master',
		'name'		 => "Master",
		'label'		 => "master",
		'icon'		 => "data",
		'route_name' => "",
		'module' 	 => [],
		'child'      => [
			[
				'code'		 => "programStudi",
				'name'		 => "Program Studi",
				'label'		 => "programStudi",
				'icon'		 => "",
				'route_name' => "cmsProgramStudi",
				'module' 	 => [
					'code' => 'programStudi',
					'task' => []
				]
			],
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
			
		],
	],
	[
		'code'		 => 'administrasi',
		'name'		 => "Administrasi",
		'label'		 => "administrasi",
		'icon'		 => "administrasi",
		'route_name' => "",
		'module' 	 => [],
		'child'      => [
			[
				'code'		 => "administrasi-normal",
				'name'		 => "Administrasi Normal",
				'label'		 => "administrasiNormal",
				'icon'		 => "",
				'route_name' => "cmsNominalAdministrasi",
				'module' 	 => [
					'code' => 'administrasiNormal',
					'task' => []
				]
			],
			[
				'code'		 => "keringanan",
				'name'		 => "Keringanan",
				'label'		 => "keringanan",
				'icon'		 => "",
				'route_name' => "cmsKeringanan",
				'module' 	 => [
					'code' => 'keringanan',
					'task' => []
				]
			],
			
		],
	],
	[
		'code'		 => 'listPendaftar',
		'name'		 => "List Pendaftar",
		'label'		 => "listPendaftar",
		'icon'		 => "clip-list",
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
		'icon'		 => "pay",
		'route_name' => "cmsPembayaran",
		'module'	 => [
			'code' => 'pembayaran',
			'task' => []
		],
		'child'      => []
	],
	[
		'code'		 => 'pilihanJurusan',
		'name'		 => "List Pendaftar Fixs",
		'label'		 => "pilihanJurusan",
		'icon'		 => "clip",
		'route_name' => "cmsPilihanJurusan",
		'module'	 => [
			'code' => 'pilihanJurusan',
			'task' => []
		],
		'child'      => [],
	],
	[
		'code'		 => 'laporan',
		'name'		 => "Laporan",
		'label'		 => "laporan",
		'icon'		 => "report",
		'route_name' => "cmsLaporan",
		'module' 	 => [
			'code' => 'laporan',
			'task' => []
		],
		'child'      => [],
	],
];