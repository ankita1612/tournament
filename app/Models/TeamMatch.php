<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMatch extends Model
{
    use HasFactory;
    protected $table="team_matches";
    public function team1_match()
    {
        return $this->belongsTo('App\Models\Team',"team_id");        
    }
    public function team2_match()
    {
        return $this->belongsTo('App\Models\Team',"team_id");        
    }
    public function winner_match()
    {
        return $this->belongsTo('App\Models\Team',"team_id");        
    }
   
}
