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
      <a class="indent btn btn-lg blue xmodal" model="api/newapiuser" modal-title="{{$newapiuser}}" data-target="#full-width" href="#full-width" data-toggle="modal">
        {{$newapiuser}} <i class="fa fa-plus"></i>
      </a>
    </div>

    <div class="divlay">
      <a href="javascript:;" class="indent btn btn-lg red">
        Api Logları <i class="fa fa-file-o"></i>
      </a>
    </div>

    <div class="divlay">
      <a href="javascript:;" class="indent btn btn-lg yellow">
        Api Modelleme ve Data Bilgileri <i class="fa fa-list"></i>
      </a>
    </div>

    <div class="clear"></div>

  </div>


  <!-- BEGIN SAMPLE TABLE PORTLET-->
  <div class="portlet box purple">
    <div class="portlet-title">
      <div class="caption">
        <i class="fa fa-cogs"></i>{{$api_table_info}}
      </div>

    </div>

    <div class="portlet-body">

      <!--filter-->
      <form action="api/filter" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div style="">

        <div class="divlay" style="width:20%;">
          <select name="system_ccode" class="indent form-control">

            {!! app("\Filter")->get(['none'=>$systemCode,'data'=>$system_codes,'name'=>'system_ccode','type'=>'select']) !!}

          </select>
        </div>

        <div class="divlay" style="width:20%;">
          <select name="ccode" class="indent form-control ccode">

            {!! app("\Filter")->get(['none'=>$apiGroup,'develop'=>'Developer','guest'=>'Guest','name'=>'ccode','type'=>'select']) !!}
          </select>
        </div>

        <div class="divlay" style="width:20%;">
          {!! app("\Filter")->get(['name'=>'apikey','placeholder'=>'Apikey Belirtin...','type'=>'input','class'=>'indent form-control']) !!}
        </div>

        <div class="divlay" style="width:20%;">
          <select name="access_service_key" class="indent form-control">

            {!! app("\Filter")->get(['none'=>$statu,'1'=>$active,'2'=>$passive,'name'=>'access_service_key','type'=>'select']) !!}
          </select>
        </div>

        <div class="divlay" style="width:20%;">
          <input type="submit" name="filter" class="form-control btn1" value="Api Filtrele">
        </div>

        <div class="clear"></div>

      </div>
      </form>
      <!--filter end-->

      <div class="table-scrollable">

        <table class="table table-striped table-bordered table-hover">
          <thead>
          <tr>
            <th scope="col" style="width:450px !important">
              Id:
            </th>

            <th scope="col" style="width:450px !important">
              {{$process}}:
            </th>

            <th scope="col" style="width:450px !important">
              {{$ccode}}:
            </th>
            <th scope="col">
              {{$api_group}}:
            </th>
            <th scope="col">
              Static Ip:
            </th>
            <th scope="col">
              Api Key:
            </th>
            <th scope="col">
              {{$statu}}
            </th>
            <th scope="col">
              {{$date}}:
            </th>
            <th scope="col">
              Hash:
            </th>
            <th scope="col">
              Standart Key:
            </th>

            @if($admin->system_number==0)
            <th scope="col">
              {{$daily_hash_number}}:
            </th>
            @endif

            @if($admin->system_number==0)
            <th scope="col">
              {{$daily_hash_limit}}:
            </th>
            @endif

            <th scope="col">
              {{$access_services}}:
            </th>

            <th scope="col">
              {{$forbidden_access_services}}:
            </th>

            @if($admin->system_number==0)
            <th scope="col">
              Insert Mode:
            </th>
            @endif

            @if($admin->system_number==0)
            <th scope="col">
              Update Mode:
            </th>
            @endif

            @if($admin->system_number==0)
            <th scope="col">
              Delete Mode:
            </th>
            @endif

            @if($admin->system_number==0)
            <th scope="col">
              Url Filter Mode:
            </th>
            @endif

            <th scope="col">
              {{$daily_request_limit}}:
            </th>
            <th scope="col">
              {{$daily_request_limit_number}}:
            </th>

            <th scope="col">
              {{$service_request_type}}:
            </th>
          </tr>
          </thead>
          <tbody>
          @foreach ($apiAccesses as $result)
          <tr>
            <td>
              {{$result->id}}
            </td>

            <td>
              <a class="xmodal" model="api/edit?id={{$result->id}}" modal-title="{{$api_edit_page_title}}" data-toggle="modal" href="#full-width">
                <span style="color:#336699; font-weight:bold;"><img src="{{$baseUrl}}/edit.png" width="20"></span> </a>
            </td>
            <td>
              <span class="label label-sm label-warning">
											<span style="color:#333; font-weight:bold;">{{$result->system_ccode}}</span> </span>

            </td>
            <td>
              {{$result->ccode}}
            </td>
            <td>
              {{$result->ip}}
            </td>
            <td>
              <span style="color:#336699; font-weight:bold;">{{$result->apikey}}</span>
            </td>
            <td>
              @if($result->access_service_key)
                <input name="access_service_key" type="checkbox" checked class="make-switch" data-model="api/access_service_key/{{$result->id}}" data-size="small">
              @else
                <input name="access_service_key" type="checkbox" class="make-switch" data-model="api/access_service_key/{{$result->id}}" data-size="small">
              @endif
            </td>
            <td>
              {{app()->make("Base")->dateFormat($result->created_at)}}
            </td>
            <td>
              {{$result->hash}}
            </td>
            <td>
              {{$result->standart_key}}
            </td>

            @if($admin->system_number==0)
            <td>
              {{$result->hash_number}}
            </td>
            @endif

            @if($admin->system_number==0)
            <td>
              {{$result->hash_limit}}
            </td>
            @endif

            <td>
              @if($result->access_services==NULL)
                <span style="color:#e20a16; font-weight:bold;">No Service Restricted</span>
              @else
                {{$result->access_services}}
              @endif

            </td>

            <td>
              @if($result->forbidden_access_services==NULL)
                <span style="color:#e20a16; font-weight:bold;">No Service Restricted</span>
              @else
                {{$result->forbidden_access_services}}
              @endif

            </td>
            @if($admin->system_number==0)
            <td>
              @if($result->api_coding_insert)
                <input name="api_coding_insert" data-model="api/api_coding_insert/{{$result->id}}" type="checkbox" checked class="make-switch" data-size="small">
              @else
                <input name="api_coding_insert" data-model="api/api_coding_insert/{{$result->id}}" type="checkbox" class="make-switch" data-size="small">
              @endif
            </td>
            @endif

            @if($admin->system_number==0)
            <td>
              @if($result->api_coding_update)
                <input name="api_coding_update" data-model="api/api_coding_update/{{$result->id}}" type="checkbox" checked class="make-switch" data-size="small">
              @else
                <input name="api_coding_update" data-model="api/api_coding_update/{{$result->id}}" type="checkbox" class="make-switch" data-size="small">
              @endif
            </td>
            @endif

            @if($admin->system_number==0)
            <td>
              @if($result->api_coding_delete)
                <input name="api_coding_delete" data-model="api/api_coding_delete/{{$result->id}}" type="checkbox" checked class="make-switch" data-size="small">
              @else
                <input name="api_coding_delete" data-model="api/api_coding_delete/{{$result->id}}" type="checkbox" class="make-switch" data-size="small">
              @endif
            </td>
            @endif

            @if($admin->system_number==0)
            <td>
              @if($result->api_develop_url_filter)
                <input name="api_develop_url_filter" data-model="api/api_develop_url_filter/{{$result->id}}" type="checkbox" checked class="make-switch" data-size="small">
              @else
                <input name="api_develop_url_filter" data-model="api/api_develop_url_filter/{{$result->id}}" type="checkbox" class="make-switch" data-size="small">
              @endif
            </td>
            @endif

            <td>
              {{$result->request}}
            </td>

            <td>
              {{$result->request_number}}
            </td>

            <td>
              @if($result->request_type)
                <span style="color:#e20a16; font-weight:bold;">{{$one_service}}</span>
              @else
                <span style="color:#e20a16; font-weight:bold;">{{$all_total_service}}</span>
              @endif
            </td>
          </tr>
            @endforeach

          </tbody>
        </table>
      </div>

      <div style="">
        {{$total}} : <b> {{$apiAccesses->total()}} </b> {{$result_available}}.{{$thispage}} <b>{{$apiAccesses->count()}}</b> {{$dataseen}}.
      </div>

      <div style="margin:5px 0 0 0;">
        {!! $apiAccesses->render() !!}
      </div>


    </div>
  </div>
  <!-- END SAMPLE TABLE PORTLET-->



  <div class="row">
    <div class="col-md-12">
      <div class="note note-bordered note-success">
        <p>
          {{$api_top_info}}
        </p>

      </div>
    </div>
  </div>


  <div class="col-md-6 col-sm-6" style="padding:0px;">
    <!-- BEGIN PORTLET-->
    <div class="portlet light ">
      <div class="portlet-title">
        <div class="caption">
          <i class="icon-share font-red-sunglo hide"></i>
          <span class="caption-subject font-red-sunglo bold uppercase">Revenue</span>
          <span class="caption-helper">monthly stats...</span>
        </div>
        <div class="actions">
          <div class="btn-group">
            <a href="" class="btn grey-salsa btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
              Filter Range&nbsp;<span class="fa fa-angle-down">
										</span>
            </a>
            <ul class="dropdown-menu pull-right">
              <li>
                <a href="javascript:;">
                  Q1 2014 <span class="label label-sm label-default">
												past </span>
                </a>
              </li>
              <li>
                <a href="javascript:;">
                  Q2 2014 <span class="label label-sm label-default">
												past </span>
                </a>
              </li>
              <li class="active">
                <a href="javascript:;">
                  Q3 2014 <span class="label label-sm label-success">
												current </span>
                </a>
              </li>
              <li>
                <a href="javascript:;">
                  Q4 2014 <span class="label label-sm label-warning">
												upcoming </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="portlet-body">
        <div id="site_activities_loading1api">
          <img src="{{$baseUrl}}/metron/theme/assets/admin/layout2/img/loading.gif" alt="loading"/>
        </div>
        <div id="site_activities_content1api" class="display-none">
          <div id="site_activities1api" style="height: 228px;">
          </div>
        </div>
        <div style="margin: 20px 0 10px 30px">
          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
											<span class="label label-sm label-success">
											Revenue: </span>
              <h3>$13,234</h3>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
											<span class="label label-sm label-danger">
											Shipment: </span>
              <h3>$1,134</h3>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
											<span class="label label-sm label-primary">
											Orders: </span>
              <h3>235090</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END PORTLET-->
  </div>





  <div class="col-md-6 col-sm-6" style="padding:0px;">
    <!-- BEGIN PORTLET-->
    <div class="portlet light ">
      <div class="portlet-title">
        <div class="caption">
          <i class="icon-share font-red-sunglo hide"></i>
          <span class="caption-subject font-red-sunglo bold uppercase">Revenue</span>
          <span class="caption-helper">monthly stats...</span>
        </div>
        <div class="actions">
          <div class="btn-group">
            <a href="" class="btn grey-salsa btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
              Filter Range&nbsp;<span class="fa fa-angle-down">
										</span>
            </a>
            <ul class="dropdown-menu pull-right">
              <li>
                <a href="javascript:;">
                  Q1 2014 <span class="label label-sm label-default">
												past </span>
                </a>
              </li>
              <li>
                <a href="javascript:;">
                  Q2 2014 <span class="label label-sm label-default">
												past </span>
                </a>
              </li>
              <li class="active">
                <a href="javascript:;">
                  Q3 2014 <span class="label label-sm label-success">
												current </span>
                </a>
              </li>
              <li>
                <a href="javascript:;">
                  Q4 2014 <span class="label label-sm label-warning">
												upcoming </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="portlet-body">
        <div id="site_activities_loading2api">
          <img src="{{$baseUrl}}/metron/theme/assets/admin/layout2/img/loading.gif" alt="loading"/>
        </div>
        <div id="site_activities_content2api" class="display-none">
          <div id="site_activities2api" style="height: 228px;">
          </div>
        </div>
        <div style="margin: 20px 0 10px 30px">
          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
											<span class="label label-sm label-success">
											Revenue: </span>
              <h3>$13,234</h3>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
											<span class="label label-sm label-danger">
											Shipment: </span>
              <h3>$1,134</h3>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
											<span class="label label-sm label-primary">
											Orders: </span>
              <h3>235090</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END PORTLET-->
  </div>


@endif