@if($pageRole==false)
  @include("".config("app.admin_dirname").".noauth")
@else

  <div id="newuser">

<form id="newuser" method="post" class="form-horizontal">
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
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="title">{{$new_user_ccode}}:</label>
                          <div class="col-md-5">
                            @if($admin->system_number==0)
                            <input id="notific8_text" type="text" name="ccode" class="form-control ccode" require="input-ccode"
                                   placeholder="{{$new_user_ccode}}"/>
                            @else
                              <input id="notific8_text" type="text" name="ccode" class="form-control ccode" require="input-ccode"
                              value="{{$admin->ccode}}"/>
                            @endif
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
                        <i class="fa fa-cogs"></i>{{$user_roles_capter}}
                      </div>

                    </div>
                    <div class="portlet-body">

                      @if(!$new_user_role)
                      <div style="display:none;">
                        @else
                          <div style="">
                            @endif
                      <select name="default_roles" class="form-control droles label label-warning" style="width:70%; margin:0 0 5px 0; color:#333; font-weight:bold;">
                        @foreach ($roles['default_roles'] as $defkey=>$defroles)
                          <option value="{{$roles['default_roles'][$defkey]['system_number']}}-{{$roles['default_roles'][$defkey]['roles']}}">{{$defkey}} {{$user_status}}</option>
                        @endforeach
                          @if($admin->system_number==0)
                            <option value="0">Developer {{$user_status}}</option>
                          @endif
                      </select>
                        </div>

                      @if(!$new_user_role)
                        <div style="color:#e20a16; font-weight:bold;">Kullanıcının rollerini değiştirme yetkiniz yok</div>
                      @endif

                      <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-hover">
                          <thead>
                          <tr>
                            <th scope="col">
                              Id:
                            </th>
                            <th scope="col">
                              {{$user_page_role_define}}:
                            </th>
                            <th scope="col">
                              {{$user_page_role_explain}}:
                            </th>
                            <th scope="col">
                              {{$user_page_role_layer}}:
                            </th>
                            <th scope="col">
                              {{$user_page_role_assign}}:
                            </th>

                          </tr>
                          </thead>
                          <tbody>


                          @foreach ($roles['roles'] as $role)
                          <tr>
                            <td>

                                {{$role->id}}
                            </td>
                            <td>
																		<span class="label label-sm label-success">
																		{{$role->role_define}}
                            </td>
                            <td>
                              {{$role->role_info}}
                            </td>
                            <td>
                              {{$role->role_layer}}
                            </td>

                            <td>
                              <input type="checkbox"  class="roles rolesx_{{$role->id}} role_{{$role->id}}" name="role_assign[]" value="{{$role->id}}">
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
  </form>


<script>


    var droles=$("select.droles").val();

    var droles_tire=droles.split("-");
    var droles_arr=droles_tire[1].split("@");


    $("input.roles").prop("checked",false);
    for (var i=0; i<droles_arr.length; i++)
    {
      $("input.rolesx_"+droles_arr[i]).prop("checked",true);
    }

    $("select.droles").change(function()
    {

      var droles=$(this).val();

      if(droles=="0")
      {
        $("input.roles").prop("checked",true);
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


  </div>

  @endif

