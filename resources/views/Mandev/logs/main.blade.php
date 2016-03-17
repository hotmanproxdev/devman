@extends(''.config("app.admin_dirname").'/general')
@section('content')
  <div style="height:3500px;">
    @include(''.config("app.admin_dirname").'/logs.logs_content')
  </div>
@stop