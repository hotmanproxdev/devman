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



        <form id="{{$name}}ajax" method="post">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="filter" value="{{$name}}">
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
                <a class="submitf btn green-meadow {{$class}}" pname="{{$name}}" file="{{$file[2]}}" ajax-form="{{$name}}ajax" action="{{$file[2]}}/tsqlfilter">{{$fval['default']}}</a>

              </div>

            @endif
          @endforeach
        @endif

        <div class="clear"></div>


          </form>



          @include(''.config("app.admin_dirname").'/tsql_table_main')











<!-- END SAMPLE TABLE PORTLET-->

<script>

  $(document).on("click","a.submitf",function(){

    var form=$(this).attr("ajax-form");

    var action=$(this).attr("action");

    var name=$(this).attr("pname");

    var file=$(this).attr("file");

    var loading='<img src="{{$baseUrl}}/reload.gif" width="32">';
    document.getElementById(""+name+"_table").innerHTML=loading;
    var data = new window.FormData($('form#'+form)[0]);
    $.ajax({
      url:action,
      type:"POST",
      data:data,
      cache: false,
      contentType : false,
      processData: false,
      success:function(data){
        $("div."+name+"_table").html(data);
        $("div#"+name+"_tsqlpagination").load(""+file+"?tsqlpage=1&pxname="+name);
      },
      error: function () {
        $("div."+name+"_table").html("<div style='padding:10px; color:#e20a16; font-weight:bold;'>Herhangi bir data bulunamadi</div>");
        $("div#"+name+"_tsqlpagination").html("");
      }
    });
  });

</script>
