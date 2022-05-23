<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Group;
use App\Models\Team;
use App\Models\TeamMatch;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;    


class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     /*   $no_of_teams_grpA="6";
        $no_of_teams_grpB="7";
        DB::enableQueryLog();
        $tournament   =   Tournament::create(            
            [
            'name' => "Tournament_".date("ymdhis")
            ]);    
        $tournament_id = DB::getPdo()->lastInsertId();;

        $group_array[0]=[
            'tournament_id'=>$tournament_id,
            'name' => 'group_A',
            'no_of_teams'=>$no_of_teams_grpA,
            'extra_team_id'=>""
        ];
        $group_array[1]=[
            'tournament_id'=>$tournament_id,
            'name' => 'group_B',
            'no_of_teams'=>$no_of_teams_grpB,
            'extra_team_id'=>"B".$no_of_teams_grpB
        ];
           
            
        for($i =0; $i < count($group_array); $i++) 
        {        
            $team=[];        
            $group   =   Group::create($group_array[$i]);
            $group_id = DB::getPdo()->lastInsertId();
            if($i==0)
            {
                for($j=0;$j<$no_of_teams_grpA;$j++)    
                {
                    $team[]=[
                        'group_id'=>$group_id,
                        'name' => 'A'.$j+1
                    ];                    
                }
            }

            if($i==1)
            {
                for($j=0;$j<$no_of_teams_grpB;$j++)    
                {
                    $team[]=[
                        'group_id'=>$group_id,
                        'name' => 'B'.$j+1                       
                    ];
                }
            }
           
            for($j =0;$j<count($team);$j++) 
            { 
                Team::create($team[$j]);
            }          
        }    
*/
        $tournament_id=31;
        //$tournament_data=Tournament::with("tournament")->where("id",$tournament_id)->first()->toArray();
        $tournament_data=Tournament::with("tournament")->where("id",$tournament_id)->first()->toArray();
         // echo "<pre>";
         // print_R($tournament_data);
        
        return view('tournament_list', compact('tournament_data'));
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calculate_match($tournament_id)
    {        
       /* $group_data=Group::where("tournament_id",$tournament_id)->get()->toArray();
        for($i=0;$i<count($group_data);$i++)
        {
            $limit=$group_data[0]['no_of_teams'];
            $team_data=Team::where("group_id",$group_data[$i])->limit($limit)->get()->toArray();                
            // echo "<hr>";
            // pr($team_data);
            // continue;
            //interleague

            for($j=0;$j<count($team_data);$j++)
            {
                for($k=$j+1;$k<count($team_data);$k++)
                {
                    $team_1_id=$team_data[$j]['id'];
                    $team_2_id=$team_data[$k]['id'];
                    for($a=0;$a<2;$a++)
                    {
                         $match_combination = array($team_1_id,$team_2_id);
                       // pr($match_combination);
                        

                        $team_match[]=[
                            'team_1_id'=>$team_1_id,
                            'team_2_id' => $team_2_id,
                            'winner_id' => $match_combination[array_rand($match_combination)],
                            'match_type' => 'Leage'
                        ];   

                    }
                   

                }
            }
            echo "Match result";
            pr($team_match);

            for($k=0;$k<count($team_match);$k++)
            {
                TeamMatch::create($team_match[$k]);
            }
            
        }*/

        //generate Quarter final
         $group_data=Group::select("id")->where("tournament_id",$tournament_id)->get()->toArray();
         pr($group_data);

        //$arr = array_map(function($el){ return $el['id']; }, $group_data);
         for($i=0;$i<count($group_data);$i++)
         {
            if($i==0)
                $limit=4;
            else if($i==1)
            {
                $limit=3;
                $team_data_extra=Team::where("group_id",$group_data[$i]['id'])->limit(1)->orderBy("id","desc")->first()->toArray();
                pr($team_data_extra);               

            }

            DB::enableQueryLog();
            /*$team_data=Team::with("match_team1")->whereHas("match_team1", function ($q) {                        
                        $q->where('match_type', 'Leage');
                    })->where("group_id",$group_data[$i]['id'])->get()->toArray();*/
           $team_data=Team::where("group_id",$group_data[$i]['id'])->get()->toArray();

            $team[$i]['team_id_array']=array();
            $team[$i]['team_id_name_array']=array();
            
            for($k=0;$k<count($team_data);$k++)
            {
                $team[$i]['team_id_array'][]=$team_data[$k]['id'];
                $team[$i]['team_id_name_array'][$team_data[$k]['id']]=$team_data[$k]['name'];
            }
            $team_str=implode(",",$team[$i]['team_id_array']);
            echo "<br>".$sql='select winner_id ,count(winner_id) as total from team_matches where match_type="Leage" and (team_1_id in('.$team_str.')  or team_2_id in('.$team_str.' )) group By winner_id order by count(winner_id) desc limit 0,'.$limit;
            $data=DB::select($sql);
            $team_result[]=obj_to_array($data);
            // echo "<br>++++++++++++";
            // pr($data);
            // echo "<<++++++++++++";
            
             
         }         
         pr($team_result[1]);
         $team_result[1]=array_merge($team_result[1],array(count($team_result[1])+1=>array("winner_id" => $team_data_extra['id'],"total" => 0)));
         pr($team_result);
         //pr( DB::getQueryLog());
        // pr( $team_data);
          
 
    }

   
}
