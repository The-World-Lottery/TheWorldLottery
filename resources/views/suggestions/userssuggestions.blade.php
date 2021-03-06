@extends('layouts.master')

@section('divHead')
<br>
<h2 id="hoverTrigger"><strong>Suggestion Box</strong></h2>
<p id="hoverSumm" hidden class="suggBox">The suggestion box is intended for users to be able to create a post detailing a charity or cause they know needs funding or a change that they would like to see us implement on the website. Suggestion priority is determined by the amount of User upvotes on each suggestion. Admins will address the top 5 suggestions every two weeks.</p>
@stop

@section('content')

<ul class="nav nav-tabs" style="display:flex;justify-content: space-around;">
  <li><a  id="zeroO" href="{{action('SuggestionsController@index')}}">All</a></li>
  <li><a  id="zeroO" href="{{action('SuggestionsController@highest')}}">Top 5</a></li>
  <li><a  id="zeroO" href="{{action('SuggestionsController@create')}}">Add Suggestion</a></li>
  <li class="active"><a href="{{action('SuggestionsController@userssuggestions')}}">Your Suggestions</a></li>
</ul>
{{-- 	<span style="float:right;padding-right:1em;">{!! $suggestions->appends(Request::except('page'))->render() !!}</span> --}}

    <main class="container" style="max-width:100%;">

    <div class="row" style="padding:2em 0 2em 0;">

      @if(count($suggestions))
        @foreach($suggestions as $suggestion)

            <a href="{{ action('SuggestionsController@show', $suggestion->id) }}">
                <div class ="suggHead">{{$suggestion->title}}</div>
            </a>
            <a href="{{action('SuggestionsController@upvote',$suggestion->id)}}"><span class="glyphicon glyphicon-thumbs-up"></span></a>
            <span style="font-size: 180%;">{!!
                  \App\Models\Vote::where('suggestion_id',$suggestion->id)->where('vote',1)->get()->count() -
                  \App\Models\Vote::where('suggestion_id',$suggestion->id)->where('vote',-1)->get()->count()
                 !!}</span>
            <a href="{{action('SuggestionsController@downvote',$suggestion->id)}}"><span class="glyphicon glyphicon-thumbs-down"></span></a>


            <p>{{$suggestion->content}}</p>
            <p>__By {{$suggestion->user->name}}</p>

        @endforeach
      @else
        <div style="text-align: center;">
        <h1>You have no Suggestions!!</h1>
        <br>
        <div>Click here to give us feedback!!</div>
        <br>
       <a href="{{action('SuggestionsController@create')}}"> <button class="btn btn-primary" >GO!</button></a>
       </div>
      @endif
        <br>
    </div>

    </main>

@stop