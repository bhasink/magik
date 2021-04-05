<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Campaign extends Model
{
	protected $table='campaigns';
	protected $guarded=[];
	
    public function getCampaign($campaignid)
   {
	    $codecount= Code::where('campaign_id','=',$campaignid)->where('scan','=',1)->count();
        return  $codecount;
	   
   }
}
