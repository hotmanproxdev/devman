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
                <select class="form-control select2" data-placeholder="Bütün servisler..." multiple="multiple" name="access_services"><option value=""></option><option value="AL">Alabama</option><option value="WY">Wyoming</option>\n
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
                <button type="submit" class="btn purple"><i class="fa fa-check"></i> Submit</button>
              </div>
            </div>
          </div>
        </form>
        <div id="myModal_autocomplete" class="modal fade" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Radio Switch in Modal</h4>
              </div>
              <div class="modal-body form">
                <form action="#" class="form-horizontal form-row-seperated">
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Basic Auto Complete</label>
                    <div class="col-sm-8">
                      <div class="input-group">
																<span class="input-group-addon">
																<i class="fa fa-user"></i>
																</span>
                        <input type="text" id="typeahead_example_modal_1" name="typeahead_example_modal_1" class="form-control"/>
                      </div>
                      <p class="help-block">
                        E.g: metronic, keenthemes.<br>
																<span class="label label-success label-sm">
																Learn more: </span>
                        <a target="_blank" href="http://twitter.github.io/typeahead.js/">
                          http://twitter.github.io/typeahead.js/ </a>
                      </p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Country Auto Complete</label>
                    <div class="col-sm-8">
                      <div class="input-group">
																<span class="input-group-addon">
																<i class="fa fa-search"></i>
																</span>
                        <input type="text" id="typeahead_example_modal_2" name="typeahead_example_modal_2" class="form-control"/>
                      </div>
                      <p class="help-block">
                        E.g: USA, Malaysia. Prefetch from JSON source</code>
                      </p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Custom Template</label>
                    <div class="col-sm-8">
                      <div class="input-group">
																<span class="input-group-addon">
																<i class="fa fa-cogs"></i>
																</span>
                        <input type="text" id="typeahead_example_modal_3" name="typeahead_example_modal_3" class="form-control"/>
                      </div>
                      <p class="help-block">
                        Uses a precompiled template to customize look of suggestion.</code>
                      </p>
                    </div>
                  </div>
                  <div class="form-group last">
                    <label class="col-sm-4 control-label">Multiple Sections with Headers</label>
                    <div class="col-sm-8">
                      <div class="input-group">
																<span class="input-group-addon">
																<i class="fa fa-check"></i>
																</span>
                        <input type="text" id="typeahead_example_modal_4" name="typeahead_example_modal_4" class="form-control"/>
                      </div>
                      <p class="help-block">
                        Two datasets that are prefetched, stored, and searched on the client. Highlighting is enabled.
                      </p>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"><i class="fa fa-check"></i> Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END PORTLET-->
  </div>