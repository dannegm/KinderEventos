<?php

namespace App\Http\Controllers;

class PagesController extends Controller {
	
	public function download () {
		$data = [
			'title' => 'Descargar Aplicación',
			'section' => 'pages'
		];
		return view ('panel.pages.download', $data);
	}
}
