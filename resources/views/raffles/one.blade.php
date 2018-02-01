<a style="" href="{{ action('RafflesController@show', $raffle->id) }}">
	<div class="col-sm-12 col-md-12 text-center" style="margin:1em 0 1em 0;display:flex;justify-content: center;">
		<figure class="raffleCont" style='background-image:url("{{$raffle->img}}");'>
			<div style="border-radius:1em;background-color:rgba(0,0,0,.8);height:100%;display:none;">
				<div style="position:relative;height:100%;width:100%;">
					<div style="padding-top: 10%;">
						<h2 class="white" style="margin:0 .5em 0 .5em;">{{$raffle->title}}</h2>
					</div>
					<p style="position:absolute;bottom:5%;width:100%;">Drawing Happens<br>
						<span style="color:#00ffc4;">{{$raffle->end_date->diffForHumans()}}</span>
					</p>
				</div>
			</div>
		</figure>
	</div>
</a>