$(document).ready(function () {
    
    /*
     * SHOW UPDATE DETAILS FORM
     */
    $(".update_details_btn").click(function () { 
        var ID = $(this).attr('id');
        $("#loader").removeClass('d-none');
        $.ajax({
            url: "job_types/" + ID,
            type: "get",
            success: function (res) {
                $("#loader").addClass('d-none');
                if (res.success) {
                    $("#id").val(ID);
                    $("#job_type").val(res.data.job_type);
                    $("#status").val(res.data.status);

                    $(".details_list_table").slideUp();
                    $("#add_details_section").removeClass('d-none');
                    $("#add_details_section").slideDown();
                } else {
                    $("#errorModal").modal();
                    $("#errorModal .modal-body .msg").text(res.message);
                }
            }
        });
    });

    /*
     * DELETE USER DETAILS
     */
    $(".delete_details").click(function () {
        var ID = $(this).attr('id');
        delete_records(ID, "job_types/" + ID);
    });


})
