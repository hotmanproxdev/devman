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
                Online Durumu:
              </th>
              <th scope="col">
                Profil:
              </th>
              <th scope="col">
                Ccode:
              </th>
              <th scope="col">
                Kullanıcı Adı:
              </th>
              <th scope="col">
                Email:
              </th>
              <th scope="col">
                Oturum Şifresi:
              </th>
              <th scope="col">
                Gerçek İsmi:
              </th>
              <th scope="col">
                Son Giriş İpsi:
              </th>
              <th scope="col">
                Kullanıcı Yaratılma Tarihi:
              </th>
              <th scope="col">
                Sistem Dili:
              </th>

              <th scope="col">
                Sistem Yetkisi:
              </th>

              <th scope="col">
                Telefon Numarası:
              </th>

              <th scope="col">
                Son Login Zamanı:
              </th>

              <th scope="col">
                Son Logout Zamanı:
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
											Aktif </span>
                @else
                  <span class="label label-sm label-danger">
											Pasif </span>
                @endif
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
                {{$users->system_name}}
              </td>
              <td>
                {{$users->phone_number}}
              </td>
              <td>
                {{app()->make("Base")->dateFormat($users->last_login_time)}}
                <div style="color:#e20a16; font-weight: bold;">{{$time->getPassing($users->last_login_time)->output}}</div>
              </td>

              <td>
                @if($users->logout==1)
                {{app()->make("Base")->dateFormat($users->logout_time)}}
                <div style="color:#e20a16; font-weight: bold;">{{$time->getPassing($users->logout_time)->output}}</div>
                  @else
                  -
                  @endif

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