<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Picture extends Model {
	protected $table = 'pictures';

	public function isPrinted () {
		return $this->is_printed ? true : false;
	}

	public function dateString () {
		Carbon::setLocale('es');
		$dt = Carbon::parse ($this->created_at);
		return $dt->format ('M j, g:i a');
	}

	public function parentEvent () {
		return $this->hasOne('App\Event', 'id', 'event_id');
	}
}
