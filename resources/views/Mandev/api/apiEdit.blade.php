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
          <input type="hidden" name="_token" value="{{$token}}">
          {{Session::put("_token",$token)}}
          <div class="form-group">
            <label class="col-sm-3 control-label">Static Ip:</label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-qrcode"></i>
												</span>
                <input type="text" id="typeahead_example_1" name="static_ip" class="form-control" value=""/>
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
                <input type="text" id="typeahead_example_2" name="apikey" class="form-control" value=""/>
              </div>
              <p class="help-block">
               {{$api_api_key_info}}.</code>
              </p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">{{$daily_hash_number}}</label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-cogs"></i>
												</span>
                <input type="text" id="typeahead_example_3" name="hash_number" class="form-control"/>
              </div>
              <p class="help-block">
                {{$api_hash_number_info}}.</code>
              </p>
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-3 control-label">{{$daily_hash_limit}}</label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-cogs"></i>
												</span>
                <input type="text" id="typeahead_example_3" name="hash_limit" class="form-control"/>
              </div>
              <p class="help-block">
                {{$api_hash_limit_info}}.</code>
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
                <select name="access_services[]" id="access_services" class="form-control select2" data-placeholder="Select..." multiple="multiple">
                  <option value=""></option><option value="AL">Alabama</option><option value="WY">Wyoming</option>
                </select>

              </div>
              <p class="help-block">
               {{$access_services_info}}.
              </p>
            </div>
          </div>


          <div class="form-group ">
            <label class="col-sm-3 control-label">Insert Mode:</label>
            <div class="col-sm-4">
              <div class="input-group">
                <select class="form-control" name="api_coding_insert">
                  <option value="1">Insert Mode On</option>
                  <option value="0">Insert Mode Off</option>
                </select>

              </div>
              <p class="help-block">
                {{$insert_mode_info}}.
              </p>
            </div>
          </div>

          <div class="form-group ">
            <label class="col-sm-3 control-label">Update Mode:</label>
            <div class="col-sm-4">
              <div class="input-group">
                <select class="form-control" name="api_coding_update">
                  <option value="1">Update Mode On</option>
                  <option value="0">Update Mode Off</option>
                </select>

              </div>
              <p class="help-block">
                {{$update_mode_info}}.
              </p>
            </div>
          </div>


          <div class="form-group ">
            <label class="col-sm-3 control-label">Delete Mode:</label>
            <div class="col-sm-4">
              <div class="input-group">
                <select class="form-control" name="api_coding_delete">
                  <option value="1">Delete Mode On</option>
                  <option value="0">Delete Mode Off</option>
                </select>

              </div>
              <p class="help-block">
                {{$delete_mode_info}}.
              </p>
            </div>
          </div>

          <div class="form-actions">
            <div class="row">
              <div class="col-md-offset-3 col-md-9">
                <a class="submit btn purple" ajax-form="apiedit" action="api/edit"><i class="fa fa-check"></i> {{$save_changes}}</a>
                <span id="apieditresult"></span>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
    <!-- END PORTLET-->
  </div>
  </div>