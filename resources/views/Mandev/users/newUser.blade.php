<div class="row">
  <div class="col-md-12">
    <!-- Begin: life time stats -->
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-plus font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">
									{{$create_new_user}}... </span>
          <span class="caption-helper">{{date("Y-m-d H:i:s")}}</span>
        </div>

      </div>
      <div class="portlet-body">
        <div class="tabbable">
          <ul class="nav nav-tabs nav-tabs-lg">
            <li class="active">
              <a href="#tab_1" data-toggle="tab">
                {{$user_general_infos}} </a>
            </li>
            <li>
              <a href="#tab_2" data-toggle="tab">
                {{$user_roles}}
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
                        <i class="fa fa-cogs"></i>{{$form_new_user}}
                      </div>

                    </div>
                    <div class="portlet-body">
                      <div class="note note-success">
                        <h4 class="block">{{$attention_while_new_user_create}}</h4>
                        <p>
                           {{$new_user_create_rules}}
                        </p>
                      </div>
                      <form id="newuser" method="post" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title">{{$new_user_ccode}}:</label>
                          <div class="col-md-5">
                            <input id="notific8_text" type="text" name="ccode" class="form-control ccode" require="input-ccode"
                                   placeholder="{{$new_user_ccode}}"/>
                            <span class="validation ccode">* {{$validation_warning}}</span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title">{{$new_user_login_name}}:</label>
                          <div class="col-md-5">
                            <input id="notific8_heading" type="text" name="username" class="form-control username" require="input-username"  placeholder="{{$new_user_login_name}}"/>
                            <span class="validation username">* {{$validation_warning}}</span>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title">{{$new_user_login_password}}:</label>
                          <div class="col-md-5">
                            <input id="notific8_heading" type="text" name="password" class="form-control password" require="input-password"
                                placeholder="{{$new_user_login_password}}"/>
                            <span class="validation password">* {{$validation_warning}}</span>
                          </div>
                        </div>

                        <hr>

                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title">{{$new_user_email}}:</label>
                          <div class="col-md-5">
                            <input id="notific8_heading" type="text" name="email" class="form-control email" require="input-email"
                                   placeholder="{{$new_user_email}}" style="background-color: #eee;"/>
                            <span class="validation email">* {{$validation_warning}}</span>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title">{{$new_user_fullname}}:</label>
                          <div class="col-md-5">
                            <input id="notific8_heading" type="text" name="fullname" class="form-control fullname" require="input-fullname"
                                   placeholder="{{$new_user_fullname}}" style="background-color: #eee;"/>
                            <span class="validation fullname">* {{$validation_warning}}</span>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title">{{$new_user_phone_number}}:</label>
                          <div class="col-md-5">
                            <input id="notific8_heading" type="text" name="phone_number" class="form-control"
                                   placeholder="{{$new_user_phone_number}}" style="background-color: #eee;"/>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title">{{$new_user_status}}:</label>
                          <div class="col-md-5">
                            <select id="notific8_life" name="status" class="form-control input-medium">
                              <option value="1">{{$active}}</option>
                              <option value="0">{{$passive}}</option>

                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title"></label>
                          <div class="col-md-5">
                            <a class="submit btn green-meadow btn-lg" ajax-form="newuser" action="users/newuser" id="notific8_show">
                              {{$save_changes}} </a>
                            <span id="newuserresult"></span>
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