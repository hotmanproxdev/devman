<div id="apiedit" style="height:800px;">
<div class="row">
  <div class="col-md-12">
    <div class="note note-bordered note-success">
      <p>
       {{$api_edit_page_info}}
      </p>

    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet box yellow-crusta">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-gift"></i>{{$api_user_info}}
        </div>
      </div>
      <div class="portlet-body form">
        <form id="apiedit" method="post" class="form-horizontal form-bordered">
          <input type="hidden" name="id" value="{{$getUserApi[0]->id}}">
          <input type="hidden" name="_token" value="{{csrf_token()}}">

          <div class="form-group">
            <label class="col-sm-3 control-label">Api Statu:</label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-lock"></i>
												</span>
                <select name="access_service_key" class="form-control">
                  @if($getUserApi['0']->access_service_key)
                    <option value="1">{{$active}}</option>
                    <option value="0">{{$passive}}</option>
                  @else
                    <option value="0">{{$passive}}</option>
                    <option value="1">{{$active}}</option>
                  @endif
                </select>
              </div>
              <p class="help-block">
                {{$api_mode_info}}.<br>
												<span class="label label-success label-sm">
												{{$warning}}: </span> &nbsp;
                {{$api_mode_warning}}
              </p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Api Mode:</label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-qrcode"></i>
												</span>
                <select name="ccode" class="form-control" style="background-color: #ffffdd;;">
                  @if($admin->system_number==0)
                    @if($getUserApi['0']->ccode=="develop")
                      <option value="develop">Develop Mode</option>
                      <option value="guest">Guest Mode</option>
                    @else
                      <option value="guest">Guest Mode</option>
                      <option value="develop">Develop Mode</option>
                    @endif
                  @else
                    <option value="guest">Guest Mode</option>
                  @endif
                </select>
              </div>
              <p class="help-block">
                {{$api_mode_info}}.<br>
												<span class="label label-success label-sm">
												{{$warning}}: </span> &nbsp;
                {{$api_mode_warning}}
              </p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Static Ip:</label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-qrcode"></i>
												</span>
                <input type="text" id="typeahead_example_1" name="ip" class="form-control" value="{{$getUserApi['0']->ip}}"/>
              </div>
              <p class="help-block">
                {{$api_static_ip_info}}.<br>
												<span class="label label-success label-sm">
												{{$warning}}: </span> &nbsp;
               {{$api_static_ip_warning}}
              </p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Api Key:</label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-user"></i>
												</span>
                <input type="text" id="typeahead_example_2" name="apikey" class="form-control apikey"  require="input-apikey" value="{{$getUserApi['0']->apikey}}"/>
                <span class="validation apikey">{{$validation_warning}}</span>
              </div>
              <p class="help-block">
               {{$api_api_key_info}}.
              </p>
            </div>
          </div>
          @if($admin->system_number==0)
          <div class="form-group">
            <label class="col-sm-3 control-label">{{$daily_hash_number}}
              <div style="">
                <span style="color:#e20a16;">({{$except_for_quest_mode}})</span>
              </div></label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-cogs"></i>
												</span>
                <input type="text" id="typeahead_example_3" name="hash_number" class="form-control hash_number" require="input-hash_number" value="{{$getUserApi['0']->hash_number}}"/>
                <span class="validation hash_number">{{$validation_warning}}</span>
              </div>
              <p class="help-block">
                {{$api_hash_number_info}}.
              </p>
            </div>
          </div>
          @endif

          @if($admin->system_number==0)
          <div class="form-group">
            <label class="col-sm-3 control-label">{{$daily_hash_limit}}
              <div style="">
                <span style="color:#e20a16;">({{$except_for_quest_mode}})</span>
              </div></label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-cogs"></i>
												</span>
                <input type="text" id="typeahead_example_3" name="hash_limit" class="form-control hash_limit" require="input-hash_limit" value="{{$getUserApi['0']->hash_limit}}"/>
                <span class="validation hash_limit">{{$validation_warning}}</span>
              </div>
              <p class="help-block">
                {{$api_hash_limit_info}}.
              </p>
            </div>
          </div>
          @endif


          <div class="form-group">
            <label class="col-sm-3 control-label">{{$daily_request_limit}}</label>
            <div class="col-sm-4">

              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-cogs"></i>
												</span>
                <select  name="request_type" class="form-control" style="background-color: #ffffdd;">
                  @if($getUserApi[0]->request_type)
                    <option value="1">{{$one_service}}</option>
                    <option value="0">{{$all_total_service}}</option>
                  @else
                    <option value="0">{{$all_total_service}}</option>
                    <option value="1">{{$one_service}}</option>
                  @endif
                </select>
              </div>
              <p class="help-block">
                {{$api_request_type_limit_info}}.
              </p>

              <br>

              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-cogs"></i>
												</span>
                <input type="text" id="typeahead_example_3" name="request" class="form-control request" require="input-request" value="{{$getUserApi['0']->request}}" style="background-color: #ffffdd;"/>
                <span class="validation request">{{$validation_warning}}</span>
              </div>
              <p class="help-block">
                {{$api_request_limit_info}}.
              </p>
            </div>
          </div>

          <div class="form-group ">
            <label class="col-sm-3 control-label">{{$access_services}}</label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-check"></i>
												</span>
                @if($access_services=($getUserApi[0]->access_services==NULL) ? [] : explode("-",$getUserApi[0]->access_services))
                @endif
                @if(count($access_services))
                  <select name="access_services[]" id="access_services" class="form-control select2" multiple="multiple">
                @else
                  <select name="access_services[]" id="access_services" class="form-control select2" data-placeholder="{{$access_all_services_info}}" multiple="multiple">
                @endif

                  @foreach(app()->make("Base")->services(true) as $key=>$value)
                    @if($value!=="test")
                    @if(count($access_services))
                      @if(in_array($value,$access_services))
                        <option value="{{$value}}" selected>{{$value}}</option>
                      @else
                        <option value="{{$value}}">{{$value}}</option>
                      @endif
                    @else
                      @if(($admin->system_number>0) AND (!array_key_exists($value,app()->make("Base")->dbTable(['all']))))
                        <option value="{{$value}}">{{$value}}</option>
                        @endif

                      @if($admin->system_number==0)
                          <option value="{{$value}}">{{$value}}</option>
                        @endif

                    @endif
                      @endif
                  @endforeach
                </select>

              </div>
              <p class="help-block">
               {{$access_services_info}}.
              </p>
            </div>
          </div>



          <div class="form-group ">
            <label class="col-sm-3 control-label">{{$forbidden_access_services}}</label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-check"></i>
												</span>
                @if($forbidden_access_services=($getUserApi[0]->forbidden_access_services==NULL) ? [] : explode("-",$getUserApi[0]->forbidden_access_services))
                @endif

                @if(count($forbidden_access_services))
                  <select name="forbidden_access_services[]" id="forbidden_access_services" class="form-control select2" multiple="multiple">
                    @else
                      <select name="forbidden_access_services[]" id="forbidden_access_services" class="form-control select2" data-placeholder="{{$access_all_services_info}}" multiple="multiple">
                        @endif

                        @foreach(app()->make("Base")->services(true) as $key=>$value)
                          @if($value!=="test")
                          @if(count($forbidden_access_services))
                            @if(in_array($value,$forbidden_access_services))
                              <option value="{{$value}}" selected>{{$value}}</option>
                            @else
                              <option value="{{$value}}">{{$value}}</option>
                            @endif
                          @else
                            <option value="{{$value}}">{{$value}}</option>
                          @endif
                          @endif
                        @endforeach
                      </select>

              </div>
              <p class="help-block">
                {{$forbidden_access_services_info}}.
              </p>
            </div>
          </div>

          @if($admin->system_number==0)
          <div class="form-group ">
            <label class="col-sm-3 control-label">Insert Mode:
              <div style="">
                <span style="color:#e20a16;">({{$except_for_quest_mode}})</span>
              </div>
              </label>
            <div class="col-sm-4">
              <div class="input-group">
                <select class="form-control" name="api_coding_insert">
                  @if($getUserApi[0]->api_coding_insert)
                    <option value="1">Insert Mode On</option>
                    <option value="0">Insert Mode Off</option>
                  @else
                    <option value="0">Insert Mode Off</option>
                    <option value="1">Insert Mode On</option>
                  @endif
                </select>

              </div>
              <p class="help-block">
                {{$insert_mode_info}}.
              </p>
            </div>
          </div>
          @endif

          @if($admin->system_number==0)
          <div class="form-group ">
            <label class="col-sm-3 control-label">Update Mode:
              <div style="">
                <span style="color:#e20a16;">({{$except_for_quest_mode}})</span>
              </div>
            </label>
            <div class="col-sm-4">
              <div class="input-group">
                <select class="form-control" name="api_coding_update">
                  @if($getUserApi[0]->api_coding_update)
                    <option value="1">Update Mode On</option>
                    <option value="0">Update Mode Off</option>
                  @else
                    <option value="0">Update Mode Off</option>
                    <option value="1">Update Mode On</option>
                  @endif
                </select>

              </div>
              <p class="help-block">
                {{$update_mode_info}}.
              </p>
            </div>
          </div>
          @endif

          @if($admin->system_number==0)
          <div class="form-group ">
            <label class="col-sm-3 control-label">Delete Mode:
              <div style="">
                <span style="color:#e20a16;">({{$except_for_quest_mode}})</span>
              </div>
            </label>
            <div class="col-sm-4">
              <div class="input-group">
                <select class="form-control" name="api_coding_delete">
                  @if($getUserApi[0]->api_coding_delete)
                    <option value="1">Delete Mode On</option>
                    <option value="0">Delete Mode Off</option>
                  @else
                    <option value="0">Delete Mode Off</option>
                    <option value="1">Delete Mode On</option>
                  @endif
                </select>

              </div>
              <p class="help-block">
                {{$delete_mode_info}}.
              </p>
            </div>
          </div>
          @endif


          @if($admin->system_number==0)
          <div class="form-group ">
            <label class="col-sm-3 control-label">Url Filter:
              <div style="">
                <span style="color:#e20a16;">({{$except_for_quest_mode}})</span>
              </div>
            </label>
            <div class="col-sm-4">
              <div class="input-group">
                <select class="form-control" name="api_develop_url_filter">
                  @if($getUserApi[0]->api_develop_url_filter)
                    <option value="1">Url Filter On</option>
                    <option value="0">Url Filter Off</option>
                  @else
                    <option value="0">Url Filter Off</option>
                    <option value="1">Url Filter On</option>
                  @endif
                </select>

              </div>
              <p class="help-block">
                {{$filter_mode_info}}.
              </p>
            </div>
          </div>
          @endif

          <div class="form-actions">
            <div class="row">
              <div class="col-md-offset-3 col-md-9">
                <a class="submit btn purple" ajax-form="apiedit" action="api/edit"><i class="fa fa-check"></i> {{$save_changes}}</a>
                <span id="apieditresult"></span>
              </div>
            </div>
          </div>
          <br><br><br><br>
        </form>

      </div>
    </div>
    <!-- END PORTLET-->
  </div>
  </div>

  </div>