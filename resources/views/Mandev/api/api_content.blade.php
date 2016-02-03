@if($pageRole==false)
    @include("".config("app.admin_dirname").".noauth")
@else


test page
<div style="width:50%;">
<input class="form-control autocomplete" model="admin/fullname" context="input" autocomplete="off">
  <div class="autocomplete_result"></div>


  <select class="form-control select2me" data-placeholder="Select..."><option value=""></option><option value="AL">Alabama</option><option value="WY">Wyoming</option>\n
  </select>

  <input class="datetimepicker">

</div>
<a class="btn default xmodal" model="api/test" modal-title="test modal page" data-target="#full-width" href="#full-width" data-toggle="modal">View Demo </a>

@endif