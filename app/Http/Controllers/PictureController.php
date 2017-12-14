<?php

namespace App\Http\Controllers;

use File;
use App\Picture;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail as Mail;
use Illuminate\Foundation\Application as Ap;

class PictureController extends Controller {

	// API
	public function upload (Request $request) {
		set_time_limit(3600);
		$up = $request->hasFile('picture');
		$data = [];

		if ($up) {
			$image = $request->file ('picture');
			$md5 = md5_file ($image);
			$imagen = Picture::whereMd5 ($md5)->get ();

			if ($imagen->isEmpty ()) {
				$ext = $image->getClientOriginalExtension ();
				$filename = "{$md5}.{$ext}";

				$image->move ('pictures', $filename);
				$fileUrl = asset ('pictures/' . $filename);

				$picture = new Picture;
				$picture->md5 = $md5;
				$picture->filename = $filename;

				$picture->email = $request->input('email');
				$picture->event_id = $request->input('event_id');

				$picture->save ();

				Mail::send ('mails.photo', ['data' => $data], function ($m) use ($data) {
					$m->from ('no-reply@ferrero.com.mx', 'Kinder Sorpresa');
					$m->to ($data ['email']);
					$m->subject('¡Mira tu foto Kinder!');
					$m->attach($data ['local_path']);
				});

				if (!Mail::failures()) {
					$picture->is_sended = 1;
					$picture->save ();

					$data = [
						'md5' => $md5,
						'status' => 'success',
						'message' => 'Foto guardada y enviada con éxito',
						'path' => $fileUrl,
						'filename' => $filename,
						'public_path' => asset ("/pictures/{$filename}"),
						'local_path' => $this->public_path () . "/pictures/{$filename}",
						'email' => $request->input('email'),
					];
				} else {
					$data = [
						'md5' => $md5,
						'status' => 'nosend',
						'message' => 'La foto fue guardada pero no se envió el correo',
						'path' => $fileUrl,
						'filename' => $filename,
						'public_path' => asset ("/pictures/{$filename}"),
						'local_path' => $this->public_path () . "/pictures/{$filename}",
						'email' => $request->input('email'),
					];
				}
			} else {
				$fileUrl = asset ('pictures/' . $imagen[0]->filename);
				$data = [
					'md5' => $imagen[0]->md5,
					'status' => 'repeat',
					'path' => $fileUrl,
					'filename' => $imagen[0]->filename,
					'public_path' => asset ("/pictures/{$imagen[0]->filename}"),
					'local_path' => $this->public_path () . "/pictures/{$imagen[0]->filename}",
					'email' => $imagen[0]->email,
				];
			}
		} else {
			$data = [
				'status' => 'error',
				'message' => 'No se encontró imagen para subir.',
			];
		}
		return response ()->json ($data);

	}

	public function senByEmail (Request $request) {
		$md5 = $request->input ('md5');
		$pictures = Picture::whereMd5 ($md5)->get ();
		$picture = $pictures[0];

		$data = [
			'local_path' => $this->public_path () . "/pictures/{$picture->filename}",
			'email' => $picture->email,
		];

		Mail::send ('mails.photo', ['data' => $data], function ($m) use ($data) {
			$m->from ('no-reply@ferrero.com.mx', 'Kinder Sorpresa');
			$m->to ($data ['email']);
			$m->subject('¡Mira tu foto Kinder!');
			$m->attach($data ['local_path']);
		});

		return response ()->json ($data);
	}

	public function setAsPrinted (Request $request) {
		$md5 = $request->input ('md5');
		$pictures = Picture::whereMd5 ($md5)->get ();
		$picture = $pictures[0];

		$picture->is_printed = 1;
		$picture->save ();

		return response ()->json ($picture);
	}

	public function delete (Request $request) {
		$md5 = $request->input ('md5');
		$pictures = Picture::whereMd5 ($md5)->get ();
		$picture = $pictures[0];

		File::delete ('pictures/' . $picture->filename);
		$picture->delete ();

		$data = [
			'status' => 'success'
		];
		return response ()->json ($data);
	}

	public function list ($group = 'all') {
		$pictures = Picture::all ();
		$data = [
			'status' => 200,
			'data' => $pictures
		];
		return response ()->json ($data);
	}

	public function public_path () {
		 return __DIR__ . '/../../../public_html';
	}
}