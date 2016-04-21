
<!--pagination start-->
<div class="{{$name}}_pagination">
  @if($pagination['status'])


    @if($pagination['type']=="normal")

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


                    <td class="nextclass" style="padding: 10px; border:1px solid #ccc; background-color :#ddd; font-weight:bold; cursor:pointer;">
                      <a href="?page={{$nextPage}}" style="text-decoration:none; font-weight:bold;">
                        >> İleri
                      </a>
                    </td>
                  </tr>
                </table>

              </div>
            </div>


          @endif








          @if($pagination['type']=="ajax")

            {{--*/ $pageNum=ceil($query->total()/$query->perPage()) /*--}}


            @if(!array_key_exists("page",\Input::all()))
              {{--*/ $currentPage=1 /*--}}
              {{--*/ $nextPage=2 /*--}}
            @else
              {{--*/ $currentPage=\Input::get("page") /*--}}
              {{--*/ $nextPage=\Input::get("page")+1 /*--}}
            @endif



            <div style="border:0px;" id="{{$name}}_fullajax" class="ajaxPageFull">


              <div class="table-scrollable" style="border:0px;">
                <table class="table table-striped table-bordered table-hover {{$name}}" style="border:0px;">

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



                    {{--*/ $prevPage=\Input::get("page")-1 /*--}}

                    <td class="page-ajax prev-page-ajax {{$name}}_prevajax" name="{{$name}}" prevno="0" limitview="{{$pagination['limitview']}}" count="{{$query->lastPage()}}" file="{{$file}}"  style="padding: 10px; border:1px solid #ccc; background-color:#f4f4f4; font-weight:bold; display:none">
                      <a style="text-decoration:none; color:#e20a16;  font-weight:bold;">
                        << Geri
                      </a>
                    </td>



                    @for($i=1; $i<=$limitview; $i++)

                      @if($i==1)
                        {{--*/ $class='page-ajax-active' /*--}}
                      @else
                        {{--*/ $class='page-ajax-passive' /*--}}
                      @endif

                      <td id="page-ajax-active_{{$i}}" class="{{$class}}" name="{{$name}}" no="{{$i}}" limitview="{{$pagination['limitview']}}" file="{{$file}}"  count="{{$query->lastPage()}}" style="border:1px solid #ccc;">
                        <a style="text-decoration:none; font-weight:bold;">
                          {{$i}}
                        </a>
                      </td>

                    @endfor



                    <td class="oajax" style="padding:10px; border-top:0px; background-color:#fff; display:none;">
                      ...
                    </td>
                    <td class="oajax oajaxi" style="padding: 10px; border:1px solid #ccc; background-color:#ffdd88; font-weight:bold; cursor:pointer; display:none;">
                      <span id="{{$name}}_oajax"></span>.Sayfadasınız
                    </td>

                    <td class="oajax" style="padding: 10px; border-top:0px; background-color:#fff; display:none;">
                      ...
                    </td>


                    <td style="padding: 10px; border:1px solid #ccc; background-color :#fff; cursor:pointer;">
                      Toplam : <span style="color: #e20a16; font-weight: bold;">{{$query->lastPage()}} Sayfa </span> ... <b>{{$query->total()}}</b> Kayıt
                    </td>

                    @if($pageNum>1)
                      <td class="page-ajax next-page-ajax {{$name}}_nextajax" name="{{$name}}" nextno="2" limitview="{{$pagination['limitview']}}"
                          count="{{$query->lastPage()}}" file="{{$file}}"  style="padding: 10px; border:1px solid #ccc; background-color :#ddd; font-weight:bold; cursor:pointer;">
                        <a style="text-decoration:none; font-weight:bold;">
                          >> İleri
                        </a>
                      </td>

                    @endif
                  </tr>
                </table>

              </div>
            </div>


          @endif



          @endif
        </div>



</div>
<!--pagination finish-->
</div>