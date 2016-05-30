@if(config("app.theme")==1) {{--*/ $theme='general' /*--}} @else {{--*/ $theme='general'.config("app.theme").'' /*--}} @endif
@extends(''.config("app.admin_dirname").'/'.$theme.'')
@section('content')
  @include(''.config("app.admin_dirname").'/managers.managers_content')
@stop