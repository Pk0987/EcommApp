<script>
    function confirmation(ev){
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        // console.log(urlToRedirect);
        swal({
            title: "Are you sure want to cancel the product",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true
        })
        .then((willCancel)=>{
            if(willCancel){
                window.location.href = urlToRedirect;
            }
        });
    }

    function cashondelivery(ev){
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        // console.log(urlToRedirect);
        swal({
            title: "Are you sure want to buy cash on delivery",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true
        })
        .then((willCancel)=>{
            if(willCancel){
                window.location.href = urlToRedirect;
            }
        });
    }

  </script>
