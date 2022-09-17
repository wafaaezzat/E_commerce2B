
$(document).ready(function() {


// Increment Quantity Value
        $(document).on('click' , '.increment-btn' , function (e){

            e.preventDefault();

        var increment_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(increment_value, 10); // 10 => اكبر قيمه هيزود لغايه م يوصلها
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

// Decerment Quantity Value
        $(document).on('click' , '.decrement-btn' , function (e){

            e.preventDefault();

        var decrement_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(decrement_value, 10); // 10 => اكبر قيمه هينقص من عندها
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;

            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

//    Notification on Cart icons
    loadCart();  // بنادي عالفانكشن هنا

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function loadCart(){

        var APP_URL2 = localStorage.getItem('APP_URL'); // get app url from storage to work on js file
        var CallbackUrl = APP_URL2+'load-cart-data';

        $.ajax({
            method: "GET",
            url: CallbackUrl,

            success: function (response) {
                // $('.cart-count').html('');
                $('.cart-count').html(response.count);
                // window.location.reload();
                // return response;
            }

        });
    }


//  Add To Cart
        $(document).on('click' , '.AddToCartBtn' , function (e){

            e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_quantity = $(this).closest('.product_data').find('.qty-input').val();
            var size = $(this).closest('.product_data').find('.size').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            var APP_URL2 = localStorage.getItem('APP_URL'); // get app url from storage to work on js file
            var CallbackUrl = APP_URL2+'add-to-cart';

        $.ajax({
            method: "POST",
            url: CallbackUrl,
            data: {
                "product_id": product_id,
                "product_quantity": product_quantity,
                "size": size,
            },
            dataType: "",
            success: function (response) {
                window.location.reload();
                return response;
            }
        });
    });


// delete Cart Item
        $(document).on('click' , '.delete-cart-item' , function (e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();

        $.ajax({
            method: "POST",
            url: "delete-cart-item",
            data: {
                "prod_id": prod_id,
            },
            success: function (response) {
                // window.location.reload();  // reload all page
                loadCart(); // to update cart icon automatically
                $('.cartitems').load(location.href + " .cartitems"); // reload only this div
                return response;
            }
        });

    });


// change quantity product Item (update cart)
    $(document).on('click' , '.changeQuantity' , function (e){

        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();
        var qty = $(this).closest('.product_data').find('.qty-input').val();

        $.ajax({
            method: "POST",
            url: "update-cart-items",
            data: {
                "prod_id": prod_id,
                "qty" : qty,
            },
            success: function (response) {
                // window.location.reload(); // reload all page
                $('.cartitems').load(location.href + " .cartitems"); // reload only this div
                return response;
            }
        });

    });


});
