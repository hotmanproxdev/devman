<div class="row">
  <div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet box yellow-crusta">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-gift"></i>Twitter Auto Complete(typeahead.js)
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse">
          </a>
          <a href="#portlet-config" data-toggle="modal" class="config">
          </a>
          <a href="javascript:;" class="reload">
          </a>
          <a href="javascript:;" class="remove">
          </a>
        </div>
      </div>
      <div class="portlet-body form">
        <form action="#" id="form-username" class="form-horizontal form-bordered">
          <div class="form-group">
            <label class="col-sm-3 control-label">Basic Auto Complete</label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-user"></i>
												</span>
                <input type="text" id="typeahead_example_1" name="typeahead_example_1" class="form-control"/>
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
            <label class="col-sm-3 control-label">Country Auto Complete</label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-search"></i>
												</span>
                <input type="text" id="typeahead_example_2" name="typeahead_example_2" class="form-control"/>
              </div>
              <p class="help-block">
                E.g: USA, Malaysia. Prefetch from JSON source</code>
              </p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Custom Template</label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-cogs"></i>
												</span>
                <input type="text" id="typeahead_example_3" name="typeahead_example_3" class="form-control"/>
              </div>
              <p class="help-block">
                Uses a precompiled template to customize look of suggestion.</code>
              </p>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-3 control-label">Multiple Sections with Headers</label>
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-check"></i>
												</span>
                <input type="text" id="typeahead_example_4" name="typeahead_example_4" class="form-control"/>
              </div>
              <p class="help-block">
                Two datasets that are prefetched, stored, and searched on the client. Highlighting is enabled.
              </p>
            </div>
          </div>
          <div class="form-group last">
            <label class="control-label col-md-3">Modal</label>
            <div class="col-md-4">
              <a href="#myModal_autocomplete" role="button" class="btn red" data-toggle="modal">
                View in Modal </a>
            </div>
          </div>
          <div class="form-actions">
            <div class="row">
              <div class="col-md-offset-3 col-md-9">
                <button type="submit" class="btn purple"><i class="fa fa-check"></i> Submit</button>
                <button type="button" class="btn default">Cancel</button>
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