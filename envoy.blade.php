@servers(['web' => '127.0.0.1:8070'])

@task('foo', ['on' => 'web'])
ls -la
@endtask