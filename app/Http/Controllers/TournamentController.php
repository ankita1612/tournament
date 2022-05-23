<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Group;
use App\Models\Team;
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
            //$tournament_data=Tournament::with("tournament")->where("id",$tournament_id)->first()->toArray();
            //$group_data=Group::with("team")->where("tournament_id",$tournament_id)->first()->toArray();
            $group_data=Group::where("tournament_id",$tournament_id)->get()->toArray();
            for($i=0;$i<count($group_data);$i++)
            {
                $team_data=Team::where("tournament_id",$tournament_id)->get()->toArray();
                echo "<pre>";
                print_R($group_data);
                exit;    
            }
            

    //         for($i=0;$i<count($tournament_data['tournament']);$i++)

    //             for($j=0;$j < count($tournament_data['tournament'][$i]['team']);$j++)
    //         <tr>
    //             <td>{{$tournament_data['id']}}</td>
    //             <td>{{$tournament_data['name']}}</td>
    //             <td>{{$tournament_data['tournament'][$i]['name']}}</td>
    //             <td>{{$tournament_data['tournament'][$i]['team'][$j]['name']}}</td>

                
    //         </tr>
    //     @endfor 
    // @endfor

    }

   
}
