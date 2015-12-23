


  @include("".config("app.admin_dirname").".prepared.stats")
  <div class="clearfix"></div>
  <div class="row">



    @include("".config("app.admin_dirname").".prepared.chart1")

    @include("".config("app.admin_dirname").".prepared.chart2")



  </div>
  <div class="clearfix"></div>


  <div class="row">


    @include("".config("app.admin_dirname").".prepared.activities")
    @include("".config("app.admin_dirname").".prepared.tasks")


  </div>
  <div class="clearfix"></div>


  <div class="row">
    @include("".config("app.admin_dirname").".prepared.roundstats")
    @include("".config("app.admin_dirname").".prepared.serverstats")
  </div>

  <div class="clearfix"></div>


  <div class="row">
    @include("".config("app.admin_dirname").".prepared.regionalstats")
    @include("".config("app.admin_dirname").".prepared.feedstats")

  </div>
  <div class="clearfix"></div>


  <div class="row">
    @include("".config("app.admin_dirname").".prepared.calendar")
    @include("".config("app.admin_dirname").".prepared.chat")
  </div>

