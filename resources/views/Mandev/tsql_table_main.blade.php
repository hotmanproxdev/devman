
<div id="{{$name}}_table" class="table-scrollable {{$name}}_table" style="">

  @section("tsqltable_".$name."")
<table class="table table-striped table-bordered table-hover {{$name}}">

  <thead>
  <tr>
    @foreach ($fields as $val)

      {{--*/ $fcss[$val]='' /*--}}

      @if(count($fieldCss))
        @if(array_key_exists("all",$fieldCss))
          {{--*/ $fcss[$val]=$fieldCss['all'] /*--}}
        @endif

        @if(array_key_exists($val,$fieldCss))
          {{--*/ $fcss[$val]=$fieldCss[$val] /*--}}
        @endif
      @endif


      @if(count($wanted_fields))
        @if(array_key_exists($val,$wanted_fields))
          <th scope="col" class="{{$fcss[$val]}}">
            @if(count($fillIn))
              @if(array_key_exists("input",$fillIn))
                @if(array_key_exists($val,$fillIn['input']))
                  @if($fillIn['input'][$val]=="checkbox")
                    <input type="checkbox" class="signall" name="{{$name}}">
                    @else
                    {{$wanted_fields[$val]}}
                    @endif
                @else
                  {{$wanted_fields[$val]}}
                @endif
              @else
                {{$wanted_fields[$val]}}
              @endif

              @else
              {{$wanted_fields[$val]}}
              @endif
          </th>
        @endif
      @else
        <th scope="col" style="">
          {{$val}}
        </th>
      @endif
    @endforeach
  </tr>
  </thead>
  <tbody>
  @foreach($query as $result)
    <tr>
      @foreach($fields as $val)

        {{--*/ $ccss[$val]='' /*--}}
        @if(property_exists($result,$val))
        {{--*/ $efield[$result->id]=$result->$val /*--}}
        @endif

        @if(count($contentCss))
          @if(array_key_exists("all",$contentCss))
            {{--*/ $ccss[$val]=$contentCss['all'] /*--}}
          @endif

          @if(array_key_exists($val,$contentCss))
            {{--*/ $ccss[$val]=$contentCss[$val] /*--}}
          @endif
        @endif

        @if(count($fillIn))
          @if(array_key_exists("matching",$fillIn))

            @if(array_key_exists($val,$fillIn['matching']))
              @if(array_key_exists($result->$val,$fillIn['matching'][$val]))
                {{--*/ $result->$val= $fillIn['matching'][$val][$result->$val] /*--}}
              @endif
            @endif
          @endif
        @endif



        @if(count($fillIn))
          @if(array_key_exists("img",$fillIn))
            @if(array_key_exists($val,$fillIn['img']))
              @if(array_key_exists("link",$fillIn['img']))
                {{--*/ $efield[$result->id]='<a target="_blank" href="'.$baseUrl.'/'.strtolower(config("app.admin_dirname")).'/'.$fillIn['img']['link'][$result->id].'"><img src="'.$baseUrl.'/'.$fillIn['img']['path'].'/'.$fillIn['img'][$val][$result->id].'"
                 style="'.$fillIn['img']['style'].'"></a>' /*--}}
              @else
                {{--*/ $efield[$result->id]='<a><img src="'.$baseUrl.'/'.$fillIn['img']['path'].'/'.$fillIn['img'][$val][$result->id].'"
               style="'.$fillIn['img']['style'].'"></a>' /*--}}
              @endif
            @endif
          @endif
        @endif


        @if(count($fillIn))
          @if(array_key_exists("input",$fillIn))
            @if(array_key_exists($val,$fillIn['input']))
              @if($fillIn['input'][$val]=="checkbox")
                {{--*/ $efield[$result->id]='<input type="'.$fillIn['input'][$val].'" name="'.$val.'[]" value="'.$result->id.'" class="'.$name.'_sign" style="width:100%; height:100%;">' /*--}}
                @else
                {{--*/ $efield[$result->id]='<input type="'.$fillIn['input'][$val].'" name="'.$val.'[]" value="'.$result->id.'" class="form-control">' /*--}}
                @endif

            @endif
          @endif
        @endif


        @if(count($fillIn))
          @if(array_key_exists("icon",$fillIn))
            @if(array_key_exists($val,$fillIn['icon']))

              @if(array_key_exists("modal",$fillIn))
                @if(array_key_exists($val,$fillIn['modal']))
                {{--*/ $efield[$result->id]='<a class="xmodal" model="'.$baseUrl.'/'.strtolower(config("app.admin_dirname")).'/'.$fillIn['modal'][$val]['action'].'?modalId='.$result->id.'"
                modal-title="'.$fillIn['modal'][$val]['title'].'" data-target="#full-width" href="#full-width" data-toggle="modal">
                <img src="'.$baseUrl.'/'.$fillIn['icon'][$val].'" width="20" height="20" style="cursor:pointer;"></a>' /*--}}
                  @else
                  {{--*/ $efield[$result->id]='<img src="'.$baseUrl.'/'.$fillIn['icon'][$val].'" width="20" height="20" style="cursor:pointer;">' /*--}}
                  @endif
                @else
                {{--*/ $efield[$result->id]='<img src="'.$baseUrl.'/'.$fillIn['icon'][$val].'" width="20" height="20" style="cursor:pointer;">' /*--}}

                @endif

            @endif
          @endif
        @endif

      @if(count($wanted_fields))
          @if(array_key_exists($val,$wanted_fields))
            <td class="{{$ccss[$val]}}">
              @if(in_array($val,$original))

                @if(array_key_exists("modal",$fillIn))

                  @if(array_key_exists($val,$fillIn['modal']))
                    <a class="xmodal" model="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/{{$fillIn['modal'][$val]['action']}}?modalId={{$result->id}}"
                    modal-title="{{$fillIn['modal'][$val]['title']}}" data-target="#full-width" href="#full-width" data-toggle="modal"> {{$result->$val}}</a>

                    @else

                    @if(array_key_exists("link",$fillIn))
                      @if(array_key_exists($val,$fillIn['link']))
                        <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/{{$fillIn['link'][$val]}}" target="_blank">
                          {{$result->$val}}
                          </a>
                        @else
                        {{$result->$val}}
                        @endif
                      @else
                    {{$result->$val}}
                      @endif


                    @endif

                @else
                {{$result->$val}}

                @endif
              @else
                {!! $efield[$result->id] !!}
              @endif
            </td>
          @endif
        @else
          <td>
            {{$result->$val}}
          </td>
        @endif
      @endforeach

    </tr>
  @endforeach

  </tbody>
</table>
  @show

</div>


<div id="procaction_{{$name}}">
@if(count($filter))

  @foreach ($filter as $fval)

    @if($fval['type']=='action')

      @if($fval['status'])
        <div style="margin:10px 0 0 0;">
          <div class="divlay" style="width:20%;">
            <select name="{{$name}}signprocess" class="indent form-control label label-success {{$fval['class']}}">
              <option value="none">{{$fval['default']}}</option>
              @foreach ($fval['data'] as $d=>$dd)
                <option value="{{$d}}">{{$dd}}</option>
              @endforeach
            </select>
            </select>
          </div>

          <div class="divlay" style="width:10%;">
            <a class="submit form-control btn blue" ajax-form="{{$name}}_table_process" action="{{$file[2]}}/{{$fval['action']}}">{{$lang['execute']}}</a>
          </div>

          <div class="divlay" style="width:20%;">
            <span id="{{$name}}_table_processresult"></span>
          </div>

          <div class="clear"></div>

        </div>

      @endif

    @endif

  @endforeach

@endif

</div>



<div id="{{$name}}_tsqlpagination">
  @section("tsqlpagination_".$name."")
    @include(''.config("app.admin_dirname").'/tsql_table_main_pagination')
  @show
</div>





