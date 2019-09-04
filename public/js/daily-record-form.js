$(document).ready(function(){
    jQuery.noConflict($);
    // Start the save button click event
    $("#save").click(function(){

        const form = $("#daily-record-form");

        $.ajax(
            {
                url: form.attr('action'),
                type: "POST",
                data:form.serialize(),
                success:function(data){
                    console.log(data.success);
                    if (data.success === true)
                    {
                        $("#farmerRecordForm").modal('hide');
                    }

                },

            },

        );

    }); // End the save button click event
});
