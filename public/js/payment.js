$(document).ready(function () {
    
    $(document).on("click","#proceedBtn",function () {
        $("#payment_details").slideUp();
        $("#proceed_msg").slideDown();
        $("#proceed_msg").removeClass('d-none');
    });

    $(document).on("click","#skipBtn",function () {
        $("#payment_details").slideUp();
        $("#skip_msg").slideDown();
        $("#skip_msg").removeClass('d-none');
    });


    

})
