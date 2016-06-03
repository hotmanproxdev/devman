<div id="test"></div>
<div class="row">
  <div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet box yellow-crusta">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-gift"></i>{{\Session($name)['data']['new']['name']}}
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
                @if(array_key_exists("out",\Session($name)['data']['new']) && !in_array($result,\Session($name)['data']['new']['out']) &&
                (in_array($result,\Session($name)['data']['new']['in']) OR count(\Session($name)['data']['new']['in'])==0)


                )



                  @if($result=="id")

                    <div class="form-group" style="display:none;">
                      @else
                        <div class="form-group">
                          @endif


                          @if(array_key_exists("header",\Session($name)['data']['new']) && array_key_exists($result,\Session($name)['data']['new']['header']))
                            <label class="col-sm-3 control-label">{{\Session($name)['data']['new']['header'][$result]}}</label>
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


                              @if(array_key_exists("changesql",\Session($name)['data']['new']) && array_key_exists($result,\Session($name)['data']['new']['changesql']))

                                {{--*/ $cclass='changesql' /*--}}
                                {{--*/ $cclass2='changesql='.\Session($name)['data']['new']['changesql'][$result]['changesql'].'' /*--}}
                                {{--*/ $cclass3='changesqlresult='.\Session($name)['data']['new']['changesql'][$result]['changesqlresult'].'' /*--}}
                                @endif


                              @if(array_key_exists("class",\Session($name)['data']['new']) && array_key_exists($result,\Session($name)['data']['new']['class']))

                                {{--*/ $cclass4=''.\Session($name)['data']['new']['class'][$result].'' /*--}}
                              @endif

                              @if(array_key_exists($result,\Session($name)['data']['new']['select']) && !array_key_exists($result,\Session($name)['data']['fillIn']['matching']))

                                <select  name="{{$result}}" class="{{$result}} {{$cclass}} {{$cclass4}} form-control" {{$cclass2}} {{$cclass3}}   >


                                  @foreach (\Session($name)['data']['new']['select'][$result] as $a=>$b)


                                      <option value="{{$a}}">{{$b}}</option>



                                  @endforeach


                                </select>

                              @elseif(array_key_exists("matching",\Session($name)['data']['fillIn']) && array_key_exists($result,\Session($name)['data']['fillIn']['matching']))

                                <select name="{{$result}}" class="{{$result}} {{$cclass}} {{$cclass4}} form-control" {{$cclass2}} {{$cclass3}} >


                                  @foreach (\Session($name)['data']['fillIn']['matching'][$result] as $a=>$b)


                                      <option value="{{$a}}">{{$b}}</option>



                                  @endforeach
                                </select>

                              @else


                                @if(array_key_exists("default",\Session($name)['data']['new']))

                                  @if(array_key_exists($result,\Session($name)['data']['new']['default']))
                                    {{--*/ $value=\Session($name)['data']['new']['default'][$result] /*--}}

                                    @else
                                    {{--*/ $value='' /*--}}
                                    @endif

                                  @else

                                  {{--*/ $require='' /*--}}

                                  @endif

                                @if(array_key_exists("require",\Session($name)['data']['new']))

                                  @if(in_array($result,\Session($name)['data']['new']['require']))

                                    {{--*/ $require='' /*--}}
                                    <input type="text"  name="{{$result}}" class="form-control {{$result}} {{$datetimepicker}} {{$cclass4}}" require="input-{{$result}}" value="{{$value}}"/>
                                    <span class="validation {{$result}}">* {{$validation_warning}}</span>
                                    @else

                                    {{--*/ $require='' /*--}}
                                    <input type="text"  name="{{$result}}" class="form-control {{$datetimepicker}} {{$cclass4}}" value="{{$value}}"/>

                                    @endif
                                  @else

                                  {{--*/ $require='' /*--}}
                                  <input type="text"  name="{{$result}}" class="form-control {{$datetimepicker}} {{$cclass4}}" value="{{$value}}"/>

                                  @endif


                              @endif
                            </div>

                            @if(array_key_exists("explain",\Session($name)['data']['new']) && array_key_exists($result,\Session($name)['data']['new']['explain']) )
                            <p class="help-block">
												<span class="label label-success label-sm">
												{{$explain}}: </span> &nbsp;
                              {{\Session($name)['data']['new']['explain'][$result]}}
                            </p>

                              @endif
                          </div>
                        </div>

                        <!--out end-->
                      @endif


                      @endif

                      @endforeach




                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <a class="submit btn purple" ajax-form="{{$name}}" action="{{\Session($name)['data']['new']['action']}}/{{$name}}new"><i class="fa fa-check"></i>{{$save_changes}}</a>
                            <span id="{{$name}}result"></span>
                          </div>
                        </div>
                      </div>

            <br><br><br>
        </form>

      </div>
    </div>
    <!-- END PORTLET-->
  </div>