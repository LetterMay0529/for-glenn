
<h1></h2>
<button id="btn_haha">huhu</button>
<script>
        $('#btn_haha').on('click',function(){
            $.ajax({
                "url" : "https://api-m.sandbox.paypal.com/v1/billing/subscriptions/I-XJD470UUKVH3/transactions?start_time=2021-10-01T07:50:20.940Z&end_time=2021-10-30T07:50:20.940Z",
                "headers": {
                    "Authorization": "Bearer A21AAJtiPcuphu8w51JYeeSg9sSXJxVYNdIPyY7MfMC2JaNLbQ9jUIW4GNnUKymneTgbHZ2kfw6q7RVoBd0X83NXJxiUlzDsw"
                },
                "method" : "GET",
                "Content-Type": "application/json",
                "success": function(data){

                    console.log(data);

                    }	
            }); 
        });
</script>