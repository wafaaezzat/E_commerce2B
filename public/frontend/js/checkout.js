$(document).ready(function(){
   $('.Razorpay_btn').click(function (e){
      e.preventDefault();

       var firstname = $('.firstname').val();
       var lastname  = $('.lastname').val();
       var email     = $('.email').val();
       var phone     = $('.phone').val();
       var address   = $('.address').val();

       if(!firstname)
       {
           fname_error = 'Firstname Name is required';
           $('#fname_error').html(fname_error);
       }
       else
       {
           $('#fname_error').html();
       }

       if(!lastname)
       {
           lname_error = 'Lastname Name is required';
           $('#lname_error').html(lname_error);
       }
       else
       {
           $('#lname_error').html();
       }

       if(!email)
       {
           email_error = 'Email is required';
           $('#email_error').html(email_error);
       }
       else
       {
           $('#email_error').html();
       }

       if(!phone)
       {
           phone_error = 'Phone is required';
           $('#phone_error').html(phone_error);
       }
       else
       {
           $('#phone_error').html();
       }

       if(!address)
       {
           address_error = 'Address is required';
           $('#address_error').html(address_error);
       }
       else
       {
           $('#address_error').html();
       }

 if(fname_error !== '' || lname_error !== '' || email_error !== '' ||
      phone_error !== '' || address_error !== '' )
    {

        var data = {
            'firstname' : firstname,
            'lastname'  : lastname,
            'email'     : email,
            'phone'     : phone,
            'address'  : address,
        }

        var APP_URL2 = localStorage.getItem('APP_URL'); // get app url from storage to work on js file
        var CallbackUrl = APP_URL2+'proceed-to-pay';

        $.ajax({
            method: "POST",
            url: CallbackUrl,
            data: data,
            success: function (response) {

                var options = {
                    "key": "rzp_test_EcefOJQmB4FWmx", // Enter the Key ID generated from the Dashboard
                     //"amount": response.total_price * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "INR",
                    "name": response.firstname + '' + response.lastname,
                    "description": "Thank you for use us",
                    "image": "https://example.com/your_logo",
                    "handler": function (responsea){
                         // alert(responsea.razorpay_payment_id);

                        var APP_URL2 = localStorage.getItem('APP_URL'); // get app url from storage to work on js file
                        var CallbackUrl = APP_URL2+'place-order';

                        $.ajax({
                            method: "POST",
                            url: CallbackUrl,
                            data: {
                                'fname': response.firstname,
                                // 'fname' => it came from [$request->fname;] in function (PlaceOrder) in CheckOutController.php
                                'lname': response.lastname,
                                'email': response.email,
                                'phoneNumber': response.phone,
                                'address': response.address,
                                'payment_mode': 'Paid by Razorpay',
                                'payment_id': responsea.razorpay_payment_id,
                            },
                            success: function (response) {
                                window.location.reload();
                                 // alert(response.status);

                                window.location.href = localStorage.getItem('APP_URL')+'my-order';
                                return response;
                            }
                        });
                    },
                    "prefill": {
                        "name": response.firstname + '' + response.lastname,
                        "email": response.email,
                        "contact": response.phone
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp1 = new Razorpay(options);
                    rzp1.open();

            }
        });
    }
else
    {

        return false;
    }

   });
});
