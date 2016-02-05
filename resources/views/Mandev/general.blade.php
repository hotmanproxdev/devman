<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8"/>
  <title>Prosystem | Admin Page</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <meta content="" name="description"/>
  <meta content="" name="author"/>
  <script src="{{$baseUrl}}/jquery.js" type="text/javascript"></script>

  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>-->
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
  <!-- END PAGE LEVEL PLUGIN STYLES -->

  <!-- BEGIN DROPDOWNS PAGE LEVEL STYLES -->
  <link rel="stylesheet" type="text/css" href="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
  <link rel="stylesheet" type="text/css" href="{{$baseUrl}}/metron/theme/assets/global/plugins/select2/select2.css"/>
  <link rel="stylesheet" type="text/css" href="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery-multi-select/css/multi-select.css"/>

  <!-- BEGIN PAGE STYLES -->
  <link href="{{$baseUrl}}/metron/theme/assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
  <!-- END PAGE STYLES -->


  <!-- BEGIN PAGE LEVEL STYLES -->
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>

  <!-- END PAGE LEVEL STYLES -->

  <!-- BEGIN THEME STYLES -->
  <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
  <link href="{{$baseUrl}}/metron/theme/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css" id="style_color"/>
  <link href="{{$baseUrl}}/metron/theme/assets/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>

  <link rel="stylesheet" type="text/css" href="{{$baseUrl}}/datetimep/jquery.datetimepicker.css"/>


  <link rel="stylesheet" type="text/css" href="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-toastr/toastr.min.css"/>

  <!-- END THEME STYLES -->
  <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="{{$menu['body']}}">

@include("".config("app.admin_dirname").".prepared.modal.modal")

<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner container">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
      <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/home">
        <img src="{{$baseUrl}}/metron/theme/assets/admin/layout2/img/logo-default.png" alt="logo" class="logo-default"/>
      </a>
      <div class="menu-toggler sidebar-toggler">
        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
      </div>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
    </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN PAGE ACTIONS -->
    <!-- DOC: Remove "hide" class to enable the page header actions -->
    <div class="page-actions hide">
      <div class="btn-group">
        <button type="button" class="btn btn-circle red-pink dropdown-toggle" data-toggle="dropdown">
          <i class="icon-bar-chart"></i>&nbsp;<span class="hidden-sm hidden-xs">New&nbsp;</span>&nbsp;<i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu" role="menu">
          <li>
            <a href="javascript:;">
              <i class="icon-user"></i> New User </a>
          </li>
          <li>
            <a href="javascript:;">
              <i class="icon-present"></i> New Event <span class="badge badge-success">4</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <i class="icon-basket"></i> New order </a>
          </li>
          <li class="divider">
          </li>
          <li>
            <a href="javascript:;">
              <i class="icon-flag"></i> Pending Orders <span class="badge badge-danger">4</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <i class="icon-users"></i> Pending Users <span class="badge badge-warning">12</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="btn-group">
        <button type="button" class="btn btn-circle green-haze dropdown-toggle" data-toggle="dropdown">
          <i class="icon-bell"></i>&nbsp;<span class="hidden-sm hidden-xs">Post&nbsp;</span>&nbsp;<i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu" role="menu">
          <li>
            <a href="javascript:;">
              <i class="icon-docs"></i> New Post </a>
          </li>
          <li>
            <a href="javascript:;">
              <i class="icon-tag"></i> New Comment </a>
          </li>
          <li>
            <a href="javascript:;">
              <i class="icon-share"></i> Share </a>
          </li>
          <li class="divider">
          </li>
          <li>
            <a href="javascript:;">
              <i class="icon-flag"></i> Comments <span class="badge badge-success">4</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <i class="icon-users"></i> Feedbacks <span class="badge badge-danger">2</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- END PAGE ACTIONS -->
    <!-- BEGIN PAGE TOP -->
    <div class="page-top">
      <!-- BEGIN HEADER SEARCH BOX -->
      <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
      <form class="search-form search-form-expanded" action="" method="POST">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="{{$mainsearch}}..." name="query">
					<span class="input-group-btn">
					<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
					</span>
        </div>
      </form>
      <!-- END HEADER SEARCH BOX -->
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="top-menu">
        <ul class="nav navbar-nav pull-right">
          @include("".config("app.admin_dirname").".top_menu_notifications")
          @include("".config("app.admin_dirname").".top_menu_messages")
          @include("".config("app.admin_dirname").".top_menu_todo")
          @include("".config("app.admin_dirname").".top_menu_user_info")

          <!-- BEGIN USER LOGIN DROPDOWN -->
          <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
          <li class="dropdown dropdown-extended quick-sidebar-toggler">
            <span class="sr-only">Toggle Quick Sidebar</span>
            <i class="icon-logout"></i>
          </li>
          <!-- END USER LOGIN DROPDOWN -->
        </ul>
      </div>
      <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END PAGE TOP -->
  </div>
  <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="container">
  <div class="page-container">
    @include(''.config("app.admin_dirname").'.menu')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
      <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal title</h4>
              </div>
              <div class="modal-body">
                Widget settings form goes here
              </div>
              <div class="modal-footer">
                <button type="button" class="btn blue">Save changes</button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
          {{$dashboard}}</h3>
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li>
              <i class="fa fa-angle-right"></i>
              <a>{{$dashboard_info}}</a>
            </li>

          </ul>

        </div>
        <!-- END PAGE HEADER-->
        @yield('content')
      </div>

      @include("".config("app.admin_dirname").".sidebar_chat")
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
    <!--Cooming Soon...-->
    <!-- END QUICK SIDEBAR -->
  </div>
  <!-- END CONTAINER -->
  <!-- BEGIN FOOTER -->
  <div class="page-footer">
    <div class="page-footer-inner">
      2015 &copy; Developer: Ali Gürbüz [sde]
    </div>
    <div class="scroll-to-top">
      <i class="icon-arrow-up"></i>
    </div>
  </div>
  <!-- END FOOTER -->
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/respond.min.js"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="{{$baseUrl}}/metron/theme/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<!-- END PAGE LEVEL PLUGINS -->


<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{$baseUrl}}/metron/theme/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/admin/layout2/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>

<script src="{{$baseUrl}}/datetimep/build/jquery.datetimepicker.full.js"></script>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>

<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>

<!-- END PAGE LEVEL PLUGINS -->
<script>
  $.datetimepicker.setLocale('en');
  $('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
  $("#datetimepicker_format_change").on("click", function(e){
    $("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
  });
  $("#datetimepicker_format_locale").on("change", function(e){
    $.datetimepicker.setLocale($(e.currentTarget).val());
  });

    $('.datetimepicker').datetimepicker({
      dayOfWeekStart : 1,
      lang:'tr',
      format:'{{config("app.dateFormat")}}',
      step:10,
    });


  $("body").on("click",".datetimepicker",function()
  {
    $(this).datetimepicker({
      dayOfWeekStart : 1,
      lang:'tr',
      format:'{{config("app.dateFormat")}}',
      step:10,
    });
    $(this).datetimepicker("show");
    var style=$(".xdsoft_").attr("style");
    $(".xdsoft_").attr("style",""+style+" z-index:9999999;");
  });

  $('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});
  $('.some_class').datetimepicker();
  $('#default_datetimepicker').datetimepicker({
    formatTime:'H:i',
    formatDate:'d.m.Y',
    //defaultDate:'8.12.1986', // it's my birthday
    defaultDate:'+03.01.1970', // it's my birthday
    defaultTime:'10:00',
    timepickerScrollbar:false
  });
  $('#datetimepicker10').datetimepicker({
    step:5,
    inline:true
  });
  $('#datetimepicker_mask').datetimepicker({
    mask:'9999/19/39 29:59'
  });
  $('#datetimepicker1').datetimepicker({
    datepicker:false,
    format:'H:i',
    step:5
  });
  $('#datetimepicker2').datetimepicker({
    yearOffset:222,
    lang:'ch',
    timepicker:false,
    format:'d/m/Y',
    formatDate:'Y/m/d',
    minDate:'-1970/01/02', // yesterday is minimum date
    maxDate:'+1970/01/02' // and tommorow is maximum date calendar
  });
  $('#datetimepicker3').datetimepicker({
    inline:true
  });
  $('#datetimepicker4').datetimepicker();
  $('#open').click(function(){
    $('#datetimepicker4').datetimepicker('show');
  });
  $('#close').click(function(){
    $('#datetimepicker4').datetimepicker('hide');
  });
  $('#reset').click(function(){
    $('#datetimepicker4').datetimepicker('reset');
  });
  $('#datetimepicker5').datetimepicker({
    datepicker:false,
    allowTimes:['12:00','13:00','15:00','17:00','17:05','17:20','19:00','20:00'],
    step:5
  });
  $('#datetimepicker6').datetimepicker();
  $('#destroy').click(function(){
    if( $('#datetimepicker6').data('xdsoft_datetimepicker') ){
      $('#datetimepicker6').datetimepicker('destroy');
      this.value = 'create';
    }else{
      $('#datetimepicker6').datetimepicker();
      this.value = 'destroy';
    }
  });
  var logic = function( currentDateTime ){
    if (currentDateTime && currentDateTime.getDay() == 6){
      this.setOptions({
        minTime:'11:00'
      });
    }else
      this.setOptions({
        minTime:'8:00'
      });
  };
  $('#datetimepicker7').datetimepicker({
    onChangeDateTime:logic,
    onShow:logic
  });
  $('#datetimepicker8').datetimepicker({
    onGenerate:function( ct ){
      $(this).find('.xdsoft_date')
          .toggleClass('xdsoft_disabled');
    },
    minDate:'-1970/01/2',
    maxDate:'+1970/01/2',
    timepicker:false
  });
  $('#datetimepicker9').datetimepicker({
    onGenerate:function( ct ){
      $(this).find('.xdsoft_date.xdsoft_weekend')
          .addClass('xdsoft_disabled');
    },
    weekends:['01.01.2014','02.01.2014','03.01.2014','04.01.2014','05.01.2014','06.01.2014'],
    timepicker:false
  });
  var dateToDisable = new Date();
  dateToDisable.setDate(dateToDisable.getDate() + 2);
  $('#datetimepicker11').datetimepicker({
    beforeShowDay: function(date) {
      if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
        return [false, ""]
      }
      return [true, ""];
    }
  });
  $('#datetimepicker12').datetimepicker({
    beforeShowDay: function(date) {
      if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
        return [true, "custom-date-style"];
      }
      return [true, ""];
    }
  });
  $('#datetimepicker_dark').datetimepicker({theme:'dark'})
</script>



<!-- END PAGE LEVEL SCRIPTS -->
<script>
  jQuery(document).ready(function() {
    Metronic.init(); // init metronic core componets
    Layout.init(); // init layout
    Demo.init(); // init demo features 
    QuickSidebar.init(); // init quick sidebar
    Index.init();
    Index.initDashboardDaterange();
    Index.initJQVMAP(); // init index page's custom scripts
    Index.initCalendar(); // init index page's custom scripts
    Index.initCharts(); // init index page's custom scripts
    Index.initChat();
    Index.initMiniCharts();
    Tasks.initDashboardWidget();
    UIExtendedModals.init();
    ComponentsDropdowns.init();
  });
</script>
<!-- END JAVASCRIPTS -->

<script>

  $(window).load(function()
  {
    $(".select2").select2({allowClear: true});
  });

  $("body").on("hover",".select2",function()
  {
    $(this).select2({allowClear: true});

  });

  $(document).on("click","a.xmodal",function(event)
  {
    event.preventDefault();
    var href=$(this).attr("href");
    var href2=href.replace("#","",href);
    var model=$(this).attr("model");
    var title=$(this).attr("modal-title");
    $(".modalLoad"+href2).load(model);
    $("h4.modal-title").html(title);
  });
</script>

<script>

  $(document).on("keyup","input.autocomplete",function()
  {
    var method=$(this).attr("autocomplete_method");
    var model=$(this).attr("model");
    var context=$(this).attr("context");
    var val=$(this).val();
    var rval=val.replace(/ /g,"____");
    if(rval.length>0)
    {
      $(".autocomplete_result").show();
      $(".autocomplete_result").load("{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/test/autocomplete?autoval="+rval+"&automodel="+model+"&context="+context);
    }
    else
    {
      $(".autocomplete_result").html("");
      $(".autocomplete_result").hide();
    }

  });

  $(document).on("click","a.submit",function(){
    var form=$(this).attr("ajax-form");
    $("form#"+form).find(".form-control").each(function(index,value)
    {
      var required=$(this).attr("require");
      if(required!==undefined)
      {
        var require_split=required.split("-");
        var val=$(""+require_split[0]+"."+require_split[1]).val();
        if(val.length==0)
        {
          $(""+require_split[0]+"."+require_split[1]).focus();
          $("span."+require_split[1]).show();
          exit();
        }
      }
    });
    var action=$(this).attr("action");
    var loading='<img src="{{$baseUrl}}/reload.gif" width="32">';
    document.getElementById(""+form+"result").innerHTML=loading;
    var data = new window.FormData($('form#'+form)[0]);
    $.ajax({
      url:action,
      type:"POST",
      data:data,
      cache: false,
      contentType : false,
      processData: false,
      success:function(data){
        $("span#"+form+"result").html(data);
      },
      error: function () { $("span#"+form+"result").html("error"); }
    });
  });
</script>

<!--test-->
{!! $linechart !!}









</body>
<!-- END BODY -->
</html>