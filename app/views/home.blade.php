@extends('master')
@section('content')

	{{ Form::open([ 'action' => 'TwitterController@search', 'class' => 'clearfix', 'style' => 'padding:1em 3em;']) }}
		<!--twitterSearch Form Input-->
		<div class="form-group">
			{{ Form::label('twitterSearch', 'Twitter Search: ') }}
			{{ Form::input('text', 'twitterSearch', null, array('class' => 'form-control')) }}
		</div>
		<button class="btn btn-success" type="submit">Submit</button>
	{{ Form::close() }}

@endsection