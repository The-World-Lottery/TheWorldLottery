<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaffleEntry extends Model
{
	protected $fillable = ['user_id', 'lottery_id'];

    public function user()
    {
   		return $this->belongsTo('App\User','user_id');
   	}

   	public function raffle()
   	{
   	return $this->belongsTo('App\Models\Raffle','raffle_id');
   }
}