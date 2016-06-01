<div class="page-header-menu">
  <div class="container">
    <!-- BEGIN HEADER SEARCH BOX -->
    <form class="search-form" action="" method="GET">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="{{$mainsearch}}" name="query">
					<span class="input-group-btn">
					<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
					</span>
      </div>
    </form>
    <!-- END HEADER SEARCH BOX -->
    <!-- BEGIN MEGA MENU -->
    <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
    <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->

    {{--*/ $parent=array() /*--}}
    {{--*/ $menus=array() /*--}}
    {{--*/ $icon=array() /*--}}
    {{--*/ $sub=array() /*--}}


    @foreach ($menuParentData as $parentresult)

      {{--*/ $parent[$parentresult->parent]['menu'][]=$parentresult->menu /*--}}
      {{--*/ $parent[$parentresult->parent]['link'][]=$parentresult->link /*--}}
      {{--*/ $parent[$parentresult->parent]['icon'][]=$parentresult->icon /*--}}
      {{--*/ $parent[$parentresult->parent]['role'][]=$parentresult->role /*--}}

      {{--*/ $menus[$parentresult->link]=$parentresult->menu /*--}}
      {{--*/ $sub[$parentresult->parent]=$parentresult->id /*--}}
    @endforeach


    <div class="hor-menu ">
      <ul class="nav navbar-nav">



        @if($route==="home")

        <li class="active">

          @else
          <li class="">
            @endif


          <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/home">
            <i class="icon-home"></i>

            @if($route==="home")
            <span class="title" style="color:#ffffdd;">{{$homepage}}</span>

            @else
              <span class="title" style="">{{$homepage}}</span>
              @endif
            <span class="selected"></span>
          </a>
        </li>




        @foreach ($menuData as $result)

          @if($route===$result->link and !array_key_exists($result->id,$parent))
              <li class="active menu-dropdown mega-menu-dropdown ">
            @else

              @if($route===$result->link or (array_key_exists($result->id,$parent) and in_array($route,$parent[$result->id]['link'])))
              <li class="active menu-dropdown mega-menu-dropdown ">
              @else
              <li class="menu-dropdown mega-menu-dropdown ">
              @endif

            @endif




            @if(array_key_exists($result->id,$sub))
            <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}"

               @else
              <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/{{$result->link}}"
                   @endif
               class="dropdown-toggle">


              <i class="{{$result->icon}}"></i>

              @if(array_key_exists($result->id,$parent) && in_array($route,$parent[$result->id]['link']))
                <span class="title" style="color:#ffffdd;">{{$result->menu}} - {{$menus[$route]}}</span>
                @else
                <span class="title">{{$result->menu}}</span>
                @endif



              @if(array_key_exists($result->id,$parent))
                <span class="arrow "></span>
                <i class="fa fa-angle-down"></i>
              @endif

            </a>

            @if(array_key_exists($result->id,$sub))
            <ul class="dropdown-menu" style="min-width: 226px">
              <li>
                <div class="mega-menu-content">
                  <div class="row">
                    <div class="col-md-12">
                      <ul class="mega-menu-submenu">

                        @if(array_key_exists($result->id,$parent))

                          @foreach ($parent[$result->id]['menu'] as $submenukey=>$submenuval)

                            @if(app()->make("Base")->pageRole(['pageRole'=>$parent[$result->id]['role'][$submenukey],'admin'=>$admin]))
                              <li>
                                <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/{{$parent[$result->id]['link'][$submenukey]}}" class="iconify">
                                  <i class="{{$parent[$result->id]['icon'][$submenukey]}}"></i>
                                  {{$submenuval}}</a>
                              </li>
                            @endif
                          @endforeach

                        @endif




                      </ul>
                    </div>

                  </div>
                </div>
              </li>
              @else
                <ul>
                @endif

            </ul>



          </li>


        @endforeach




      </ul>
    </div>
    <!-- END MEGA MENU -->
  </div>
</div>