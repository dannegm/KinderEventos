<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model {
	protected $table = 'events';

	public function startedString () {
		Carbon::setLocale('es');
		$dt = Carbon::parse ($this->started_at);
		return $dt->toFormattedDateString ();
	}
	public function endededString () {
		Carbon::setLocale('es');
		$dt = Carbon::parse ($this->ended_at);
		return $dt->toFormattedDateString ();
	}

	public function pictures () {
		return $this->hasMany('App\Picture', 'event_id', 'id');
	}
}
