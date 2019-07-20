$(document).ready(function(){
    $(".bank").hide();
    $("#payment_type").change(function(){
        var bank = $(this).val();
        if(bank == 'cash')
        {
            $(".bank").hide('slow');
        }

        if(bank == 'bank' || bank == 'bkash')
        {
            $(".bank").show('slow');
        }
    });
});
