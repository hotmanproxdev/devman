<!-- BEGIN SAMPLE TABLE PORTLET-->
<div class="portlet box purple">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-cogs"></i>Horizontal Scrollable Responsive Table
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
                  {{--*/ $result->$val= $fillIn['matching'][$val][$result->$val] /*--}}
                @endif
              @endif
            @endif

            @if(count($wanted_fields))
              @if(array_key_exists($val,$wanted_fields))
                <td class="{{$ccss[$val]}}">
                  {{$result->$val}}
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