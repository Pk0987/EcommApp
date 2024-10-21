<script>
    function deleteCatagory(ev){
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        // console.log(urlToRedirect);
        swal({
            title: "Are you sure want to delete the catagory",
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
