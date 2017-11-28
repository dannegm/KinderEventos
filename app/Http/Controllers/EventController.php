<?php

namespace App\Http\Controllers;

use App\Event;
use App\Picture;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class EventController extends Controller {
	
	public function viewIndex () {
		$data = [
			'title' => 'Eventos',
			'section' => 'events',
			'events' => Event::where('is_deleted', 0)->paginate (12)
		];
		return view ('panel.events.index', $data);
	}
	
	public function viewEvent (Request $request, $permalink) {
		$events = Event::where ('permalink', $permalink)->get();
		$event = $events[0];

		$from = Carbon::today();
		$to = Carbon::today()->addDay();

		if ($request->has('day')) {
			$from = Carbon::parse ($request->input('day'));
			$to = Carbon::parse ($request->input('day'))->addDay();
		}

		$data = [
			'title' => $event->name,
			'section' => 'events',
			'event' => $event,
			'pictures' => $event->pictures ()
				->where('created_at', '>', $from)
				->where('created_at', '<', $to)
				->orderBy('created_at', 'desc')
				->paginate (24)
		];
		return view ('panel.events.view', $data);
	}
	
	public function findByEmail (Request $request) {
		$email = $request->input('email');
		$data = [
			'title' => 'Resultados de búsqueda',
			'section' => 'events',
			'searching' => $email,
			'pictures' => Picture::where ('email', 'LIKE', "%{$email}%")
				->orderBy('created_at', 'desc')
				->paginate (24)
		];
		return view ('panel.events.results', $data);
	}

	public function viewNew () {
		$data = [
			'title' => 'Evento',
			'section' => 'events',
		];
		return view ('panel.events.new', $data);
	}

	public function viewEdit ($id) {
		$event = Event::where ('id', '=', $id)->take(1)->get();
		$data = [
			'title' => 'Evento',
			'section' => 'events',
			'event' => $event[0]
		];
		return view ('panel.events.edit', $data);
	}

	// Actions
	public function actionCreate (Request $request) {
		$rules = array(
			'name' => 'required',
			'started_at' => 'required',
			'ended_at' => 'required',
		);

		$messages = array (
			'name.required' => 'El nombre del evento es obligatorio',
			'started_at.required' => 'La fecha de inicio del evento es obligatoria',
			'ended_at.required' => 'La fecha de fin del evento es obligatoria',
		);

		//check validation
		$validator = Validator::make ($request->all (), $rules, $messages);

		if ($validator->fails ()) {
			$messages = $validator->messages ();
			return redirect ()->route ('events.new')->withErrors ($validator)->withInput ();

		} else {
			$event = new Event;
			$event->name = $request->input('name');
			$event->place = $request->input('place');
			$event->started_at = $request->input('started_at');
			$event->ended_at = $request->input('ended_at');
			$event->description = $request->input('description');

			function hyphenize ($string) { return strtolower( preg_replace( array('#[\\s-]+#', '#[^A-Za-z0-9\-]+#'), array('-', ''), urldecode($string) ) ); }
			$event->permalink = hyphenize ($request->input('name'));
			$event->save();

			return redirect ()->route ('events.index');
		}
	}

	public function actionUpdate (Request $request, $id) {
		$rules = array(
			'name' => 'required',
			'started_at' => 'required',
			'ended_at' => 'required',
		);

		$messages = array (
			'name.required' => 'El nombre del evento es obligatorio',
			'started_at.required' => 'La fecha de inicio del evento es obligatoria',
			'ended_at.required' => 'La fecha de fin del evento es obligatoria',
		);

		//check validation
		$validator = Validator::make ($request->all (), $rules, $messages);

		if ($validator->fails ()) {
			$messages = $validator->messages ();
			return redirect ()->route ('events.edit')->withErrors ($validator);

		} else {
			$events = Event::where('id', '=', $id)->take(1)->get();
			$event = $events[0];

			$event->name = $request->input('name');
			$event->place = $request->input('place');
			$event->started_at = $request->input('started_at');
			$event->ended_at = $request->input('ended_at');
			$event->description = $request->input('description');
			$event->save();

			return redirect ()->route ('events.index');
		}
	}

	public function actionDelete ($id) {
		$events = Event::where('id', '=', $id)->take(1)->get();
		$event = $events[0];
		$event->is_deleted = 1;
		$event->save ();
		return redirect ()->route ('events.index');
	}

	// API
	
	public function jsonEvents () {
		return response ()->json ([
			'Items' => Event::where('is_deleted', 0)->get()
		]);
	}
}
