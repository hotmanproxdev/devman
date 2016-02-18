<form action="test/foo" method="post">
  <input  type="hidden" name="_token" value="{{csrf_token()}}">
  <input type="text" name="bar">
  <input type="submit" name="gonder" value="gonder">
</form>