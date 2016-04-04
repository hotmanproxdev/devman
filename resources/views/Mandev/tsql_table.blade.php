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

    <!--pagination start-->
    <div class="{{$name}}_pagination">
      @if($pagination['status'])

        {{--*/ $pageNum=ceil($query->total()/$query->perPage()) /*--}}


        @if(!array_key_exists("page",\Input::all()))
          {{--*/ $currentPage=1 /*--}}
          {{--*/ $nextPage=2 /*--}}
        @else
          {{--*/ $currentPage=\Input::get("page") /*--}}
          {{--*/ $nextPage=\Input::get("page")+1 /*--}}
        @endif


      @if($currentPage>$pagination['limitview'])
          <div style="width:100%; border:0px;">
        @else
          <div class="xtable">
        @endif

          <div class="table-scrollable" style="border:0px;">
            <table class="table table-striped table-bordered table-hover" style="border:0px;">

              <tr>
                <td style="padding: 10px; border:1px solid #ccc; font-weight:bold;">
                  @if(array_key_exists("header",$pagination))
                    {{$pagination['header']}}
                  @else
                    Pages
                  @endif
                </td>

                @if(array_key_exists("limitview",$pagination))
                  {{--*/ $limitview=$pagination['limitview'] /*--}}

                  @if($pageNum<$limitview)
                    {{--*/ $limitview=$pageNum /*--}}
                  @endif

                @else
                  {{--*/ $limitview=5 /*--}}

                  @if($pageNum<$limitview)
                    {{--*/ $limitview=$pageNum /*--}}
                  @endif

                @endif


                @if($currentPage>1)

                  {{--*/ $prevPage=\Input::get("page")-1 /*--}}

                  <td style="padding: 10px; border:1px solid #ccc; background-color:#f4f4f4; font-weight:bold;">
                    <a href="?page={{$prevPage}}" style="text-decoration:none; color:#e20a16;  font-weight:bold;">
                      << Geri
                    </a>
                  </td>

                @endif

                @for($i=1; $i<=$limitview; $i++)

                  @if($i==$currentPage)
                    {{--*/ $backgroundColor='#e2e2e2;' /*--}}
                  @else
                    {{--*/ $backgroundColor='#fff;' /*--}}
                  @endif

                  <td style="padding: 10px; border:1px solid #ccc; background-color : {{$backgroundColor}}  cursor:pointer;">
                    <a href="?page={{$i}}" style="text-decoration:none; font-weight:bold;">
                      {{$i}}
                    </a>
                  </td>

                @endfor

                @if($currentPage>$pagination['limitview'])
                  <td style="padding:10px; border-top:0px; background-color:#fff;">
                    ...
                  </td>
                  <td style="padding: 10px; border:1px solid #ccc; background-color:#ffdd88; font-weight:bold; cursor:pointer;">
                    {{$currentPage}}.Sayfadasınız
                  </td>

                  <td style="padding: 10px; border-top:0px; background-color:#fff;">
                    ...
                  </td>
                @endif

                <td style="padding: 10px; border:1px solid #ccc; background-color :#fff; cursor:pointer;">
                  Toplam : <span style="color: #e20a16; font-weight: bold;">{{$query->lastPage()}} Sayfa </span> ... <b>{{$query->total()}}</b> Kayıt
                </td>


                <td style="padding: 10px; border:1px solid #ccc; background-color :#ddd; font-weight:bold; cursor:pointer;">
                  <a href="?page={{$nextPage}}" style="text-decoration:none; font-weight:bold;">
                    >> İleri
                  </a>
                </td>
              </tr>
            </table>

          </div>
        </div>


      @endif
    </div>
    <!--pagination finish-->


  </div>
</div>
<!-- END SAMPLE TABLE PORTLET-->