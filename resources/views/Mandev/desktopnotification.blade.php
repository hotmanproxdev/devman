<script>
  var notify = function () {
    // Check for notification compatibility.
    if (!'Notification' in window) {
      // If the browser version is unsupported, remain silent.
      return;
    }
    // Log current permission level
    console.log(Notification.permission);
    // If the user has not been asked to grant or deny notifications
    // from this domain...
    if (Notification.permission === 'default') {
      Notification.requestPermission(function () {
        // ...callback this function once a permission level has been set.
        notify();
      });
    }
    // If the user has granted permission for this domain to send notifications...
    else if (Notification.permission === 'granted') {
      var n = new Notification(
          '"{{$title}}"',
          {
            'body': '"{{$content}}"',
            // ...prevent duplicate notifications
            'tag' : 'unique string',
            'icon': '{{$baseUrl}}/upload/admin_profil_pictures/{{$photo}}'
          }
      );
      // Remove the notification from Notification Center when clicked.
      n.onclick = function () {
        this.close();
      };

      setTimeout(n.close.bind(n), 10000);
      // Callback function when the notification is closed.
      n.onclose = function () {
        console.log('Notification closed');
      };
    }
    // If the user does not want notifications to come from this domain...
    else if (Notification.permission === 'denied') {
      // ...remain silent.
      return;
    }
  };

notify();

</script>