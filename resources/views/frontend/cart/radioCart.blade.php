@foreach($cartItems as $cartItem)
    <div class="row">

        <div class="col-md-1 mb-3 ml-2">
            <label> Mid </label>
            <input type="radio" name="Medium" id="Medium"
                   {{$cartItem->Medium == '1' ? 'checked' : ''}} onclick="radiobuttons('1');">
        </div>

        <div class="col-md-1 mb-3 ml-2">
            <label> L </label>
            <input type="radio" name="Large" id="Large"
                   {{$cartItem->Large == '1' ? 'checked' : ''}} onclick="radiobuttons('2');">
        </div>

        <div class="col-md-1 mb-3 ml-2">
            <label> XL </label>
            <input type="radio" name="XL" id="XL"
                   {{$cartItem->XL == '1' ? 'checked' : ''}} onclick="radiobuttons('3');">
        </div>

        <div class="col-md-1 mb-3 ml-2">
            <label> 2XL </label>
            <input type="radio" name="XXL" id="XXL"
                   {{$cartItem->XXL == '1' ? 'checked' : ''}} onclick="radiobuttons('4');">
        </div>


        <div class="col-md-1 mb-3 ml-2">
            <label> 3XL </label>
            <input type="radio" name="XXXL" id="XXXL"
                   {{$cartItem->XXXL == '1' ? 'checked' : ''}} onclick="radiobuttons('5');">
        </div>
    </div>
@endforeach

<script language="javascript" type="text/javascript">

    function radiobuttons(checked)
    {
        switch(checked)
        {
            case '1': document.getElementById('Medium').checked=true;
                document.getElementById('Large').checked=false;
                document.getElementById('XL').checked=false;
                document.getElementById('XXL').checked=false;
                document.getElementById('XXXL').checked=false;
                break;
            case '2': document.getElementById('Large').checked=true;
                document.getElementById('Medium').checked=false;
                document.getElementById('XL').checked=false;
                document.getElementById('XXL').checked=false;
                document.getElementById('XXXL').checked=false;
                break;
            case '3': document.getElementById('XL').checked=true;
                document.getElementById('Medium').checked=false;
                document.getElementById('Large').checked=false;
                document.getElementById('2XL').checked=false;
                document.getElementById('XXXL').checked=false;
                break;
            case '4': document.getElementById('XXL').checked=true;
                document.getElementById('Medium').checked=false;
                document.getElementById('Large').checked=false;
                document.getElementById('XL').checked=false;
                document.getElementById('XXXL').checked=false;
                break;
            case '5': document.getElementById('XXXL').checked=true;
                document.getElementById('Medium').checked=false;
                document.getElementById('Large').checked=false;
                document.getElementById('XL').checked=false;
                document.getElementById('XXL').checked=false;
                break;

            default: alert(checked);
                break;
        }
    }
</script><?php
