$(document).ready(function(){
    /*
    * Based on Payment Type Selection
    * */
    $(".bank").hide();
    $("#payment_type").change(function(){
        var bank = $(this).val();
        if(bank == 'cash')
        {
            $(".bank").hide('slow');
        }

        if(bank == 'bank' || bank == 'bkash' || bank == 'rocket' || bank == 'check')
        {
            $(".bank").show('slow');
        }
    });

    /*
    * Based on Payee Type Selection
    * */
    $(".company").hide();
    $(".farmer").hide();
    $(".staff").hide();
    $("#payee_type").change(function () {
        let payee = $(this).val();
        if (payee === 'authority') {
            $("#staff").val('');
            $("#farmer").val('');
            $("#company").val('');
            $(".company").hide();
            $(".farmer").hide();
            $(".staff").hide();
        } else if (payee === 'company') {
            $("#staff").val('');
            $("#farmer").val('');
            $(".company").show('slow');
            $(".farmer").hide();
            $(".staff").hide();
        } else if (payee === 'staff') {
            $("#farmer").val('');
            $("#company").val('');
            $(".company").hide();
            $(".farmer").hide();
            $(".staff").show('slow');
        } else if (payee === 'farmer') {
            $("#staff").val('');
            $("#company").val('');
            $(".company").hide();
            $(".farmer").show('slow');
            $(".staff").hide();
        } else {
            $(".company").hide();
            $(".farmer").hide();
            $(".staff").hide();
        }

    })


});
