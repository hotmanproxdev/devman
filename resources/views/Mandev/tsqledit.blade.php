
<div class="row">
  <div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet box yellow-crusta">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-gift"></i>Tsql Edit
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
      <div class="portlet-body form">
        <form id="{{$name}}" class="form-horizontal form-bordered" method="post">

          <input type="hidden" name="_token" value="{{csrf_token()}}">


          @foreach (\Session($name)['data']['original'] as $key=>$result)

            @if($result=="created_at" OR $result=="updated_at")
            {{--*/ $datetimepicker='datetimepicker' /*--}}
            @else
              {{--*/ $datetimepicker='' /*--}}
              @endif

            @foreach(\Session($name)['data']['query'] as $query)

              @if($query->id==\Input::get("id"))


                <!--out-->
                @if(array_key_exists("out",\Session($name)['data']['edit']) && !in_array($result,\Session($name)['data']['edit']['out']) &&
                (in_array($result,\Session($name)['data']['edit']['in']) OR count(\Session($name)['data']['edit']['in'])==0)


                )


          @if($result=="id")
                  <div class="form-group" style="display:none;">
            @else
                  <div class="form-group">
            @endif

                    @if(array_key_exists("header",\Session($name)['data']['edit']) && array_key_exists($result,\Session($name)['data']['edit']['header']))
                        <label class="col-sm-3 control-label">{{\Session($name)['data']['edit']['header'][$result]}}</label>
                    @else
                      <label class="col-sm-3 control-label">{{$result}}</label>
                      @endif
            <div class="col-sm-4">
              <div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-check"></i>
												</span>
                {{--*/ $cclass='' /*--}}
                {{--*/ $cclass2='' /*--}}
                {{--*/ $cclass3='' /*--}}
                {{--*/ $cclass4='' /*--}}


                @if(array_key_exists("changesql",\Session($name)['data']['edit']) && array_key_exists($result,\Session($name)['data']['edit']['changesql']))

                  {{--*/ $cclass='changesql' /*--}}
                  {{--*/ $cclass2='changesql='.\Session($name)['data']['edit']['changesql'][$result]['changesql'].'' /*--}}
                  {{--*/ $cclass3='changesqlresult='.\Session($name)['data']['edit']['changesql'][$result]['changesqlresult'].'' /*--}}
                @endif

                @if(array_key_exists("class",\Session($name)['data']['new']) && array_key_exists($result,\Session($name)['data']['new']['class']))

                  {{--*/ $cclass4=''.\Session($name)['data']['new']['class'][$result].'' /*--}}
                @endif

                @if(array_key_exists($result,\Session($name)['data']['edit']['select']) && !array_key_exists($result,\Session($name)['data']['fillIn']['matching']))

                  <select  name="{{$result}}" class="{{$result}} {{$cclass}} {{$cclass4}} form-control" {{$cclass2}} {{$cclass3}}   >

                <option value="{{$query->$result}}">{{\Session($name)['data']['edit']['select'][$result][$query->$result]}}</option>

                @foreach (\Session($name)['data']['edit']['select'][$result] as $a=>$b)

                    @if($a!==$query->$result)
                    <option value="{{$a}}">{{$b}}</option>
                    @endif


                    @endforeach


                  </select>

                  @elseif(array_key_exists($result,\Session($name)['data']['fillIn']['matching']))

                  <select name="{{$result}}" class="{{$result}} {{$cclass}} {{$cclass4}} form-control" {{$cclass2}} {{$cclass3}} >

                    <option value="{{array_search($query->$result,\Session($name)['data']['fillIn']['matching'][$result])}}">{{$query->$result}}</option>

                    @foreach (\Session($name)['data']['fillIn']['matching'][$result] as $a=>$b)

                      @if($a!==array_search($query->$result,\Session($name)['data']['fillIn']['matching'][$result]))
                        <option value="{{$a}}">{{$b}}</option>
                      @endif


                    @endforeach
                    </select>

                  @else

                  @if(array_key_exists("require",\Session($name)['data']['edit']))

                    @if(in_array($result,\Session($name)['data']['edit']['require']))

                      {{--*/ $require='' /*--}}
                      <input type="text"  name="{{$result}}" class="form-control {{$result}} {{$datetimepicker}} {{$cclass4}}" require="input-{{$result}}" value="{{$query->$result}}"/>
                      <span class="validation {{$result}}">* {{$validation_warning}}</span>
                    @else

                      {{--*/ $require='' /*--}}
                      <input type="text"  name="{{$result}}" class="form-control {{$datetimepicker}} {{$cclass4}}" value="{{$query->$result}}"/>

                    @endif
                  @else

                <input type="text"  name="{{$result}}" class="form-control {{$datetimepicker}} {{$cclass4}}" value="{{$query->$result}}"/>

                    @endif

                  @endif
              </div>

              @if(array_key_exists("explain",\Session($name)['data']['edit']) && array_key_exists($result,\Session($name)['data']['edit']['explain']) )
                <p class="help-block">
												<span class="label label-success label-sm">
												{{$explain}}: </span> &nbsp;
                  {{\Session($name)['data']['edit']['explain'][$result]}}
                </p>

              @endif

            </div>
          </div>

              <!--out end-->
              @endif


              @endif

            @endforeach

            @endforeach

          <div class="form-actions">
            <div class="row">
              <div class="col-md-offset-3 col-md-9">
                <a class="submit btn purple" ajax-form="{{$name}}" action="{{\Session($name)['data']['edit']['action']}}/edit{{\Session($name)['data']['edit']['action']}}"><i class="fa fa-check"></i>{{$save_changes}}</a>
                <span id="{{$name}}result"></span>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
    <!-- END PORTLET-->
  </div>