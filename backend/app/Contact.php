<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Contact extends Model
{

    protected $guarded=[];

    public function giftname($id){
        $gift= Gift::where('id','=',$id)->first();
        return $gift['gift_name'];
    }
}
