@if($pageRole==false)
    @include("".config("app.admin_dirname").".noauth")
@else

  <a class="btn default xmodal" model="logs/modal" modal-title="test modal page" href="#full-width" data-toggle="modal">View Demo </a>




  <div class="row">
    <div class="col-md-12">
      <div class="note note-bordered note-success">
        <p>
         {{$logdatainfo}}.

        </p>

      </div>
    </div>
  </div>


  <!-- BEGIN SAMPLE TABLE PORTLET-->
  <div class="portlet box purple">
    <div class="portlet-title">
      <div class="caption">
        <i class="fa fa-cogs"></i>{{$logtab}}
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
      <div class="table-scrollable">
        <table class="table table-striped table-bordered table-hover">
          <thead>
          <tr>
            @foreach (app()->make("Base")->getField($logs) as $field)
              <th scope="col" style="width:450px !important">
                @if($field=="userid")
                  Username
                @else
                  {{ucfirst($field)}}
                @endif
              </th>
            @endforeach

          </tr>
          </thead>
          <tbody>
          @foreach ($logs as $result)
            <tr>
              @foreach (app()->make("Base")->getField($logs) as $field)
                <td>
                  @if($field=="query_json" OR $field=="user_agent" OR $field=="msg" OR $field=="postdata")
                    <div title="{{$result->$field}}">{{ substr($result->$field,0,10) }}</div>
                  @else
                    @if($field=="created_at")
                      <b>{{date("Y-m-d H:i:s",$result->$field)}}</b>
                    @else
                      @if($field=="userid" and $result->userid>0)
                        <span style="color:#336699; font-weight:bold;">{{app()->make("Base")->getUsers($result->$field,"username")[0]->username}}</span>
                      @else
                        @if($field=="ccode" and $result->userid>0)
                          <span style="color:#e20a16; font-weight:bold;">{{app()->make("Base")->getUsers($result->userid,"ccode")[0]->ccode}}</span>
                        @else
                          {{$result->$field}}
                        @endif
                      @endif
                    @endif
                  @endif
                </td>
              @endforeach

            </tr>
          @endforeach

          </tbody>
        </table>


      </div>

      <div style="margin:5px 0 0 5px;">
        {{$total}} : <b> {{$logs->total()}} </b> {{$data_exists}}.
      </div>

      <div style="margin:5px 0 0 5px;">
        {!! $logs->render() !!}
      </div>


      <!--statistic-->
      <div style="margin:5px 0 0 0;">

        <div class="row">
          <div class="col-md-12">
            <div class="note note-bordered note-success">
              <p>
                {{$logdatastatisticsinfo}}.

              </p>

            </div>
          </div>
        </div>


        <div id="charts">
          <div id="chart_column1" style="height: 600px; width: 100%;"></div>

        </div>


      </div>
      <!--statistic end-->

    </div>


  </div>
  <!-- END SAMPLE TABLE PORTLET-->


@endif