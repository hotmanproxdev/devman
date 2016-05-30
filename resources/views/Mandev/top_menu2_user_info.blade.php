<li class="dropdown dropdown-user dropdown-dark">
  <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
    <img alt="" class="img-circle" src="{{$baseUrl}}/{{config("app.admin_profil_path")}}/{{app()->make("Base")->admin()->photo}}"/>
						<span class="username username-hide-on-mobile">
              {{app()->make("Base")->admin()->fullname}}
            </span>
  </a>
  <ul class="dropdown-menu dropdown-menu-default">
    <li>
      <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/profile/{{app()->make("Base")->admin()->id}}">
        <i class="icon-user"></i>{{$Profile}} </a>
    </li>

    <li class="divider">
    </li>
    <li>
      <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/lockscreen">
        <i class="icon-lock"></i>{{$lockscreen}} </a>
    </li>
    <li>
      <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/logout">
        <i class="icon-key"></i>{{$logout}} </a>
    </li>
  </ul>
</li>