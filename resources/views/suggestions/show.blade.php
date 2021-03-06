@extends('layouts.master')

@section('title')

{{-- <title>Suggestion</title> --}}

@stop

{{-- @section('divHead')

<span>Suggestion #{{($suggestion->id)-1}} </span>

@stop --}}

@section('content')
	<br>
	<main class="container" style="max-width:100%;font-size:120%;">

		<h2 class="text-center">{{$suggestion['title']}}</h2>
		@if(Auth::check())
		<div style="display:flex;justify-content:center;">
			<a href="{{action('SuggestionsController@upvote',$suggestion->id)}}"><span class="glyphicon glyphicon-thumbs-up"></span></a>
			<span style="font-size: 180%;">{!!
                  \App\Models\Vote::where('suggestion_id',$suggestion->id)->where('vote',1)->get()->count() -
                  \App\Models\Vote::where('suggestion_id',$suggestion->id)->where('vote',-1)->get()->count()
                 !!}</span>
	        <a href="{{action('SuggestionsController@downvote',$suggestion->id)}}"><span class="glyphicon glyphicon-thumbs-down"></span></a>
	    </div>
	    @endif
		<p>{{$suggestion['content']}}</p>
		<p>By : {{$suggestion->user->name}}</p>
		<p>Posted : {{$suggestion->created_at->diffForHumans()}}</p>
		<p>Last Updated : {{$suggestion->updated_at->diffForHumans()}}</p>
		

	
		
	</main>
	<div class="container" style="display:flex;justify-content: center;">
		@if (Auth::check() && (Auth::id() == $suggestion->user_id || Auth::user()->is_admin))
		<a class="btn-warning clearorangeBtn btn" href="{{ action('SuggestionsController@edit', $suggestion->id) }}">Edit</a>
		@endif
	</div>

@stop