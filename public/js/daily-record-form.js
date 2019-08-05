
$(document).ready(function(){
    // Start the save button click event
    $("#save").click(function(){
        const form = $("#daily-record-form");

        $.ajax(
            {
                url: form.attr('action'),
                method: "POST",
                dataType: 'application/json',
                data:form.serialize(),
                success:function(data){
                    if(data.status === 200)
                    {
                        console.log(data);
                        $("#farmerRecordForm").modal('hide');
                    }
                    else{
                        console.log(data);
                    }
                }

            },

        );

    }); // End the save button click event
});
