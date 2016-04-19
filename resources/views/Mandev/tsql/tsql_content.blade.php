@if($pageRole==false)
    @include("".config("app.admin_dirname").".noauth")
@else

<div class="row">
  <div class="col-md-12">
    <div class="note note-bordered note-success">
      <p>
        content write
      </p>

    </div>
  </div>
</div>

@section("tsql")

{!! $query !!}

{!! $query2 !!}

@show

@endif

