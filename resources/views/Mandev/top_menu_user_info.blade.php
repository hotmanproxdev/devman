<!-- BEGIN USER LOGIN DROPDOWN -->
<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
<li class="dropdown dropdown-user">
  <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
    <img alt="" class="img-circle" src="{{$baseUrl}}/{{config("app.admin_profil_path")}}/{{app()->make("Base")->admin()->photo}}"/>
						<span class="username username-hide-on-mobile">
              {{app()->make("Base")->admin()->fullname}}
            </span>
    <i class="fa fa-angle-down"></i>
  </a>
  <ul class="dropdown-menu dropdown-menu-default">
    <li>
      <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/profile/{{app()->make("Base")->admin()->id}}">
        <i class="icon-user"></i>{{$Profile}} </a>
    </li>
    <!--<li>
      <a href="page_calendar.html">
        <i class="icon-calendar"></i> My Calendar </a>
    </li>
    <li>
      <a href="inbox.html">
        <i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
								3 </span>
      </a>
    </li>-->
    <li>
      <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/todo">
        <i class="icon-rocket"></i>{{$tasks}} <span class="badge badge-success">
								7 </span>
      </a>
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
<!-- END USER LOGIN DROPDOWN -->