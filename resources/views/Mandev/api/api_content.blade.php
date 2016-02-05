@if($pageRole==false)
    @include("".config("app.admin_dirname").".noauth")
@else


  <div class="col-md-12 col-sm-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light ">
      <div class="portlet-title">
        <div class="caption">
          <i class="icon-share font-red-sunglo hide"></i>
          <span class="caption-subject font-red-sunglo bold uppercase">Revenue</span>
          <span class="caption-helper">monthly stats...</span>
        </div>
        <div class="actions">
          <div class="btn-group">
            <a href="" class="btn grey-salsa btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
              Filter Range&nbsp;<span class="fa fa-angle-down">
										</span>
            </a>
            <ul class="dropdown-menu pull-right">
              <li>
                <a href="javascript:;">
                  Q1 2014 <span class="label label-sm label-default">
												past </span>
                </a>
              </li>
              <li>
                <a href="javascript:;">
                  Q2 2014 <span class="label label-sm label-default">
												past </span>
                </a>
              </li>
              <li class="active">
                <a href="javascript:;">
                  Q3 2014 <span class="label label-sm label-success">
												current </span>
                </a>
              </li>
              <li>
                <a href="javascript:;">
                  Q4 2014 <span class="label label-sm label-warning">
												upcoming </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="portlet-body">
        <div id="site_activities_loading3">
          <img src="{{config("app.project_path")}}/metron/theme/assets/admin/layout2/img/loading.gif" alt="loading"/>
        </div>
        <div id="site_activities_content3" class="display-none">
          <div id="site_activities3" style="height: 228px;">
          </div>
        </div>

      </div>
    </div>
    <!-- END PORTLET-->
  </div>

  <div class="col-md-12 col-sm-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light ">
      <div class="portlet-title">
        <div class="caption">
          <i class="icon-share font-red-sunglo hide"></i>
          <span class="caption-subject font-red-sunglo bold uppercase">Revenue</span>
          <span class="caption-helper">monthly stats...</span>
        </div>
        <div class="actions">
          <div class="btn-group">
            <a href="" class="btn grey-salsa btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
              Filter Range&nbsp;<span class="fa fa-angle-down">
										</span>
            </a>
            <ul class="dropdown-menu pull-right">
              <li>
                <a href="javascript:;">
                  Q1 2014 <span class="label label-sm label-default">
												past </span>
                </a>
              </li>
              <li>
                <a href="javascript:;">
                  Q2 2014 <span class="label label-sm label-default">
												past </span>
                </a>
              </li>
              <li class="active">
                <a href="javascript:;">
                  Q3 2014 <span class="label label-sm label-success">
												current </span>
                </a>
              </li>
              <li>
                <a href="javascript:;">
                  Q4 2014 <span class="label label-sm label-warning">
												upcoming </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="portlet-body">
        <div id="site_activities_loading2">
          <img src="{{config("app.project_path")}}/metron/theme/assets/admin/layout2/img/loading.gif" alt="loading"/>
        </div>
        <div id="site_activities_content2" class="display-none">
          <div id="site_activities2" style="height: 228px;">
          </div>
        </div>

      </div>
    </div>
    <!-- END PORTLET-->
  </div>

@endif