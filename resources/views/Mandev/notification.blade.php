
<script src="{{$baseUrl}}/metron/theme/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script>

  var UIToastr = function () {
    return {
//main function to initiate the module
      init: function () {

        var i = -1,
            toastCount = 0,
            $toastlast,
            getMessage = function () {
              var msgs = [];
              i++;
              if (i === msgs.length) {
                i = 0;
              }

              return msgs[i];
            };


        var shortCutFunction ='{{$function}}';
        var msg = '{{$msg}}';
        var title = '{{$title}}';
        var $showDuration = $('#showDuration');
        var $hideDuration = $('#hideDuration');
        var $timeOut = $('#timeOut');
        var $extendedTimeOut = $('#extendedTimeOut');
        var $showEasing = $('#showEasing');
        var $hideEasing = $('#hideEasing');
        var $showMethod = $('#showMethod');
        var $hideMethod = $('#hideMethod');
        var toastIndex = toastCount++;

        toastr.options = {
          "closeButton": true,
          "debug": false,
          "positionClass": "toast-{{$position}}",
          "onclick": null,
          "showDuration": "1000",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        };

        var $toast = toastr[shortCutFunction](msg, title);


      }

    };

  }();

  UIToastr.init();


</script>