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



      <div style="">

        <form id="{{$name}}ajax" method="post">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="filter">
        @if(count($filter))

          {{--*/ $w=100/count($filter) /*--}}
          {{--*/ $f=0 /*--}}

          @foreach ($filter as $fval)

            {{--*/ $ff=$f++ /*--}}

            @if($ff==count($filter)-1 OR count($filter)==1)
              {{--*/ $indent='' /*--}}
            @else
              {{--*/ $indent='indent' /*--}}
            @endif

            @if(array_key_exists("class",$fval))

              {{--*/ $class=$fval['class'] /*--}}
            @else
              {{--*/ $class='' /*--}}
            @endif

            @if($fval['type']=="select")

              <div class="divlay" style="width:{{$w}}%;">
                <select class="{{$indent}} form-control {{$class}}" name="{{$fval['name']}}">
                  @foreach ($fval['default'] as $dkey=>$dval)
                    <option value="{{$dkey}}">{{$dval}}</option>
                  @endforeach

                  @if(is_callable($fval['data']))

                    {{--*/ $call=call_user_func($fval['data']) /*--}}

                    @foreach ($call as $ckey=>$cval)
                      <option value="{{$ckey}}">{{$cval}}</option>
                    @endforeach

                  @else


                    @if(count($fval['data']))

                      @foreach ($fval['data'] as $dkey=>$dval)
                        <option value="{{$dkey}}">{{$dval}}</option>
                      @endforeach
                    @endif

                  @endif
                </select>

              </div>

            @endif



            @if($fval['type']=="text")

              <div class="divlay" style="width:{{$w}}%;">
                <input type="text" class="{{$indent}} form-control {{$class}}" name="{{$fval['name']}}" placeholder="{{$fval['default']}}">

              </div>

            @endif


            @if($fval['type']=="button")

              <div class="divlay" style="width:{{$w}}%;">
                <a class="submitf btn green-meadow {{$class}}" ajax-form="{{$name}}ajax" action="{{$file[2]}}/{{$name}}filter">{{$fval['default']}}</a>

              </div>

            @endif
          @endforeach
        @endif

        <div class="clear"></div>


          </form>



          @include(''.config("app.admin_dirname").'/tsql_table_main')











<!-- END SAMPLE TABLE PORTLET-->


  <script>
    $(document).on("click","td.page-ajax-passive",function(){

      var name=$(this).attr("name");
      var no=$(this).attr("no");
      var limitview=$(this).attr("limitview");
      var count=$(this).attr("count");


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


      if(parseInt(no)<parseInt(count))
      {
        $("table."+name+" td.next-page-ajax").show();
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
      var count=$(this).attr("count");


      if(parseInt(no)>=parseInt(count))
      {
        $("table."+name+" td.next-page-ajax").hide();
      }

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
      var count=$(this).attr("count");


      if(no==1)
      {
        $("table."+name+" td.prev-page-ajax").hide();
      }

      if(parseInt(no)<parseInt(count))
      {
        $("table."+name+" td.next-page-ajax").show();
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



    $(document).on("click","a.submitf",function(){

      var form=$(this).attr("ajax-form");

      var action=$(this).attr("action");

      var loading='<img src="{{$baseUrl}}/reload.gif" width="32">';
      document.getElementById("{{$name}}_table").innerHTML=loading;
      var data = new window.FormData($('form#'+form)[0]);
      $.ajax({
        url:action,
        type:"POST",
        data:data,
        cache: false,
        contentType : false,
        processData: false,
        success:function(data){
          $("div.{{$name}}_table").html(data);
          $("div#{{$name}}_tsqlpagination").load("{{$file[2]}}?tsqlpage=1");
        },
        error: function () {
          $("div.{{$name}}_table").html("<div style='padding:10px; color:#e20a16; font-weight:bold;'>Herhangi bir data bulunamadi</div>");
          $("div#{{$name}}_tsqlpagination").html("");
        }
      });
    });
  </script>