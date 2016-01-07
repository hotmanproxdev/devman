@if($pageRole==false)
    @include("".config("app.admin_dirname").".noauth")
@else


    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet box purple">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>{{$defined_all_users}}
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
      <div class="portlet-body">
        <div class="table-scrollable getUsers">
          <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
              <th scope="col">
                İd:
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
                Online Durumu:
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
            </tr>
            </thead>
            <tbody>
            @foreach ($getUsers as $users)
            <tr>
              <td>
                {{$users->id}}
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
                @if(app()->make("Base")->getOnlineStatu($users->id))
                  <span class="label label-sm label-danger">
											Aktif </span>
                  @else
                  <span class="label label-sm label-danger">
											Pasif </span>
                  @endif
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