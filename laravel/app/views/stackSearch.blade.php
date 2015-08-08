@extends('master')
@section('content')
    <br>
    <br>
    <div class="col-lg-9">
        <div class="bs-component">
            <div class="well">
                {{ Form::open([ 'action' => 'StackExchangeController@search', 'class' => 'clearfix', 'style' => 'padding:1em 3em;']) }}
                <div class="form-group">
                    {{ Form::label('stackExchangeSearch', 'Stack Exchange Search: ') }}
                    {{ Form::input('text', 'stackExchangeSearch', null, array('class' => 'form-control')) }}
                    {{ $errors->first('stackExchangeSearch', '<p class="text-danger" style="padding:1em;">:message</p>') }}
                </div>
                <button class="btn btn-success" type="submit">Submit</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection