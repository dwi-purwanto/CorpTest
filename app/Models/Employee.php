<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['company_id', 'name', 'email'];

    public function company()
    {
        return $this->belongsTo('App\Models\Company')->select(array('id', 'name'));
    }
}
