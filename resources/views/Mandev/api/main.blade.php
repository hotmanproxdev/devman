@extends(''.config("app.admin_dirname").'/general')
@section('content')
  <div style="height:1900px;">
    @include(''.config("app.admin_dirname").'/api.api_content')
  </div>

@stop