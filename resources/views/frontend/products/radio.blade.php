

<div class="col-md-1 mb-3 ml-2">
    <label> Mid </label>
    <input type="radio" name="Medium" id="Medium" onclick="radiobuttons('1');">
</div>
<div class="col-md-1 mb-3 ml-2">
    <label> Large </label>
    <input type="radio" name="Large" id="Large" onclick="radiobuttons('2');">
</div>
<div class="col-md-1 mb-3 ml-2">
    <label> XL </label>
    <input type="radio" name="XL" id="XL" checked onclick="radiobuttons('3');">
</div>
<div class="col-md-1 mb-3 ml-2">
    <label> 2XL </label>
    <input type="radio" name="XXL" id="XXL" onclick="radiobuttons('4');">
</div>
<div class="col-md-1 mb-3 ml-2">
    <label> 3XL </label>
    <input type="radio" name="XXXL" id="XXXL" onclick="radiobuttons('5');">
</div>


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
                document.getElementById('XXL').checked=false;
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
</script>
