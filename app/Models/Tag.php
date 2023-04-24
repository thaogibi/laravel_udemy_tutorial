<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    public function posts() {
        return $this->belongsToMany('App\Models\Post')->withTimestamps()->as('tagged');   //->as('tagged'): nếu ko có -> thuộc tính xuất ra là pivot, nếu có thì xuất ra tagged
    }


}
