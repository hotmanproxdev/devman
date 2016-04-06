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
  <div class="portlet-body">
    <div class="table-scrollable {{$name}}_table">

      @include(''.config("app.admin_dirname").'/tsql_table_main')

    </div>

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

                            <td class="page-ajax prev-page-ajax {{$name}}_prevajax" name="{{$name}}" prevno="0" limitview="{{$pagination['limitview']}}"  style="padding: 10px; border:1px solid #ccc; background-color:#f4f4f4; font-weight:bold; display:none">
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

                            <td id="page-ajax-active_{{$i}}" class="{{$class}}" name="{{$name}}" no="{{$i}}" limitview="{{$pagination['limitview']}}" style="border:1px solid #ccc;">
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


                          <td class="page-ajax next-page-ajax {{$name}}_nextajax" name="{{$name}}" nextno="2" limitview="{{$pagination['limitview']}}"  style="padding: 10px; border:1px solid #ccc; background-color :#ddd; font-weight:bold; cursor:pointer;">
                            <a style="text-decoration:none; font-weight:bold;">
                              >> İleri
                            </a>
                          </td>
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
<!-- END SAMPLE TABLE PORTLET-->


  <script>
    $(document).on("click","td.page-ajax-passive",function(){

      var name=$(this).attr("name");
      var no=$(this).attr("no");
      var limitview=$(this).attr("limitview");


      if(no>1)
      {
        $("table."+name+" td.prev-page-ajax").show();
      }

      if(no==1)
      {
        $("table."+name+" td.prev-page-ajax").hide();

      }

      if(no<=limitview)
      {
        $("table."+name+" td.oajax").hide();

        $(".ajaxPageFull2").addClass("ajaxPageFull");
        $(".ajaxPageFull2").removeClass("ajaxPageFull2");
      }


      var next=parseInt(no)+parseInt(1);
      var prev=parseInt(no)-parseInt(1);

      $("table."+name+" td.page-ajax-active").addClass("page-ajax-passive");
      $("table."+name+" td.page-ajax-active").removeClass("page-ajax-active");

      $(this).addClass("page-ajax-active");
      $(this).removeClass("page-ajax-passive");

      $("table."+name+" td."+name+"_nextajax").attr("nextno",next);
      $("table."+name+" td."+name+"_prevajax").attr("prevno",prev);

      $("."+name+"_table").load("{{$file[2]}}?page="+no);

    });


    $(document).on("click","td.next-page-ajax",function(){

      var name=$(this).attr("name");
      var no=$(this).attr("nextno");
      var limitview=$(this).attr("limitview");

      if(no>1)
      {
        $("table."+name+" td.prev-page-ajax").show();
      }

      if(parseInt(no)>parseInt(limitview))
      {

        $(".ajaxPageFull").addClass("ajaxPageFull2");
        $(".ajaxPageFull").removeClass("ajaxPageFull");

        $("table."+name+" td.oajax").show();
        $("span#"+name+"_oajax").html(no);
      }

      var next=parseInt(no)+parseInt(1);
      var prev=parseInt(no)-parseInt(1);

      $("table."+name+" td.page-ajax-active").addClass("page-ajax-passive");
      $("table."+name+" td.page-ajax-active").removeClass("page-ajax-active");

      $("table."+name+" td#page-ajax-active_"+no).addClass("page-ajax-active");
      $("table."+name+" td#page-ajax-active_"+no).removeClass("page-ajax-passive");

      $("table."+name+" td."+name+"_nextajax").attr("nextno",parseInt(next));
      $("table."+name+" td."+name+"_prevajax").attr("prevno",parseInt(prev));

      $("."+name+"_table").load("{{$file[2]}}?page="+no);

    });


    $(document).on("click","td.prev-page-ajax",function(){

      var name=$(this).attr("name");
      var no=$(this).attr("prevno");
      var limitview=$(this).attr("limitview");

      if(no==1)
      {
        $("table."+name+" td.prev-page-ajax").hide();
      }


      if(parseInt(no)<=parseInt(limitview))
      {
        $(".ajaxPageFull2").addClass("ajaxPageFull");
        $(".ajaxPageFull2").removeClass("ajaxPageFull2");
        $("table."+name+" td.oajax").hide();
      }


      if(parseInt(no)>parseInt(limitview))
      {
        $("table."+name+" td.oajax").show();
        $("span#"+name+"_oajax").html(no);
      }

      var next=parseInt(no)+parseInt(1);
      var prev=parseInt(no)-parseInt(1);

      $("table."+name+" td.page-ajax-active").addClass("page-ajax-passive");
      $("table."+name+" td.page-ajax-active").removeClass("page-ajax-active");

      $("table."+name+" td#page-ajax-active_"+no).addClass("page-ajax-active");
      $("table."+name+" td#page-ajax-active_"+no).removeClass("page-ajax-passive");

      $("table."+name+" td."+name+"_nextajax").attr("nextno",next);
      $("table."+name+" td."+name+"_prevajax").attr("prevno",prev);

      $("."+name+"_table").load("{{$file[2]}}?page="+no);

    });
  </script>