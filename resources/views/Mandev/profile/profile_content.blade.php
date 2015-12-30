@if($pageRole==false)
    @include("".config("app.admin_dirname").".noauth")
@else


  <div class="row profile">
    <div class="col-md-12">
      <!--BEGIN TABS-->
      <div class="tabbable tabbable-custom tabbable-noborder">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#tab_1_1" data-toggle="tab">
              {{$profile_tab1}} </a>
          </li>
          <li>
            <a href="#tab_1_3" data-toggle="tab">
              {{$profile_tab2}} </a>
          </li>
          <li>
            <a href="#tab_1_4" data-toggle="tab">
              {{$profile_tab3}} </a>
          </li>
          <li>
            <a href="#tab_1_6" data-toggle="tab">
              {{$profile_tab4}}  </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1_1">
            <div class="row">
              <div class="col-md-3">
                <ul class="list-unstyled profile-nav">
                  <li>
                    <img src="{{$baseUrl}}/{{config("app.admin_profil_path")}}/{{app()->make("Base")->admin()->photo}}" class="img-responsive" alt=""/>

                  </li>
                  <li>
                    <a href="javascript:;">
                      <h1>
                      {{app()->make("Base")->admin()->system_name}} </a>
                      </h1>
                  </li>

                </ul>
              </div>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-md-8 profile-info">
                    <h1>{{app()->make("Base")->admin()->fullname}}</h1>
                    <p>
                      Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt laoreet dolore magna aliquam tincidunt erat volutpat laoreet dolore magna aliquam tincidunt erat volutpat.
                    </p>
                    <p>
                      <a href="javascript:;">
                        www.mywebsite.com </a>
                    </p>
                    <ul class="list-inline">
                      <li>
                        <i class="fa fa-map-marker"></i> Spain
                      </li>
                      <li>
                        <i class="fa fa-calendar"></i> 18 Jan 1982
                      </li>
                      <li>
                        <i class="fa fa-briefcase"></i> Design
                      </li>
                      <li>
                        <i class="fa fa-star"></i> Top Seller
                      </li>
                      <li>
                        <i class="fa fa-heart"></i> BASE Jumping
                      </li>
                    </ul>
                  </div>
                  <!--end col-md-8-->
                  <div class="col-md-4">
                    <div class="portlet sale-summary">
                      <div class="portlet-title">
                        <div class="caption">
                          Sales Summary
                        </div>
                        <div class="tools">
                          <a class="reload" href="javascript:;">
                          </a>
                        </div>
                      </div>
                      <div class="portlet-body">
                        <ul class="list-unstyled">
                          <li>
																	<span class="sale-info">
																	TODAY SOLD <i class="fa fa-img-up"></i>
																	</span>
																	<span class="sale-num">
																	23 </span>
                          </li>
                          <li>
																	<span class="sale-info">
																	WEEKLY SALES <i class="fa fa-img-down"></i>
																	</span>
																	<span class="sale-num">
																	87 </span>
                          </li>
                          <li>
																	<span class="sale-info">
																	TOTAL SOLD </span>
																	<span class="sale-num">
																	2377 </span>
                          </li>
                          <li>
																	<span class="sale-info">
																	EARNS </span>
																	<span class="sale-num">
																	$37.990 </span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <!--end col-md-4-->
                </div>
                <!--end row-->
                <div class="tabbable tabbable-custom tabbable-custom-profile">
                  <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="#tab_1_11" data-toggle="tab">
                        Latest Customers </a>
                    </li>
                    <li>
                      <a href="#tab_1_22" data-toggle="tab">
                        Feeds </a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_11">
                      <div class="portlet-body">
                        <table class="table table-striped table-bordered table-advance table-hover">
                          <thead>
                          <tr>
                            <th>
                              <i class="fa fa-briefcase"></i> Company
                            </th>
                            <th class="hidden-xs">
                              <i class="fa fa-question"></i> Descrition
                            </th>
                            <th>
                              <i class="fa fa-bookmark"></i> Amount
                            </th>
                            <th>
                            </th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td>
                              <a href="javascript:;">
                                Pixel Ltd </a>
                            </td>
                            <td class="hidden-xs">
                              Server hardware purchase
                            </td>
                            <td>
                              52560.10$ <span class="label label-success label-sm">
																	Paid </span>
                            </td>
                            <td>
                              <a class="btn default btn-xs green-stripe" href="javascript:;">
                                View </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <a href="javascript:;">
                                Smart House </a>
                            </td>
                            <td class="hidden-xs">
                              Office furniture purchase
                            </td>
                            <td>
                              5760.00$ <span class="label label-warning label-sm">
																	Pending </span>
                            </td>
                            <td>
                              <a class="btn default btn-xs blue-stripe" href="javascript:;">
                                View </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <a href="javascript:;">
                                FoodMaster Ltd </a>
                            </td>
                            <td class="hidden-xs">
                              Company Anual Dinner Catering
                            </td>
                            <td>
                              12400.00$ <span class="label label-success label-sm">
																	Paid </span>
                            </td>
                            <td>
                              <a class="btn default btn-xs blue-stripe" href="javascript:;">
                                View </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <a href="javascript:;">
                                WaterPure Ltd </a>
                            </td>
                            <td class="hidden-xs">
                              Payment for Jan 2013
                            </td>
                            <td>
                              610.50$ <span class="label label-danger label-sm">
																	Overdue </span>
                            </td>
                            <td>
                              <a class="btn default btn-xs red-stripe" href="javascript:;">
                                View </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <a href="javascript:;">
                                Pixel Ltd </a>
                            </td>
                            <td class="hidden-xs">
                              Server hardware purchase
                            </td>
                            <td>
                              52560.10$ <span class="label label-success label-sm">
																	Paid </span>
                            </td>
                            <td>
                              <a class="btn default btn-xs green-stripe" href="javascript:;">
                                View </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <a href="javascript:;">
                                Smart House </a>
                            </td>
                            <td class="hidden-xs">
                              Office furniture purchase
                            </td>
                            <td>
                              5760.00$ <span class="label label-warning label-sm">
																	Pending </span>
                            </td>
                            <td>
                              <a class="btn default btn-xs blue-stripe" href="javascript:;">
                                View </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <a href="javascript:;">
                                FoodMaster Ltd </a>
                            </td>
                            <td class="hidden-xs">
                              Company Anual Dinner Catering
                            </td>
                            <td>
                              12400.00$ <span class="label label-success label-sm">
																	Paid </span>
                            </td>
                            <td>
                              <a class="btn default btn-xs blue-stripe" href="javascript:;">
                                View </a>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!--tab-pane-->
                    <div class="tab-pane" id="tab_1_22">
                      <div class="tab-pane active" id="tab_1_1_1">
                        <div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
                          <ul class="feeds">
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-success">
                                      <i class="fa fa-bell-o"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      You have 4 pending tasks. <span class="label label-danger label-sm">
																						Take action <i class="fa fa-share"></i>
																						</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  Just now
                                </div>
                              </div>
                            </li>
                            <li>
                              <a href="javascript:;">
                                <div class="col1">
                                  <div class="cont">
                                    <div class="cont-col1">
                                      <div class="label label-success">
                                        <i class="fa fa-bell-o"></i>
                                      </div>
                                    </div>
                                    <div class="cont-col2">
                                      <div class="desc">
                                        New version v1.4 just lunched!
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col2">
                                  <div class="date">
                                    20 mins
                                  </div>
                                </div>
                              </a>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-danger">
                                      <i class="fa fa-bolt"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      Database server #12 overloaded. Please fix the issue.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  24 mins
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-info">
                                      <i class="fa fa-bullhorn"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      New order received. Please take care of it.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  30 mins
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-success">
                                      <i class="fa fa-bullhorn"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      New order received. Please take care of it.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  40 mins
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-warning">
                                      <i class="fa fa-plus"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      New user registered.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  1.5 hours
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-success">
                                      <i class="fa fa-bell-o"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      Web server hardware needs to be upgraded. <span class="label label-inverse label-sm">
																						Overdue </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  2 hours
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-default">
                                      <i class="fa fa-bullhorn"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      New order received. Please take care of it.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  3 hours
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-warning">
                                      <i class="fa fa-bullhorn"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      New order received. Please take care of it.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  5 hours
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-info">
                                      <i class="fa fa-bullhorn"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      New order received. Please take care of it.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  18 hours
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-default">
                                      <i class="fa fa-bullhorn"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      New order received. Please take care of it.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  21 hours
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-info">
                                      <i class="fa fa-bullhorn"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      New order received. Please take care of it.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  22 hours
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-default">
                                      <i class="fa fa-bullhorn"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      New order received. Please take care of it.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  21 hours
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-info">
                                      <i class="fa fa-bullhorn"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      New order received. Please take care of it.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  22 hours
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-default">
                                      <i class="fa fa-bullhorn"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      New order received. Please take care of it.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  21 hours
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-info">
                                      <i class="fa fa-bullhorn"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      New order received. Please take care of it.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  22 hours
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-default">
                                      <i class="fa fa-bullhorn"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      New order received. Please take care of it.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  21 hours
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="col1">
                                <div class="cont">
                                  <div class="cont-col1">
                                    <div class="label label-info">
                                      <i class="fa fa-bullhorn"></i>
                                    </div>
                                  </div>
                                  <div class="cont-col2">
                                    <div class="desc">
                                      New order received. Please take care of it.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col2">
                                <div class="date">
                                  22 hours
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <!--tab-pane-->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--tab_1_2-->
          <div class="tab-pane" id="tab_1_3">
            <div class="row profile-account">
              <div class="col-md-3">
                <ul class="ver-inline-menu tabbable margin-bottom-10">
                  <li class="active">
                    <a data-toggle="tab" href="#tab_1-1">
                      <i class="fa fa-cog"></i>{{$personal_info}} </a>
													<span class="after">
													</span>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#tab_2-2">
                      <i class="fa fa-picture-o"></i>{{$profil_picture}} </a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#tab_3-3">
                      <i class="fa fa-lock"></i>{{$change_password}} </a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#tab_4-4">
                      <i class="fa fa-eye"></i>{{$private_settings}} </a>
                  </li>
                </ul>
              </div>
              <div class="col-md-9">
                <div class="tab-content">
                  <div id="tab_1-1" class="tab-pane active">
                    <form id="profile_update" method="post" role="form">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <div class="form-group">
                        <label class="control-label">{{$login_name}}</label>
                        <input type="text" name="username" value="{{$admin->username}}" class="form-control username tooltips" data-placement="top" data-original-title="{{$username_info}}" require="input-username"/>
                        <span class="validation username">* {{$validation_warning}}</span>
                      </div>

                      <div class="form-group">
                        <label class="control-label">{{$username}}</label>
                        <input type="text" name="fullname" value="{{$admin->fullname}}" class="form-control fullname" require="input-fullname"/>
                        <span class="validation fullname">* {{$validation_warning}}</span>
                      </div>
                      <div class="form-group">
                        <label class="control-label">{{$company_code}} <span style="color:#e20a16; font-weight:bold;">({{$notchange}})</span></label>
                        <input type="text" name="ccode" disabled="disabled" value="{{$admin->ccode}}" class="form-control"/>
                      </div>
                      <div class="form-group">
                        <label class="control-label">{{$mobilphone}}</label>
                        <input type="text"  name="phone_number" value="{{$admin->phone_number}}" class="form-control"/>
                      </div>
                      <div class="form-group">
                        <label class="control-label">{{$address}}</label>
                        <input type="text" name="address" value="{{$admin->address}}" class="form-control"/>
                      </div>
                      <div class="form-group">
                        <label class="control-label">{{$occupation}}</label>
                        <input type="text" name="occupation" value="{{$admin->occupation}}" class="form-control"/>
                      </div>
                      <div class="form-group">
                        <label class="control-label">{{$about}}</label>
                        <textarea class="form-control" name="extra_info" rows="3">{{$admin->extra_info}}</textarea>
                      </div>
                      <div class="form-group">
                        <label class="control-label">{{$website}}</label>
                        <input type="text" name="website" value="{{$admin->website}}" class="form-control"/>
                      </div>

                      <div class="margiv-top-10">
                        <a class="submit btn green" ajax-form="profile_update" action="profile">
                          {{$save_changes}} </a>

                        <span id="profile_updateresult"></span>

                      </div>
                    </form>
                  </div>
                  <div id="tab_2-2" class="tab-pane">
                    <p>
                      {{$profil_field_top_info}}
                    </p>
                    <form id="profilephoto" method="post" role="form" enctype="multipart/form-data">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <div class="form-group">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                            <img src="{{$baseUrl}}/{{config("app.admin_profil_path")}}/{{$admin->photo}}" alt=""/>
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                          </div>
                          <div>
																	<span class="btn default btn-file">
																	<span class="fileinput-new">
																	{{$pick_picture}} </span>

																	<input type="file" name="photo" class="form-control photo" require="input-photo">
                                    <span class="validation photo">{{$validation_warning}}</span>
																	</span>

                          </div>
                        </div>
                        <div class="clearfix margin-top-10">
																<span class="label label-danger">
																{{$warning}}! </span>
																<span>
																{{$warning_profil_picture_size}} </span>
                        </div>
                      </div>
                      <div class="margin-top-10">
                        <a class="submit btn green" ajax-form="profilephoto" action="profile/photoupload">
                          {{$save_changes}} </a>

                      </div>

                      <span id="profilephotoresult"></span>
                    </form>
                  </div>
                  <div id="tab_3-3" class="tab-pane">
                    <form id="changepassword" method="post">

                      <input type="hidden" name="_token" value="{{csrf_token()}}">

                      <div class="form-group">
                        <label class="control-label">{{$new_password}}</label>
                        <input type="password" name="password" class="form-controlx new_password" require="input-new_password"/>
                        <span class="validation new_password"> * {{$validation_warning}}</span>
                      </div>
                      <div class="form-group">
                        <label class="control-label">{{$renew_password}}</label>
                        <input type="password" name="repassword" class="form-controlx renew_password" require="input-renew_password"/>
                        <span class="validation renew_password"> * {{$validation_warning}}</span>
                      </div>
                      <div class="margin-top-10">
                        <a class="submit btn green" ajax-form="changepassword" action="profile/changepassword">
                          {{$save_changes}} </a>
                        <span id="changepasswordresult"></span>

                      </div>
                    </form>
                  </div>
                  <div id="tab_4-4" class="tab-pane">
                    <form action="#">
                      <table class="table table-bordered table-striped">
                        <tr>
                          <td>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus..
                          </td>
                          <td>
                            <label class="uniform-inline">
                              <input type="radio" name="optionsRadios1" value="option1"/>
                              Yes </label>
                            <label class="uniform-inline">
                              <input type="radio" name="optionsRadios1" value="option2" checked/>
                              No </label>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                          </td>
                          <td>
                            <label class="uniform-inline">
                              <input type="checkbox" value=""/> Yes </label>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                          </td>
                          <td>
                            <label class="uniform-inline">
                              <input type="checkbox" value=""/> Yes </label>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                          </td>
                          <td>
                            <label class="uniform-inline">
                              <input type="checkbox" value=""/> Yes </label>
                          </td>
                        </tr>
                      </table>
                      <!--end profile-settings-->
                      <div class="margin-top-10">
                        <a href="javascript:;" class="btn green">
                          Save Changes </a>
                        <a href="javascript:;" class="btn default">
                          Cancel </a>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!--end col-md-9-->
            </div>
          </div>
          <!--end tab-pane-->
          <div class="tab-pane" id="tab_1_4">
            <div class="row">
              <div class="col-md-12">
                <div class="add-portfolio">
												<span>
												502 Items sold this week </span>
                  <a href="javascript:;" class="btn icn-only green">
                    Add a new Project <i class="m-icon-swapright m-icon-white"></i>
                  </a>
                </div>
              </div>
            </div>
            <!--end add-portfolio-->
            <div class="row portfolio-block">
              <div class="col-md-5">
                <div class="portfolio-text">
                  <img src="../../assets/admin/pages/media/profile/logo_metronic.jpg" alt=""/>
                  <div class="portfolio-text-info">
                    <h4>Metronic - Responsive Template</h4>
                    <p>
                      Lorem ipsum dolor sit consectetuer adipiscing elit.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-5 portfolio-stat">
                <div class="portfolio-info">
                  Today Sold <span>
												187 </span>
                </div>
                <div class="portfolio-info">
                  Total Sold <span>
												1789 </span>
                </div>
                <div class="portfolio-info">
                  Earns <span>
												$37.240 </span>
                </div>
              </div>
              <div class="col-md-2">
                <div class="portfolio-btn">
                  <a href="javascript:;" class="btn bigicn-only">
												<span>
												Manage </span>
                  </a>
                </div>
              </div>
            </div>
            <!--end row-->
            <div class="row portfolio-block">
              <div class="col-md-5 col-sm-12 portfolio-text">
                <img src="../../assets/admin/pages/media/profile/logo_azteca.jpg" alt=""/>
                <div class="portfolio-text-info">
                  <h4>Metronic - Responsive Template</h4>
                  <p>
                    Lorem ipsum dolor sit consectetuer adipiscing elit.
                  </p>
                </div>
              </div>
              <div class="col-md-5 portfolio-stat">
                <div class="portfolio-info">
                  Today Sold <span>
												24 </span>
                </div>
                <div class="portfolio-info">
                  Total Sold <span>
												660 </span>
                </div>
                <div class="portfolio-info">
                  Earns <span>
												$7.060 </span>
                </div>
              </div>
              <div class="col-md-2 col-sm-12 portfolio-btn">
                <a href="javascript:;" class="btn bigicn-only">
											<span>
											Manage </span>
                </a>
              </div>
            </div>
            <!--end row-->
            <div class="row portfolio-block">
              <div class="col-md-5 portfolio-text">
                <img src="../../assets/admin/pages/media/profile/logo_conquer.jpg" alt=""/>
                <div class="portfolio-text-info">
                  <h4>Metronic - Responsive Template</h4>
                  <p>
                    Lorem ipsum dolor sit consectetuer adipiscing elit.
                  </p>
                </div>
              </div>
              <div class="col-md-5 portfolio-stat">
                <div class="portfolio-info">
                  Today Sold <span>
												24 </span>
                </div>
                <div class="portfolio-info">
                  Total Sold <span>
												975 </span>
                </div>
                <div class="portfolio-info">
                  Earns <span>
												$21.700 </span>
                </div>
              </div>
              <div class="col-md-2 portfolio-btn">
                <a href="javascript:;" class="btn bigicn-only">
											<span>
											Manage </span>
                </a>
              </div>
            </div>
            <!--end row-->
          </div>
          <!--end tab-pane-->
          <div class="tab-pane" id="tab_1_6">
            <div class="row">
              <div class="col-md-3">
                <ul class="ver-inline-menu tabbable margin-bottom-10">
                  <li class="active">
                    <a data-toggle="tab" href="#tab_1">
                      <i class="fa fa-briefcase"></i> General Questions </a>
													<span class="after">
													</span>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#tab_2">
                      <i class="fa fa-group"></i> Membership </a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#tab_3">
                      <i class="fa fa-leaf"></i> Terms Of Service </a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#tab_1">
                      <i class="fa fa-info-circle"></i> License Terms </a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#tab_2">
                      <i class="fa fa-tint"></i> Payment Rules </a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#tab_3">
                      <i class="fa fa-plus"></i> Other Questions </a>
                  </li>
                </ul>
              </div>
              <div class="col-md-9">
                <div class="tab-content">
                  <div id="tab_1" class="tab-pane active">
                    <div id="accordion1" class="panel-group">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
                              1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                          </h4>
                        </div>
                        <div id="accordion1_1" class="panel-collapse collapse in">
                          <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_2">
                              2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                          </h4>
                        </div>
                        <div id="accordion1_2" class="panel-collapse collapse">
                          <div class="panel-body">
                            Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-success">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_3">
                              3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                          </h4>
                        </div>
                        <div id="accordion1_3" class="panel-collapse collapse">
                          <div class="panel-body">
                            Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-warning">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_4">
                              4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                          </h4>
                        </div>
                        <div id="accordion1_4" class="panel-collapse collapse">
                          <div class="panel-body">
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-danger">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_5">
                              5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                          </h4>
                        </div>
                        <div id="accordion1_5" class="panel-collapse collapse">
                          <div class="panel-body">
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_6">
                              6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                          </h4>
                        </div>
                        <div id="accordion1_6" class="panel-collapse collapse">
                          <div class="panel-body">
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_7">
                              7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                          </h4>
                        </div>
                        <div id="accordion1_7" class="panel-collapse collapse">
                          <div class="panel-body">
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="tab_2" class="tab-pane">
                    <div id="accordion2" class="panel-group">
                      <div class="panel panel-warning">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_1">
                              1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                          </h4>
                        </div>
                        <div id="accordion2_1" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <p>
                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                            <p>
                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-danger">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_2">
                              2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                          </h4>
                        </div>
                        <div id="accordion2_2" class="panel-collapse collapse">
                          <div class="panel-body">
                            Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-success">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_3">
                              3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                          </h4>
                        </div>
                        <div id="accordion2_3" class="panel-collapse collapse">
                          <div class="panel-body">
                            Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_4">
                              4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                          </h4>
                        </div>
                        <div id="accordion2_4" class="panel-collapse collapse">
                          <div class="panel-body">
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_5">
                              5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                          </h4>
                        </div>
                        <div id="accordion2_5" class="panel-collapse collapse">
                          <div class="panel-body">
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_6">
                              6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                          </h4>
                        </div>
                        <div id="accordion2_6" class="panel-collapse collapse">
                          <div class="panel-body">
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_7">
                              7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                          </h4>
                        </div>
                        <div id="accordion2_7" class="panel-collapse collapse">
                          <div class="panel-body">
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="tab_3" class="tab-pane">
                    <div id="accordion3" class="panel-group">
                      <div class="panel panel-danger">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_1">
                              1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                          </h4>
                        </div>
                        <div id="accordion3_1" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <p>
                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                            </p>
                            <p>
                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                            </p>
                            <p>
                              Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-success">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_2">
                              2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                          </h4>
                        </div>
                        <div id="accordion3_2" class="panel-collapse collapse">
                          <div class="panel-body">
                            Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_3">
                              3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                          </h4>
                        </div>
                        <div id="accordion3_3" class="panel-collapse collapse">
                          <div class="panel-body">
                            Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_4">
                              4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                          </h4>
                        </div>
                        <div id="accordion3_4" class="panel-collapse collapse">
                          <div class="panel-body">
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_5">
                              5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                          </h4>
                        </div>
                        <div id="accordion3_5" class="panel-collapse collapse">
                          <div class="panel-body">
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_6">
                              6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                          </h4>
                        </div>
                        <div id="accordion3_6" class="panel-collapse collapse">
                          <div class="panel-body">
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_7">
                              7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                          </h4>
                        </div>
                        <div id="accordion3_7" class="panel-collapse collapse">
                          <div class="panel-body">
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--end tab-pane-->
        </div>
      </div>
      <!--END TABS-->
    </div>
  </div>

@endif