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
              {{$profile_tab2}}</a>
          </li>
          <li>
            <a href="#tab_1_4" data-toggle="tab">
              {{$profile_tab3}} </a>
          </li>

        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1_1">
            <div class="row">
              <div class="col-md-3">
                <ul class="list-unstyled profile-nav">
                  <li>
                    <img src="{{$baseUrl}}/{{config("app.admin_profil_path")}}/{{$admin->photo}}" class="img-responsive" alt=""/>

                  </li>
                  <li>
                    <a href="javascript:;">
                      <h1>
                      {{$admin->system_name}} </a>
                      </h1>
                  </li>

                </ul>
              </div>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-md-7 profile-info">
                    <h1>{{$admin->fullname}}</h1>
                    <p>
                      {{$admin->extra_info}}
                    </p>

                    <p>
                      <b>{{$mail}} : </b> {{$admin->email}}
                    </p>

                    <p>
                      <b>{{$website}}</b> :
                      <a href="{{$admin->website}}" target="_blank">
                        {{$admin->website}}
                      </a>
                    </p>

                    <p>
                      <b> Ccode :</b> {{$admin->ccode}}
                    </p>

                  </div>
                  <!--end col-md-8-->
                  <div class="col-md-5">
                    <div class="portlet sale-summary">
                      <div class="portlet-title">
                        <div class="caption">
                          {{$summary}}
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
																	<b>{{$online_statu}} : </b> <i class="fa fa-img-up"></i>
																	</span>
																	<span class="label label-sm label-danger">
                                    @if(app()->make("Base")->getOnlineStatu($admin->id)->status)

                                      {{$active}}

                                   @else
                                  {{$passive}}
                                  @endif</span>
                          </li>
                          <li>
																	<span class="sale-info">
																	<b> {{$last_login}} : </b> <i class="fa fa-img-down"></i>
																	</span>
																	<span class="sale-num">
																	{{$last_login_time}} </span>
                          </li>

                          <li>
																	<span class="sale-info">
																	<b> {{$member_date}} : </b> <i class="fa fa-img-down"></i>
																	</span>
																	<span class="sale-num">
                                    {{date("Y-m-d H:i",$admin->created_at)}}
                                  </span>
                          </li>


                          <li>
																	<span class="sale-info">
																	<b> {{$user_where}} : </b> <i class="fa fa-img-down"></i>
																	</span>
																	<span class="sale-num">
                                    {{$admin->user_where}}
                                  </span>
                          </li>


                          <li>
																	<span class="sale-info">
																	<b> {{$last_ip}} : </b> <i class="fa fa-img-down"></i>
																	</span>
																	<span class="sale-num">
                                    {{$admin->last_ip}}
                                  </span>
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
                        {{$admin_last_actions}} </a>
                    </li>

                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_11">
                      <div class="portlet-body">
                        <table class="table table-striped table-bordered table-advance table-hover">
                          <thead>
                          <tr>
                            <th>
                              <i class="fa fa-briefcase"></i> {{$formprocess}}
                            </th>
                            <th class="hidden-xs">
                              <i class="fa fa-question"></i> {{$route}}
                            </th>
                            <th>
                              <i class="fa fa-bookmark"></i> {{$logprocess}}
                            </th>

                            <th>
                              <i class="fa fa-bookmark">{{$date}}</i>
                            </th>

                          </tr>
                          </thead>

                          @if(config("app.log_status")==false)
                          <tbody>
                          <tr>
                            <th colspan="4" style="background-color:#ffffdd;">
                              {{$log_false}}
                            </th>

                          </tr>
                          </tbody>
                          @endif

                          <tbody>
                          @foreach ($logs as $log)
                          <tr>
                            <td>
                              {{$log->formprocess}}
                            </td>
                            <td>
                              {{$log->url_path_explain}}
                            </td>
                            <td>
                              @if($log->log_process==1)
                                GET
                                @else
                                POST
                                @endif
                            </td>
                            <td>
                              {{date("Y-m-d H:i:s",$log->created_at)}}
                            </td>


                          </tr>
                            @endforeach

                          </tbody>
                        </table>
                      </div>
                    </div>

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

                </ul>
              </div>
              <div class="col-md-9">
                <div class="tab-content">
                  <div id="tab_1-1" class="tab-pane active">
                    <form id="profile_update" method="post" role="form">
                      <input type="hidden" name="_token" value="{{$token}}">
                      {{Session::put("_token",$token)}}
                      @if($hidden_input)
                        <input type="hidden" name="hidden_input" value="{{$admin->id}}">
                      @endif
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
                        <label class="control-label">{{$mail}}</label>
                        <input type="text" name="email" value="{{$admin->email}}" class="form-control email" require="input-email"/>
                        <span class="validation email">* {{$validation_warning}}</span>
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
                      @if($hidden_input)
                        <input type="hidden" name="hidden_input" value="{{$admin->id}}">
                      @endif
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
                      @if($hidden_input)
                        <input type="hidden" name="hidden_input" value="{{$admin->id}}">
                      @endif


                      <div class="form-group">
                        <label class="control-label">{{$new_password}}</label>
                        <input type="password" name="password" class="form-control new_password" require="input-new_password"/>
                        <span class="validation new_password"> * {{$validation_warning}}</span>
                      </div>
                      <div class="form-group">
                        <label class="control-label">{{$renew_password}}</label>
                        <input type="password" name="repassword" class="form-control renew_password" require="input-renew_password"/>
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


            <form id="profileroleupdate" method="post">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              @if($hidden_input)
                <input type="hidden" name="hidden_input" value="{{$admin->id}}">
              @endif
            <div class="row">
              <div class="col-md-12">
                <div class="add-portfolio">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="note note-bordered note-success">
                        <p>
                          {{$profile_roles_auth_info}}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box purple">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-cogs"></i>{{$admin->fullname}} {{$profile_auth_list}}
                </div>

              </div>
              <div class="portlet-body">

                @if(($hidden_input) OR ($admin->system_number==1))

                <select name="default_roles" class="form-control droles label label-warning" style="width:70%; margin:0 0 5px 0; color:#333; font-weight:bold;">
                  @foreach ($roles['default_roles'] as $defkey=>$defroles)
                    @if($admin->system_number==$roles['default_roles'][$defkey]['system_number'])
                    <option value="{{$roles['default_roles'][$defkey]['system_number']}}-{{$roles['default_roles'][$defkey]['roles']}}">{{$defkey}} {{$user_status}}</option>
                    @endif
                  @endforeach

                    @foreach ($roles['default_roles'] as $defkey=>$defroles)
                      @if($admin->system_number!=$roles['default_roles'][$defkey]['system_number'])
                        <option value="{{$roles['default_roles'][$defkey]['system_number']}}-{{$roles['default_roles'][$defkey]['roles']}}">{{$defkey}} {{$user_status}}</option>
                      @endif
                    @endforeach
                </select>

                @endif

                <div class="table-scrollable">

                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                      <th scope="col">
                       {{$statu}}:
                      </th>
                      <th scope="col">
                        {{$page_role_define}}:
                      </th>
                      <th scope="col">
                        {{$role_explain}}:
                      </th>
                      <th scope="col">
                        {{$role_layer}}:
                      </th>

                    </tr>
                    </thead>
                    <tbody>


                    @if($admin->system_number==0)
                      <tr>
                        <td colspan="4" style="background-color: #ffef8f; font-weight:bold;">{{$develop_no_role}}</td>
                      </tr>
                    @else
                    @foreach ($roles['roles'] as $role)
                    <tr>
                      <td>
                        <input type="checkbox" {{$roles['checkbox'][$role->id]}} class="roles rolesx_{{$role->id}} role_{{$role->id}} form-control" name="role_assign[]" value="{{$role->id}}">
                      </td>
                      <td>
                        {{$role->role_define}}
                      </td>
                      <td>
                        {{$role->role_info}}
                      </td>
                      <td>
                        {{$role->role_layer}}
                      </td>

                    </tr>
                      @endforeach
                      @endif

                    </tbody>
                  </table>




                </div>


                @if(($hidden_input) OR ($admin->system_number==1))

                <div style="margin:10px 0 0 0;">
                  <a class="submit btn green" ajax-form="profileroleupdate" action="profile/roleupdate">
                    {{$save_changes}} </a>
                  <span id="profileroleupdateresult"></span>

                </div>

                  @endif

              </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->

              </form>

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


  <script>


    $("select.droles").change(function()
    {

      $(".checker").addClass("atr");
      $(".checker").removeClass("checker");

      var droles=$(this).val();

      if(droles=="0")
      {
        $(".roles").attr("checked",true);
      }
      else
      {
        var droles_tire=droles.split("-");
        var droles_arr=droles_tire[1].split("@");

        $("input.roles").prop("checked",false);
        for (var i=0; i<droles_arr.length; i++)
        {
          $("input.rolesx_"+droles_arr[i]).prop("checked",true);
        }
      }


    });




  </script>

@endif