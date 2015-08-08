@extends('master')
@section('content')
    <br>
    <br>
    <div class="col-lg-8 col-lg-offset-2">
        <div class="bs-component">
            <div class="well">
                {{ Form::open([ 'action' => 'StackExchangeController@search', 'class' => 'clearfix', 'style' => 'padding:1em 3em;']) }}
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            {{ Form::label('stackExchangeSearch', 'Stack Exchange Search: ') }}
                            {{ Form::input('text', 'stackExchangeSearch', null, array('class' => 'form-control')) }}
                            {{ $errors->first('stackExchangeSearch', '<p class="text-danger" style="padding:1em;">:message</p>') }}
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ Form::label('count', '# of results:') }}
                            <br>
                            {{ Form::select('count', array('5' => '5', '10' => '10', '15' => '15'), null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
                <button class="btn btn-success" type="submit">Submit</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection