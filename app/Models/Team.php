<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id','name'
    ];
    public function group()
    {
        return $this->belongsTo('App\Models\Group',"group_id");        
    }
    public function match_team1()
    {
        return $this->hasMany('App\Models\TeamMatch',"team_1_id");        
    }
    public function match_team2()
    {
        return $this->hasMany('App\Models\TeamMatch',"team_2_id");        
    }
    public function match_winner()
    {
        return $this->hasMany('App\Models\TeamMatch',"winner_id");        
    }
}
