@if($pageRole==false)
    @include("".config("app.admin_dirname").".noauth")
@else


{!! $query !!}

@endif