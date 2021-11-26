

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<div class="container mt-5">
    <div class="col-md-6">
<form>
 <div class="form-group">
 <input type="text" name="name" id="name" placeholder="Enter Your Name" class="form-control"> 
 </div>
 <div class="form-group"> 
 <input type="text" name="amount" id="amt" placeholder="Enter Amount" class="form-control"> 
 </div>
 <div class="form-group">
 <button type="button" class="btn btn-primary" id="btn" onclick="pay_now()">Pay Now</button> 
</div>
</form>
</div>
</div>
<script type="text/javascript">
    function pay_now(){
        var name = jQuery('#name').val();
        var amt = jQuery('#amt').val();

          jQuery.ajax({
                        type:'post',
                        url:'payment_process.php',
                        data:"&amt="+amt+"&name="+name,
                        success:function(result){
                               var options = {
                                        "key": "rzp_test_YoUgBj3b8SCfWC",
                                        "amount": amt*100,
                                        "currency": "INR",
                                        "name": "Frank Corp",
                                        "description": "Test Transaction",
                                        "image": "images/logo.jpg",
                                        "handler": function (response){

                                            jQuery.ajax({
                                                type:'post',
                                                url:'payment_process.php',
                                                data:"payment_id="+response.razorpay_payment_id,
                                                success:function(result){
                                                    window.location.href="thank_you.php";
                                                }
                                            });

                                        }
                                    };
                                    var rzp1 = new Razorpay(options);
                                 
                                    rzp1.open();
                                }
                    });
            
        }
</script>

