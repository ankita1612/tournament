<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'tournament_id','name','no_of_teams','extra_team_id'
    ];

    public function tournament()
    {
        return $this->belongsTo('App\Models\Tournament',"tournament_id");        
    }
    public function team()
    {
        return $this->hasMany('App\Models\Team',"group_id")->with(['match_team1','match_team2','match_winner']);        
    }
    //
    //
}
