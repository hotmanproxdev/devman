@if(config("app.theme")==1) {{--*/ $theme='general' /*--}} @else {{--*/ $theme='general'.config("app.theme").'' /*--}} @endif
@extends(''.config("app.admin_dirname").'/'.$theme.'')
@section('content')
  @include(''.config("app.admin_dirname").'/apicenter.apicenter_content')
@stop