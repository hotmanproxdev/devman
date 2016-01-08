<div class="row">
  <div class="col-md-12">
    <!-- Begin: life time stats -->
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <i class="icon-basket font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">
									Order #12313232 </span>
          <span class="caption-helper">Dec 27, 2013 7:16:25</span>
        </div>
        <div class="actions">
          <a href="javascript:;" class="btn btn-default btn-circle">
            <i class="fa fa-angle-left"></i>
									<span class="hidden-480">
									Back </span>
          </a>
          <div class="btn-group">
            <a class="btn btn-default btn-circle" href="javascript:;" data-toggle="dropdown">
              <i class="fa fa-cog"></i>
										<span class="hidden-480">
										Tools </span>
              <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-right">
              <li>
                <a href="javascript:;">
                  Export to Excel </a>
              </li>
              <li>
                <a href="javascript:;">
                  Export to CSV </a>
              </li>
              <li>
                <a href="javascript:;">
                  Export to XML </a>
              </li>
              <li class="divider">
              </li>
              <li>
                <a href="javascript:;">
                  Print Invoice </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="portlet-body">
        <div class="tabbable">
          <ul class="nav nav-tabs nav-tabs-lg">
            <li class="active">
              <a href="#tab_1" data-toggle="tab">
                Details </a>
            </li>
            <li>
              <a href="#tab_2" data-toggle="tab">
                Invoices <span class="badge badge-success">
											4 </span>
              </a>
            </li>
            <li>
              <a href="#tab_3" data-toggle="tab">
                Credit Memos </a>
            </li>
            <li>
              <a href="#tab_4" data-toggle="tab">
                Shipments <span class="badge badge-danger">
											2 </span>
              </a>
            </li>
            <li>
              <a href="#tab_5" data-toggle="tab">
                History </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">


              <div class="row">
                <div class="col-md-12">
                  <div class="portlet yellow box">
                    <div class="portlet-title">
                      <div class="caption">
                        <i class="fa fa-cogs"></i>Notific8 Notification Demo
                      </div>

                    </div>
                    <div class="portlet-body">
                      <div class="note note-success">
                        <h4 class="block">jquery.notific8</h4>
                        <p>
                          jquery.notific8 is a notification plug-in that was inspired by the notification style introduced in Windows 8. For more info Check out <a href="https://github.com/willsteinmetz/jquery-notific8" target="_blank">
                            the official github respository </a>
                        </p>
                      </div>
                      <form id="modalcontent" method="post" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title">Notification text:</label>
                          <div class="col-md-5">
                            <input id="notific8_text" type="text" name="notification_text" class="form-control" value="Inspired by Windows 8 notifications" placeholder="enter a text ..."/>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title">Heading(optional):</label>
                          <div class="col-md-5">
                            <input id="notific8_heading" type="text" class="form-control" value="" placeholder="enter a heading ..."/>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title">Sticky ?</label>
                          <div class="col-md-5">
                            <label class="checkbox">
                              <input type="checkbox" id="notific8_sticky" value="1">
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title">Life:</label>
                          <div class="col-md-5">
                            <select id="notific8_life" class="form-control input-medium">
                              <option value="1000">1 second</option>
                              <option value="5000">5 seconds</option>
                              <option value="10000" selected="selected">10 seconds (default)</option>
                              <option value="25000">25 seconds</option>
                              <option value="60000">60 seconds</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title">Style:</label>
                          <div class="col-md-5">
                            <select id="notific8_theme" class="form-control input-medium">
                              <option value="teal" selected="selected">teal (default)</option>
                              <option value="amethyst">amethyst</option>
                              <option value="ruby">ruby</option>
                              <option value="tangerine">tangerine</option>
                              <option value="lemon">lemon</option>
                              <option value="lime">lime</option>
                              <option value="ebony">ebony</option>
                              <option value="smoke">smoke</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title">Position:</label>
                          <div class="col-md-5">
                            <select id="notific8_pos_hor" class="form-control input-small input-inline">
                              <option value="top">top (default)</option>
                              <option value="bottom">bottom</option>
                            </select>
                            <select id="notific8_pos_ver" class="form-control input-small input-inline">
                              <option value="right">right (default)</option>
                              <option value="left">left</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title"></label>
                          <div class="col-md-5">
                            <a class="submit btn green-meadow btn-lg" ajax-form="modalcontent" action="test/modelim" id="notific8_show">
                              Show Notification! </a>
                            <span id="modalcontentresult"></span>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>




            </div>
            <div class="tab-pane" id="tab_2">

              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="portlet grey-cascade box">
                    <div class="portlet-title">
                      <div class="caption">
                        <i class="fa fa-cogs"></i>Shopping Cart
                      </div>
                      <div class="actions">
                        <a href="javascript:;" class="btn btn-default btn-sm">
                          <i class="fa fa-pencil"></i> Edit </a>
                      </div>
                    </div>
                    <div class="portlet-body">
                      <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>
                              Product
                            </th>
                            <th>
                              Item Status
                            </th>
                            <th>
                              Original Price
                            </th>
                            <th>
                              Price
                            </th>
                            <th>
                              Quantity
                            </th>
                            <th>
                              Tax Amount
                            </th>
                            <th>
                              Tax Percent
                            </th>
                            <th>
                              Discount Amount
                            </th>
                            <th>
                              Total
                            </th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td>
                              <a href="javascript:;">
                                Product 1 </a>
                            </td>
                            <td>
																		<span class="label label-sm label-success">
																		Available
                            </td>
                            <td>
                              345.50$
                            </td>
                            <td>
                              345.50$
                            </td>
                            <td>
                              2
                            </td>
                            <td>
                              2.00$
                            </td>
                            <td>
                              4%
                            </td>
                            <td>
                              0.00$
                            </td>
                            <td>
                              691.00$
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <a href="javascript:;">
                                Product 1 </a>
                            </td>
                            <td>
																		<span class="label label-sm label-success">
																		Available
                            </td>
                            <td>
                              345.50$
                            </td>
                            <td>
                              345.50$
                            </td>
                            <td>
                              2
                            </td>
                            <td>
                              2.00$
                            </td>
                            <td>
                              4%
                            </td>
                            <td>
                              0.00$
                            </td>
                            <td>
                              691.00$
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <a href="javascript:;">
                                Product 1 </a>
                            </td>
                            <td>
																		<span class="label label-sm label-success">
																		Available
                            </td>
                            <td>
                              345.50$
                            </td>
                            <td>
                              345.50$
                            </td>
                            <td>
                              2
                            </td>
                            <td>
                              2.00$
                            </td>
                            <td>
                              4%
                            </td>
                            <td>
                              0.00$
                            </td>
                            <td>
                              691.00$
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <a href="javascript:;">
                                Product 1 </a>
                            </td>
                            <td>
																		<span class="label label-sm label-success">
																		Available
                            </td>
                            <td>
                              345.50$
                            </td>
                            <td>
                              345.50$
                            </td>
                            <td>
                              2
                            </td>
                            <td>
                              2.00$
                            </td>
                            <td>
                              4%
                            </td>
                            <td>
                              0.00$
                            </td>
                            <td>
                              691.00$
                            </td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="tab-pane" id="tab_3">

            </div>
            <div class="tab-pane" id="tab_4">

            </div>
            <div class="tab-pane" id="tab_5">

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End: life time stats -->
  </div>
</div>