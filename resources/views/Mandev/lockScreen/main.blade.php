<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 3.3.0
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
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8"/>
  <title>Prosystem | Admin Page</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta content="" name="description"/>
  <meta content="" name="author"/>
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN PAGE LEVEL STYLES -->
  <link href="{{$baseUrl}}/metron/theme/assets/admin/pages/css/lock.css" rel="stylesheet" type="text/css"/>
  <!-- END PAGE LEVEL STYLES -->
  <!-- BEGIN THEME STYLES -->
  <link href="{{$baseUrl}}/metron/theme/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
  <link href="{{$baseUrl}}/metron/theme/assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
  <link href="{{$baseUrl}}/metron/theme/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
  <!-- END THEME STYLES -->
  <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
<div class="page-lock">
  <div class="page-logo">
    <a class="brand" href="index.html">
      <img src="{{$baseUrl}}/metron/theme/assets/admin/layout2/img/logo-big.png" alt="logo"/>
    </a>
  </div>
  <div class="page-body">
    <div class="lock-head">
      {{$info}}
    </div>
    <div class="lock-body">
      <div class="pull-left lock-avatar-block">
        <img alt="" class="img-circle lock-avatar" src="{{$baseUrl}}/{{config("app.admin_profil_path")}}/{{$locked_admin->photo}}"/>
      </div>
      <form class="lock-form pull-left" action="" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="username" value="{{$locked_admin->username}}">
        <input type="hidden" name="ccode" value="{{$locked_admin->ccode}}">
        <h4>{{$locked_admin->fullname}}</h4>
        <div class="form-group">
          <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-success uppercase">{{$login}}</button>
        </div>
      </form>
    </div>
    <div class="lock-bottom">
      <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/login">{{$locked_admin->fullname}} {{$not}}</a>
    </div>
  </div>
  <div class="page-footer-custom">
    2015 &copy; Developer : Ali Gürbüz [sde].
  </div>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/respond.min.js"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="{{$baseUrl}}/metron/theme/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="{{$baseUrl}}/metron/theme/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
  jQuery(document).ready(function() {
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    Demo.init();
  });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>