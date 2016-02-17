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

  <!-- BEGIN SAMPLE TABLE PORTLET-->
  <div class="portlet box purple">
    <div class="portlet-title">
      <div class="caption">
        <i class="fa fa-cogs"></i>{{$api_table_info}}
      </div>

    </div>

    <div class="portlet-body">

      <!--filter-->
      <div style="">

        <div class="divlay" style="width:20%;">
          <select class="indent form-control">
            <option value="-1">Sistem Koduna Göre</option>
            @foreach ($system_codes as $scodes)
              <option>{{$scodes->system_ccode}}</option>
            @endforeach
          </select>
        </div>

        <div class="divlay" style="width:20%;">
          <select class="indent form-control">
            <option value="-1">Api Grubuna Göre</option>
            <option value="develop">Developer</option>
            <option value="guest">Guest</option>
          </select>
        </div>

        <div class="divlay" style="width:20%;">
          <input type="text" class="indent form-control" placeholder="Apikey Belirtin...">
        </div>

        <div class="divlay" style="width:20%;">
          <select class="indent form-control">
            <option value="-1">Api Durumu</option>
            <option value="1">Aktif</option>
            <option value="0">Pasif</option>
          </select>
        </div>

        <div class="divlay" style="width:20%;">
          <input type="submit" name="apifilter" class="form-control btn1" value="Api Filtrele">
        </div>

        <div class="clear"></div>

      </div>
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
            <th scope="col">
              {{$daily_hash_number}}:
            </th>
            <th scope="col">
              {{$daily_hash_limit}}:
            </th>

            <th scope="col">
              {{$access_services}}:
            </th>

            <th scope="col">
              {{$forbidden_access_services}}:
            </th>

            <th scope="col">
              Insert Mode:
            </th>

            <th scope="col">
              Update Mode:
            </th>

            <th scope="col">
              Delete Mode:
            </th>

            <th scope="col">
              Url Filter Mode:
            </th>
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
              <a class="btn default xmodal" model="api/edit?id={{$result->id}}" modal-title="{{$api_edit_page_title}}" data-toggle="modal" href="#full-width">
                <span style="color:#336699; font-weight:bold;">{{$edit}}</span> </a>
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
                <input type="checkbox" checked class="make-switch" data-size="small">
              @else
                <input type="checkbox" class="make-switch" data-size="small">
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
            <td>
              {{$result->hash_number}}
            </td>
            <td>
              {{$result->hash_limit}}
            </td>
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
            <td>
              @if($result->api_coding_insert)
                <input type="checkbox" checked class="make-switch" data-size="small">
              @else
                <input type="checkbox" class="make-switch" data-size="small">
              @endif
            </td>
            <td>
              @if($result->api_coding_update)
                <input type="checkbox" checked class="make-switch" data-size="small">
              @else
                <input type="checkbox" class="make-switch" data-size="small">
              @endif
            </td>
            <td>
              @if($result->api_coding_delete)
                <input type="checkbox" checked class="make-switch" data-size="small">
              @else
                <input type="checkbox" class="make-switch" data-size="small">
              @endif
            </td>
            <td>
              @if($result->api_develop_url_filter)
                <input type="checkbox" checked class="make-switch" data-size="small">
              @else
                <input type="checkbox" class="make-switch" data-size="small">
              @endif
            </td>

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
    </div>
  </div>
  <!-- END SAMPLE TABLE PORTLET-->
@endif