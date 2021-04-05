<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class GiftAssignments extends Model
{
	protected $table = 'giftbypincodes';
    protected $fillable = [
        'gift_id','campaign_id','quantity','state_id','status','created_at','updated_at'];
}
