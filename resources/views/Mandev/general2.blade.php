<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 4.0.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8">
  <title>Metronic | Metronic | Admin Dashboard Template</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="" name="description">
  <meta content="" name="author">

  <script src="{{$baseUrl}}/jquery.js" type="text/javascript"></script>

  <script type="text/javascript">

    var i=1;
    $(document).on("mouseover","body",function () {

      if(i==1)
      {
        {!! $columnChart !!}

        {!! $pieChart !!}
      }


      i++;


    });

  </script>
  <script type="text/javascript" src="{{$baseUrl}}/canvas/canvasjs.min.js"></script>
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css">
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css">
  <!-- END PAGE LEVEL PLUGIN STYLES -->
  <!-- BEGIN PAGE STYLES -->
  <link href="{{$baseUrl}}/metron/theme/assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>

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
  <!-- END PAGE STYLES -->
  <!-- BEGIN THEME STYLES -->
  <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
  <link href="{{$baseUrl}}/metron/theme/assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css">
  <link href="{{$baseUrl}}/metron/theme/assets/global/css/plugins.css" rel="stylesheet" type="text/css">
  <link href="{{$baseUrl}}/metron/theme/assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
  <link href="{{$baseUrl}}/metron/theme/assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
  <link href="{{$baseUrl}}/metron/theme/assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">


  <link rel="stylesheet" type="text/css" href="{{$baseUrl}}/datetimep/jquery.datetimepicker.css"/>


  <link rel="stylesheet" type="text/css" href="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-toastr/toastr.min.css"/>

  <!-- END THEME STYLES -->
  <link rel="shortcut icon" href="favicon.ico">
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body class="{{$menu['body']}}">

<div class="preon"></div>

@include("".config("app.admin_dirname").".prepared.modal.modal")

<!-- BEGIN HEADER -->
<div class="page-header">
  <!-- BEGIN HEADER TOP -->
  <div class="page-header-top">
    <div class="container">
      <!-- BEGIN LOGO -->
      <div class="page-logo">
        <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/home">
          <img src="{{$baseUrl}}/metron/theme/assets/admin/layout3/img/logo-default.png" alt="logo" class="logo-default"/>
        </a>
      </div>
      <!-- END LOGO -->
      <!-- BEGIN RESPONSIVE MENU TOGGLER -->
      <a href="javascript:;" class="menu-toggler"></a>
      <!-- END RESPONSIVE MENU TOGGLER -->
      <!-- BEGIN TOP NAVIGATION MENU -->


      @if(config("app.theme")==1) {{--*/ $theme='' /*--}} @else {{--*/ $theme=''.config("app.theme").'' /*--}} @endif
      <div class="top-menu">
        <ul class="nav navbar-nav pull-right">
          <!-- BEGIN NOTIFICATION DROPDOWN -->
          @include("".config("app.admin_dirname").".top_menu".$theme."_notifications")
          <!-- END NOTIFICATION DROPDOWN -->
          <!-- BEGIN TODO DROPDOWN -->
          @include("".config("app.admin_dirname").".top_menu".$theme."_todo")
          <!-- END TODO DROPDOWN -->
          <li class="droddown dropdown-separator">
            <span class="separator"></span>
          </li>
          <!-- BEGIN INBOX DROPDOWN -->
          @include("".config("app.admin_dirname").".top_menu".$theme."_messages")
          <!-- END INBOX DROPDOWN -->
          <!-- BEGIN USER LOGIN DROPDOWN -->
          @include("".config("app.admin_dirname").".top_menu".$theme."_user_info")
          <!-- END USER LOGIN DROPDOWN -->
          <!-- BEGIN USER LOGIN DROPDOWN -->
          <li class="dropdown dropdown-extended quick-sidebar-toggler">
            <span class="sr-only">Toggle Quick Sidebar</span>
            <i class="icon-logout"></i>
          </li>
          <!-- END USER LOGIN DROPDOWN -->
        </ul>
      </div>
      <!-- END TOP NAVIGATION MENU -->
    </div>
  </div>
  <!-- END HEADER TOP -->
  <!-- BEGIN HEADER MENU -->
  @include(''.config("app.admin_dirname").'.menu'.$theme.'')
  <!-- END HEADER MENU -->
</div>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
  <!-- BEGIN PAGE HEAD -->
  <div class="page-head">
    <div class="container">
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">
        <h1>{{$dashboard}} <small>{{$dashboard_info}}</small></h1>
      </div>
      <!-- END PAGE TITLE -->
      <!-- BEGIN PAGE TOOLBAR -->
      <div class="page-toolbar">

      </div>
      <!-- END PAGE TOOLBAR -->
    </div>
  </div>
  <!-- END PAGE HEAD -->
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    <div class="container">

        @yield('content')

      </div>
    </div>
  <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<!-- BEGIN PRE-FOOTER -->
<div class="page-prefooter">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
        <h2>About</h2>
        <p>
          Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam dolore.
        </p>
      </div>
      <div class="col-md-3 col-sm-6 col-xs12 footer-block">
        <h2>Subscribe Email</h2>
        <div class="subscribe-form">
          <form action="javascript:;">
            <div class="input-group">
              <input type="text" placeholder="mail@email.com" class="form-control">
							<span class="input-group-btn">
							<button class="btn" type="submit">Submit</button>
							</span>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
        <h2>Follow Us On</h2>
        <ul class="social-icons">
          <li>
            <a href="javascript:;" data-original-title="rss" class="rss"></a>
          </li>
          <li>
            <a href="javascript:;" data-original-title="facebook" class="facebook"></a>
          </li>
          <li>
            <a href="javascript:;" data-original-title="twitter" class="twitter"></a>
          </li>
          <li>
            <a href="javascript:;" data-original-title="googleplus" class="googleplus"></a>
          </li>
          <li>
            <a href="javascript:;" data-original-title="linkedin" class="linkedin"></a>
          </li>
          <li>
            <a href="javascript:;" data-original-title="youtube" class="youtube"></a>
          </li>
          <li>
            <a href="javascript:;" data-original-title="vimeo" class="vimeo"></a>
          </li>
        </ul>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
        <h2>Contacts</h2>
        <address class="margin-bottom-40">
          Phone: 800 123 3456<br>
          Email: <a href="mailto:info@metronic.com">info@metronic.com</a>
        </address>
      </div>
    </div>
  </div>
</div>
<!-- END PRE-FOOTER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
  <div class="container">
    2014 &copy; Metronic by keenthemes. <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
  </div>
</div>
<div class="scroll-to-top">
  <i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
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


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="{{$baseUrl}}/metron/theme/assets/global/plugins/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery.input-ip-address-control-1.0.min.js"></script>

<div id="notification"></div>


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
    format:'{{config("app.dateFormat")}}',
    defaultTime:'00:00'
  });


  $("body").on("click",".datetimepicker",function()
  {
    $(this).datetimepicker({
      format:'{{config("app.dateFormat")}}',
      defaultTime:'00:00'
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
    $(".select2").select2({allowClear: true,multiple:true });
  });


  $("body").on("mouseover","#apiedit",function()
  {
    $(".select2").select2({});
  });


  $(document).on("click","a.xmodal",function(event)
  {
    event.preventDefault();
    var href=$(this).attr("href");
    var href2=href.replace("#","",href);
    var model=$(this).attr("model");
    var title=$(this).attr("modal-title");
    $("h4.modal-title").html(title);
    $(".modalLoad"+href2).load(model);

  });
</script>

<script>

  $('input[class="make-switch"]').on('switchChange.bootstrapSwitch', function(event, state) {

    var model=$(this).attr("data-model");
    $(".preon").load("{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/test/makeswitch?model="+model+"&state="+state);
  });

  $(document).on("change","select.changesql",function()
  {

    var changesql=$(this).attr("changesql");
    var val=$(this).val();
    var result=$(this).attr("changesqlresult");

    $("select."+result).load("{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/test/changesql?changesql="+changesql+"&val="+val);


  });

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



  $(document).on("click","input.signall",function(){

    var x=$(this).prop("checked");
    var name=$(this).attr("name");
    $("input."+name+"_sign").prop("checked",x);
    if(x)
    {
      $("."+name+"_table .checker span").attr("class","checked");
    }
    else
    {
      $("."+name+"_table .checker span").attr("class","");
    }


  });
  $(document).on("click","td.page-ajax-passive",function(){

    var name=$(this).attr("name");
    var no=$(this).attr("no");
    var limitview=$(this).attr("limitview");
    var count=$(this).attr("count");
    var file=$(this).attr("file");


    if(no>1)
    {
      $("table."+name+" td.prev-page-ajax").show();
    }

    if(no==1)
    {
      $("table."+name+" td.prev-page-ajax").hide();

    }

    if(no<=limitview)
    {
      $("table."+name+" td.oajax").hide();

      $(".ajaxPageFull2").addClass("ajaxPageFull");
      $(".ajaxPageFull2").removeClass("ajaxPageFull2");
    }


    if(parseInt(no)<parseInt(count))
    {
      $("table."+name+" td.next-page-ajax").show();
    }


    var next=parseInt(no)+parseInt(1);
    var prev=parseInt(no)-parseInt(1);

    $("table."+name+" td.page-ajax-active").addClass("page-ajax-passive");
    $("table."+name+" td.page-ajax-active").removeClass("page-ajax-active");

    $(this).addClass("page-ajax-active");
    $(this).removeClass("page-ajax-passive");

    $("table."+name+" td."+name+"_nextajax").attr("nextno",next);
    $("table."+name+" td."+name+"_prevajax").attr("prevno",prev);

    var loading='<img src="{{$baseUrl}}/square.gif" width="80">';
    document.getElementById(""+name+"_table_loading").innerHTML=loading;
    $("."+name+"_table").load(""+file+"?page="+no+"&pxname="+name);

  });


  $(document).on("click","td.next-page-ajax",function(e){

    var name=$(this).attr("name");
    var no=$(this).attr("nextno");
    var limitview=$(this).attr("limitview");
    var count=$(this).attr("count");
    var file=$(this).attr("file");


    if(parseInt(no)>=parseInt(count))
    {
      $("table."+name+" td.next-page-ajax").hide();
    }

    if(no>1)
    {
      $("table."+name+" td.prev-page-ajax").show();
    }

    if(parseInt(no)>parseInt(limitview))
    {

      $(".ajaxPageFull").addClass("ajaxPageFull2");
      $(".ajaxPageFull").removeClass("ajaxPageFull");

      $("table."+name+" td.oajax").show();
      $("span#"+name+"_oajax").html(no);
    }

    var next=parseInt(no)+parseInt(1);
    var prev=parseInt(no)-parseInt(1);

    $("table."+name+" td.page-ajax-active").addClass("page-ajax-passive");
    $("table."+name+" td.page-ajax-active").removeClass("page-ajax-active");

    $("table."+name+" td#page-ajax-active_"+no).addClass("page-ajax-active");
    $("table."+name+" td#page-ajax-active_"+no).removeClass("page-ajax-passive");

    $("table."+name+" td."+name+"_nextajax").attr("nextno",parseInt(next));
    $("table."+name+" td."+name+"_prevajax").attr("prevno",parseInt(prev));

    var loading='<img src="{{$baseUrl}}/square.gif" width="80">';
    document.getElementById(""+name+"_table_loading").innerHTML=loading;
    $("."+name+"_table").load(""+file+"?page="+no+"&pxname="+name);

  });


  $(document).on("click","td.prev-page-ajax",function(){

    var name=$(this).attr("name");
    var no=$(this).attr("prevno");
    var limitview=$(this).attr("limitview");
    var count=$(this).attr("count");
    var file=$(this).attr("file");


    if(no==1)
    {
      $("table."+name+" td.prev-page-ajax").hide();
    }

    if(parseInt(no)<parseInt(count))
    {
      $("table."+name+" td.next-page-ajax").show();
    }


    if(parseInt(no)<=parseInt(limitview))
    {
      $(".ajaxPageFull2").addClass("ajaxPageFull");
      $(".ajaxPageFull2").removeClass("ajaxPageFull2");
      $("table."+name+" td.oajax").hide();
    }


    if(parseInt(no)>parseInt(limitview))
    {
      $("table."+name+" td.oajax").show();
      $("span#"+name+"_oajax").html(no);
    }

    var next=parseInt(no)+parseInt(1);
    var prev=parseInt(no)-parseInt(1);

    $("table."+name+" td.page-ajax-active").addClass("page-ajax-passive");
    $("table."+name+" td.page-ajax-active").removeClass("page-ajax-active");

    $("table."+name+" td#page-ajax-active_"+no).addClass("page-ajax-active");
    $("table."+name+" td#page-ajax-active_"+no).removeClass("page-ajax-passive");

    $("table."+name+" td."+name+"_nextajax").attr("nextno",next);
    $("table."+name+" td."+name+"_prevajax").attr("prevno",prev);

    var loading='<img src="{{$baseUrl}}/square.gif" width="80">';
    document.getElementById(""+name+"_table_loading").innerHTML=loading;
    $("."+name+"_table").load(""+file+"?page="+no+"&pxname="+name);

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


  $(document).on("click","a.atabs",function()
  {
    var href=$(this).attr("href");
    var href=href.replace("#","");
    var model=$(this).attr("model");
    var loading='<img src="{{$baseUrl}}/square.gif" width="80">';
    document.getElementById(href).innerHTML=loading;
    $("#"+href).load("{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/"+model);
  });



  //notifications
  setInterval(function(){ $("#notification").load("{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/test/desktopnotification"); }, 10000);

</script>

<!--test-->
{!! $linechart !!}


</body>
<!-- END BODY -->
</html>