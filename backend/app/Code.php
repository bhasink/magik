<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Code extends Model
{

    protected $fillable = [
        'code','scan','campaign_id','campaign_name','image','qr_id','status','created_at','updated_at'];
}
