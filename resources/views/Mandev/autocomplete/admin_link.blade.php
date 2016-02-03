
 <div style="background-color: #fff; border:1px solid #ccc; padding:10px;">
@foreach ($query as $result)
  <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/profile/{{$result->id}}">
  <div class="compval" no="{{$result->id}}" style="float:left;cursor:pointer;"><img src="{{$baseUrl}}/{{config("app.admin_profil_path")}}/{{$result->photo}}" class="img-responsive" alt="" style="width:40px; height:40px;"/></div>
  <div style="float:left; margin:0 0 0 5px; font-weight:bold; cursor:pointer;">
    <div class="compval text_{{$result->id}}" no="{{$result->id}}">{{$result->fullname}}</div>
    <div class="compval" no="{{$result->id}}" style="color:#336699; font-size:12px;">{{$result->system_name}}</div>
  </div>
  <div style="clear:both;"></div>
    </a>
  <hr>
  @endforeach
  </div>

