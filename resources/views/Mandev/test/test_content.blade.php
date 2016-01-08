@if($pageRole==false)
    @include("".config("app.admin_dirname").".noauth")
@else


<form id="test" method="post">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <input type="text" name="date" class="datetimepicker">
  <input type="text" name="username" value="">
  <a class="submit btn btn-danger" ajax-form="test" action="test">Tikla</a>
  <span id="testresult"></span>
</form>

@endif