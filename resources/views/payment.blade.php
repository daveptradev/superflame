<!DOCTYPE html>
<html>
<head>
  <title>Payment</title>

  <script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>

<body style="background:black; color:white; display:flex; justify-content:center; align-items:center; height:100vh;">

  <script>
  window.onload = function () {
    snap.pay('{{ $snapToken }}', {

      onSuccess: function(result){
        window.location.href = "/payment/success";
      },

      onPending: function(result){
        alert("Waiting payment...");
      },

      onError: function(result){
        alert("Payment failed!");
      },

      onClose: function(){
        // kalau user tutup popup
        window.location.href = "/checkout";
      }

    });
  };
</script>

</body>
</html>