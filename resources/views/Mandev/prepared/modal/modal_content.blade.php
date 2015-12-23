
<div class="row">
  <div class="col-md-12">
    <div class="portlet yellow box">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Notific8 Notification Demo
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse">
          </a>
          <a href="#portlet-config" data-toggle="modal" class="config">
          </a>
          <a href="javascript:;" class="reload">
          </a>
          <a href="javascript:;" class="remove">
          </a>
        </div>
      </div>
      <div class="portlet-body">
        <div class="note note-success">
          <h4 class="block">jquery.notific8</h4>
          <p>
            jquery.notific8 is a notification plug-in that was inspired by the notification style introduced in Windows 8. For more info Check out <a href="https://github.com/willsteinmetz/jquery-notific8" target="_blank">
              the official github respository </a>
          </p>
        </div>
        <form id="modalcontent" method="post" class="form-horizontal">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
            <label class="col-md-3 control-label" for="title">Notification text:</label>
            <div class="col-md-5">
              <input id="notific8_text" type="text" name="notification_text" class="form-control" value="Inspired by Windows 8 notifications" placeholder="enter a text ..."/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" for="title">Heading(optional):</label>
            <div class="col-md-5">
              <input id="notific8_heading" type="text" class="form-control" value="" placeholder="enter a heading ..."/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" for="title">Sticky ?</label>
            <div class="col-md-5">
              <label class="checkbox">
                <input type="checkbox" id="notific8_sticky" value="1">
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" for="title">Life:</label>
            <div class="col-md-5">
              <select id="notific8_life" class="form-control input-medium">
                <option value="1000">1 second</option>
                <option value="5000">5 seconds</option>
                <option value="10000" selected="selected">10 seconds (default)</option>
                <option value="25000">25 seconds</option>
                <option value="60000">60 seconds</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" for="title">Style:</label>
            <div class="col-md-5">
              <select id="notific8_theme" class="form-control input-medium">
                <option value="teal" selected="selected">teal (default)</option>
                <option value="amethyst">amethyst</option>
                <option value="ruby">ruby</option>
                <option value="tangerine">tangerine</option>
                <option value="lemon">lemon</option>
                <option value="lime">lime</option>
                <option value="ebony">ebony</option>
                <option value="smoke">smoke</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" for="title">Position:</label>
            <div class="col-md-5">
              <select id="notific8_pos_hor" class="form-control input-small input-inline">
                <option value="top">top (default)</option>
                <option value="bottom">bottom</option>
              </select>
              <select id="notific8_pos_ver" class="form-control input-small input-inline">
                <option value="right">right (default)</option>
                <option value="left">left</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" for="title"></label>
            <div class="col-md-5">
              <a class="submit btn green-meadow btn-lg" ajax-form="modalcontent" action="test/modelim" id="notific8_show">
                Show Notification! </a>
              <span id="modalcontentresult"></span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


