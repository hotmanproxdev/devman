@if($pageRole==false)
    @include("".config("app.admin_dirname").".noauth")
@else

<div class="row">
    <div class="col-md-12">
      <div class="note note-bordered note-success">
        <p>
          --
        </p>
        <p>
          <span class="label label-warning">--:</span>&nbsp; --
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
  									{{$logtable}} </span>
            <span class="caption-helper">list</span>
          </div>

        </div>
        <div class="portlet-body">
          <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-lg">
              <li class="active">
                <a href="#tab_1" data-toggle="tab">
                  {{$logtable}} </a>
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

<!--<div id="charts">


    <div class="row">

      <div class="col-md-12 col-sm-12">
        <div id="chart_column1" style="height: 600px;"></div>
      </div>

      <div class="col-md-12 col-sm-12">
        <div id="chart_pie1" style="height: 600px;"></div>
      </div>


    </div>


</div>-->


@endif