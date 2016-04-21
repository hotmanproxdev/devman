@if($pageRole==false)
    @include("".config("app.admin_dirname").".noauth")
@else


  <div class="row">
    <div class="col-md-12">
      <div class="note note-bordered note-success">
        <p>
          {{$api_top_info}}
        </p>
        <p>
          <span class="label label-warning">{{$api_top_info1}}:</span>&nbsp; {{$api_top_info2}}
        </p>
        <p>
          {{$more}} <span style="color:#336699;">{{$contact}}</span>
        </p>
      </div>
    </div>
  </div>


  <div style="margin:0 0 5px 0;">

    <div class="divlay">
      <a class="indent btn btn-lg blue xmodal" model="apicenter/newapiuser" modal-title="{{$newapiuser}}" data-target="#full-width" href="#full-width" data-toggle="modal">
        {{$newapiuser}} <i class="fa fa-plus"></i>
      </a>
    </div>



    <div class="clear"></div>

  </div>

  @section("tsql")

  {!! $query !!}

  @show

@endif