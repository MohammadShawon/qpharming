$(document).ready(function(){
    /*
    * Based on Collection Type Selection
    * */
    $(".bank").hide();
    $("#collection_type").change(function(){
        let bank = $(this).val();
        if(bank === 'cash')
        {
            $(".bank").hide('slow');
        }

        if(bank === 'bank' || bank === 'bkash' || bank === 'rocket' || bank === 'check')
        {
            $(".bank").show('slow');
        }
    });

    /*
    * Based od Payee Type Selection
    * */
    // $(".company").hide();
    // $(".farmer").hide();
    // $(".staff").hide();
    // $("#collect_type").change(function () {
    //     let collect = $(this).val();
    //     if (collect === 'authority') {
    //         $(".company").hide();
    //         $(".farmer").hide();
    //         $(".staff").hide();
    //     } else if (collect === 'company') {
    //         $(".company").show('slow');
    //         $(".farmer").hide();
    //         $(".staff").hide();
    //     } else if (collect === 'staff') {
    //         $(".company").hide();
    //         $(".farmer").hide();
    //         $(".staff").show('slow');
    //     } else if (collect === 'farmer') {
    //         $(".company").hide();
    //         $(".farmer").show('slow');
    //         $(".staff").hide();
    //     } else {
    //         $(".company").hide();
    //         $(".farmer").hide();
    //         $(".staff").hide();
    //     }
    //
    // })
    $("#farmer").hide();
    $("#collect_type").change(function () {
       let type = $(this).val();
       if (type === 'farmer')
       {
           $("#farmer").show();
       }else if(type === 'egg') {
            $("#farmer").hide();
       }else if(type === 'hen') {
           $("#farmer").hide();
       }else if(type === 'other') {
           $("#farmer").hide();
       }
    });


});
