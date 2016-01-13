@if($pageRole==false)
    @include("".config("app.admin_dirname").".noauth")
@else


  <div style="margin:0 0 5px 0;">
    <a class="btn red xmodal" model="users/newuser" modal-title="Yeni Kullanıcı Oluşturma Formu" data-target="#full-width" href="#full-width" data-toggle="modal">
      <i class="fa fa-plus"></i> Yeni Kullanıcı Oluştur </a>
    </div>


    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet box purple">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>{{$defined_all_users}}
        </div>

      </div>
      <div class="portlet-body">
        <div class="table-scrollable getUsers">
          <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
              <th scope="col">
                İd:
              </th>
              <th scope="col">
                {{$online_statu}}:
              </th>
              <th scope="col">
                {{$system_auth}}:
              </th>
              <th scope="col">
                {{$profil}}:
              </th>
              <th scope="col">
                Ccode:
              </th>
              <th scope="col">
                {{$username}}:
              </th>
              <th scope="col">
                {{$email}}:
              </th>
              <th scope="col">
                {{$hash}}:
              </th>
              <th scope="col">
                {{$fullname}}:
              </th>
              <th scope="col">
                {{$last_login_ip}}:
              </th>
              <th scope="col">
                {{$users_created_date}}:
              </th>
              <th scope="col">
                {{$user_lang}}:
              </th>



              <th scope="col">
                {{$user_phone}}:
              </th>

              <th scope="col">
                {{$last_login_time}}:
              </th>

              <th scope="col">
                {{$last_logout_time}}:
              </th>

              <th scope="col">
                {{$user_where}}:
              </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($getUsers as $users)
            <tr>
              <td>
                {{$users->id}}
              </td>
              <td>
                @if(app()->make("Base")->getOnlineStatu($users->id)->status)
                  <span class="label label-sm label-danger">
											{{$active}} </span>
                @else
                  <span class="label label-sm label-success">
											{{$passive}} </span>
                @endif
              </td>
              <td>
                {{ucfirst($users->system_name)}}
              </td>
              <td>
                <img src="{{$baseUrl}}/{{config("app.admin_profil_path")}}/{{$users->photo}}" class="img-responsive" alt=""/>
              </td>
              <td>
                <span class="label label-sm label-warning">
											<span style="color:#333; font-weight:bold;">{{$users->ccode}}</span> </span>

              </td>
              <td>
                <span style="color:#336699; font-weight:bold;">{{$users->username}}</span>
              </td>
              <td>
                {{$users->email}}
              </td>
              <td>
                {{$users->hash}}
              </td>
              <td>
                {{$users->fullname}}
              </td>
              <td>
                {{$users->last_ip}}
              </td>
              <td>
                {{app()->make("Base")->dateFormat($users->created_at)}}
              </td>

              <td>
                {{$users->lang}}
              </td>

              <td>
                {{$users->phone_number}}
              </td>
              <td>
                @if($users->last_login_time==NULL)
                  <span style="color:#336699; font-weight:bold;">{{$never_login_time}}</span>
                @else
                {{app()->make("Base")->dateFormat($users->last_login_time)}}
                <div style="color:#e20a16; font-weight: bold;">{{$time->getPassing($users->last_login_time)->output}}</div>
                @endif
              </td>

              <td>
                @if($users->logout==1)
                {{app()->make("Base")->dateFormat($users->logout_time)}}
                <div style="color:#e20a16; font-weight: bold;">{{$time->getPassing($users->logout_time)->output}}</div>
                  @else
                  -
                  @endif

              </td>

              <td>
                {{$users->user_where}}
              </td>
            </tr>
              @endforeach

            </tbody>
          </table>

        </div>

        {!! $getUsers->render() !!}

      </div>
    </div>
    <!-- END SAMPLE TABLE PORTLET-->

@endif