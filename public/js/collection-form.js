$(document).ready(function(){
    /*
    * Based on Collection Type Selection
    * */
    $(".bank").hide();
    $("#collection_type").change(function(){
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
    * Based od Payee Type Selection
    * */
    $(".company").hide();
    $(".farmer").hide();
    $(".staff").hide();
    $("#collect_type").change(function () {
        let collect = $(this).val();
        switch (collect) {
            case 'authority':
                $(".company").hide();
                $(".farmer").hide();
                $(".staff").hide();
                break;

            case 'company':
                $(".company").show('slow');
                $(".farmer").hide();
                $(".staff").hide();
                break;
            case 'staff':
                $(".company").hide();
                $(".farmer").hide();
                $(".staff").show('slow');
                break;
            case 'farmer':
                $(".company").hide();
                $(".farmer").show('slow');
                $(".staff").hide();
                break;
            default:
                $(".company").hide();
                $(".farmer").hide();
                $(".staff").hide();
                break;
        }

    })


});
