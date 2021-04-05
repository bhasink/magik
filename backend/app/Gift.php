<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Gift extends Model
{

    protected $fillable = [
        'gift_name','gift_img','quantity','status','type','campaign_id','created_at','updated_at'];
}
