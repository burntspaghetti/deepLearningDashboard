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

    <h1>Sentiment</h1>
    <hr/>

    <table id="sentiment" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>App ID</th>
            <th>Name</th>
            <th>ID</th>
            <th>Application Status</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Blah</td>
            <td>fetus</td>
            <td>ricky</td>
            <td>bobby</td>
        </tr>
        </tbody>
    </table>


    <h1>Entities</h1>
    <hr/>

    <table id="entities" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>App ID</th>
            <th>Name</th>
            <th>ID</th>
            <th>Application Status</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Blah</td>
            <td>fetus</td>
            <td>ricky</td>
            <td>bobby</td>
        </tr>
        </tbody>
    </table>


    <h1>Keywords</h1>
    <hr/>

    <table id="keywords" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>App ID</th>
            <th>Name</th>
            <th>ID</th>
            <th>Application Status</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Blah</td>
            <td>fetus</td>
            <td>ricky</td>
            <td>bobby</td>
        </tr>
        </tbody>
    </table>





    <script>
        $(document).ready( function () {
            $('#sentiment').DataTable();
        } );

        $(document).ready( function () {
            $('#entities').DataTable();
        } );

        $(document).ready( function () {
            $('#keywords').DataTable();
        } );
    </script>
@endsection