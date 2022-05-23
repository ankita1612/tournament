<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;
    protected $fillable = [ 'name'];
    public function tournament()
    {
        return $this->hasMany('App\Models\Group',"tournament_id")->with("team");        
        //->with('match_team1')
    }
}
