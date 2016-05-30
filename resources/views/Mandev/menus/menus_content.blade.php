@if($pageRole==false)
    @include("".config("app.admin_dirname").".noauth")
@else

<div class="row">
    <div class="col-md-12">
      <div class="note note-bordered note-success">
        <p>
          {{$menuinfo}}.
        </p>
        <p>

        </p>
        <p>
          {{$more}} <span style="color:#336699;">{{$contact}}</span>
        </p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <!-- Begin: life time stats -->
      <div class="portlet light">
        <div class="portlet-title">
          <div class="caption">
            <i class="icon-basket font-green-sharp"></i>
  									<span class="caption-subject font-green-sharp bold uppercase">
  									{{$menulist}} </span>
            <span class="caption-helper">list</span>
          </div>

        </div>
        <div class="portlet-body">
          <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-lg">
              <li class="active">
                <a href="#tab_1" data-toggle="tab">
                  {{$menulist}} </a>
              </li>
              <!--<li>
                <a href="#tab_2" data-toggle="tab" class="atabs" model="apicenter/apilogs?ajax=true">
                  Api Logları
                </a>
              </li>
              <li>
                <a href="#tab_3" data-toggle="tab" class="atabs" model="apicenter/serviceinfo?ajax=true">
                  Servis Bilgileri </a>
              </li>-->

            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">

                <div style="margin:0 0 5px 0;">

                  <div class="divlay">
                    <a class="indent btn btn-lg blue xmodal" model="menus/newmenus" modal-title="menus" data-target="#full-width" href="#full-width" data-toggle="modal">
                      {{$newbutton}} <i class="fa fa-plus"></i>
                    </a>
                  </div>



                  <div class="clear"></div>

                </div>

                @section("tsql")

                  {!! $query !!}

                @show

              </div>
              <div class="tab-pane" id="tab_2">
                Tab2
              </div>
              <div class="tab-pane" id="tab_3">
                Tab3
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- End: life time stats -->
    </div>
  </div>



@endif