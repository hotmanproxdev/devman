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
    <div class="hor-menu ">
      <ul class="nav navbar-nav">
        <li class="active">
          <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/home">
            <i class="icon-home"></i>
            <span class="title">Anasayfa</span>
            <span class="selected"></span>
          </a>
        </li>


        @foreach ($menuData as $menuresult)


          <li class="menu-dropdown mega-menu-dropdown ">

            @if(count($menuParentData))

              {{--*/ $k=false /*--}}
            @foreach ($menuParentData as $menuresult2)

              @if(!$k)
              @if($menuresult2->parent==$menuresult->id)

            <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/{{$menuresult->link}}"
               class="dropdown-toggle">

              {{--*/ $down=true /*--}}

              @else

                <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/{{$menuresult->link}}"
                   class="dropdown-toggle">

                  {{--*/ $down=false /*--}}

                @endif

                  @endif

                  {{--*/ $k=true /*--}}

              @endforeach

                  @else


                    <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/{{$menuresult->link}}"
                       class="dropdown-toggle">
                    {{--*/ $down=false /*--}}


                    @endif



              <i class="{{$menuresult->icon}}"></i>
              <span class="title">{{$menuresult->menu}}</span>
              <span class="arrow "></span>

                  @if($down)
                    <i class="fa fa-angle-down"></i>
                    @else

                    @endif

            </a>


            <ul class="dropdown-menu" style="min-width: 200px">
              <li>
                <div class="mega-menu-content">
                  <div class="row">
                    <div class="col-md-12">
                      <ul class="mega-menu-submenu">

                        @foreach ($menuParentData as $menuresult2)

                          @if($menuresult2->parent==$menuresult->id)

                        <li>
                          <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/{{$menuresult2->link}}" class="iconify">
                            <i class="{{$menuresult2->icon}}"></i>
                            {{$menuresult2->menu}}</a>
                        </li>

                          @endif


                        @endforeach

                      </ul>
                    </div>

                  </div>
                </div>
              </li>
            </ul>



          </li>


          @endforeach






      </ul>
    </div>
    <!-- END MEGA MENU -->
  </div>
</div>