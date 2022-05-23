	<table border="1">
		<tr>
			<td>Tournament id</td>
			<td>Tournament name</td>
			<td>group name</td>
			<td>team name</td>			
		</tr>

	@for($i=0;$i<count($tournament_data['tournament']);$i++)
		@for($j=0;$j < count($tournament_data['tournament'][$i]['team']);$j++)
			@for($k=0;$k < count($tournament_data['tournament'][$i]['team'][$j]['match_team1']);$k++)
			<tr>
				<td>{{$tournament_data['id']}}</td>
				<td>{{$tournament_data['name']}}</td>
				<td>{{$tournament_data['tournament'][$i]['name']}}</td>
				<td>{{$tournament_data['tournament'][$i]['team'][$j]['name']}}</td>

				
			</tr>
		@endfor	
	@endfor
	</table>

	<a href="{{route("calculate_match",$tournament_data['id'])}}">Calculate Match</a>