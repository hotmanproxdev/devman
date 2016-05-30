
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


          @if(count(\Session($name)['data']['original']))

            {{--*/ $original=\Session($name)['data']['original'] /*--}}
            @else

            {{--*/ $original=\Schema::getColumnListing(app()->make("Base")->dbTable([$name])); /*--}}

            @endif



          @foreach ($original as $key=>$result)

            @if($result=="created_at" OR $result=="updated_at")
              {{--*/ $datetimepicker='datetimepicker' /*--}}
            @else
              {{--*/ $datetimepicker='' /*--}}
            @endif



              @if(true)

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


                              @if(array_key_exists($result,\Session($name)['data']['edit']['select']) && !array_key_exists($result,\Session($name)['data']['fillIn']['matching']))

                                <select  name="{{$result}}" class="form-control">


                                  @foreach (\Session($name)['data']['edit']['select'][$result] as $a=>$b)


                                      <option value="{{$a}}">{{$b}}</option>



                                  @endforeach


                                </select>

                              @elseif(array_key_exists("matching",\Session($name)['data']['fillIn']) && array_key_exists($result,\Session($name)['data']['fillIn']['matching']))

                                <select name="{{$result}}" class="form-control">


                                  @foreach (\Session($name)['data']['fillIn']['matching'][$result] as $a=>$b)


                                      <option value="{{$a}}">{{$b}}</option>



                                  @endforeach
                                </select>

                              @else

                                @if(array_key_exists("require",\Session($name)['data']['edit']))

                                  @if(in_array($result,\Session($name)['data']['edit']['require']))

                                    {{--*/ $require='' /*--}}
                                    <input type="text"  name="{{$result}}" class="form-control {{$result}} {{$datetimepicker}}" require="input-{{$result}}" value=""/>
                                    <span class="validation {{$result}}">* {{$validation_warning}}</span>
                                    @else

                                    {{--*/ $require='' /*--}}
                                    <input type="text"  name="{{$result}}" class="form-control {{$datetimepicker}}" value=""/>

                                    @endif
                                  @else

                                  {{--*/ $require='' /*--}}
                                  <input type="text"  name="{{$result}}" class="form-control {{$datetimepicker}}" value=""/>

                                  @endif


                              @endif
                            </div>

                          </div>
                        </div>

                        <!--out end-->
                      @endif


                      @endif

                      @endforeach




                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <a class="submit btn purple" ajax-form="{{$name}}" action="{{\Session($name)['data']['edit']['action']}}/{{$name}}new"><i class="fa fa-check"></i>{{$save_changes}}</a>
                            <span id="{{$name}}result"></span>
                          </div>
                        </div>
                      </div>
        </form>

      </div>
    </div>
    <!-- END PORTLET-->
  </div>