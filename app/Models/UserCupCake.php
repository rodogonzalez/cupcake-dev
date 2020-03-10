<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
class UserCupCake extends Model
{
    use CrudTrait;
    //
    protected $table   = 'stores_product_user_picks';

    
    protected $fillable = ['user_id','store_id','programmed_date_to_pick','was_retired'];

    public function user()
    {
        return $this->belongsTo(App\Models\User::class);
    }

    public function store()
    {
        return $this->belongsTo(App\Models\Store::class);
    }
    protected function getEmailAttribute($value){

        $user = \App\Models\User::find($this->attributes['user_id']);
        return  $user->email;

    }
    protected function getStoreNameAttribute($value){
        $store = \App\Models\Store::find($this->attributes['store_id']);
        return  $store->name;

    }

    
}
