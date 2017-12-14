<?php

namespace App\Http\Controllers;
use Jenssegers\Agent\Agent;

class PagesController extends Controller {
	
	public function download () {
		$data = [
			'title' => 'Descargar Aplicación',
			'section' => 'pages',
			'agent' => new Agent (),
		];
		return view ('panel.pages.download', $data);
	}
}
