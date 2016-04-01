<!-- BEGIN SAMPLE TABLE PORTLET-->
<div class="portlet box purple">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-cogs"></i>{{$header}}
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
  <div class="portlet-body {{$name}}">
    <div class="table-scrollable">
      <table class="table table-striped table-bordered table-hover">

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
                  {{$wanted_fields[$val]}}
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
            {{--*/ $efield[$result->id]='' /*--}}

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
                  {{--*/ $efield[$result->id]='<a href="'.$baseUrl.'/'.strtolower(config("app.admin_dirname")).'/'.$fillIn['img']['link'][$result->id].'"><img src="'.$baseUrl.'/'.$fillIn['img']['path'].'/'.$fillIn['img'][$val][$result->id].'"
                   style="'.$fillIn['img']['style'].'"></a>' /*--}}
                    @else
                    {{--*/ $efield[$result->id]='<a><img src="'.$baseUrl.'/'.$fillIn['img']['path'].'/'.$fillIn['img'][$val][$result->id].'"
                   style="'.$fillIn['img']['style'].'"></a>' /*--}}
                    @endif
                @endif
              @endif
            @endif

            @if(count($wanted_fields))
              @if(array_key_exists($val,$wanted_fields))
                <td class="{{$ccss[$val]}}">
                  @if(in_array($val,$original))
                  {{$result->$val}}
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
    </div>
  </div>
</div>
<!-- END SAMPLE TABLE PORTLET-->