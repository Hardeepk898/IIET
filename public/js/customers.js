$(document).ready(function () {
    /*
     * SHOW UPDATE DETAILS FORM
     */
    $(document).on("click", ".mark_payment", function () {
        var ID = $(this).attr('id');
        $("#cust_id").val(ID);
        $("#confirmationModal").modal();
        $("#confirmationModal .confirmDialogMessage").text('Do you want to change the payment status?');
    });


    $("#confirmOk").click(function () {
        $("#loader").removeClass('d-none');
        $("#confirmationModal").modal('hide');
        var cust_id = $("#cust_id").val();
        $.ajax({
            url: "/payment",
            type: "post",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify({ id: cust_id, payment_status: 1 }),
            success: function (res) {
                $("#loader").addClass('d-none');
                if (res.success) {
                    $('#status_' + cust_id).html('<span class="badge badge-success">Active</span>');
                    $('#payment_status_' + cust_id).html('<span class="badge badge-info">Payment done</span>');
                    $("#successModal").modal();
                    $("#successModal .modal-body .msg").text(res.message);
                } else {
                    $("#errorModal").modal();
                    $("#errorModal .modal-body .msg").text(res.message);
                }
            }
        });
    });

    $("#confirmCancel").click(function () {
        $("#confirmationModal").modal('hide');
    });


    /*
     * SHOW UPDATE DETAILS FORM
     */
    $(".update_details_btn").click(function () {
        var ID = $(this).attr('id');
        $("#loader").removeClass('d-none');
        $.ajax({
            url: "/admin/customers/" + ID,
            type: "get",
            success: function (res) {
                $("#loader").addClass('d-none');
                if (res.success) {
                    $("#id").val(ID);
                    $("#firstname").val(res.data.firstname);
                    $("#lastname").val(res.data.lastname);
                    $("#phone").val(res.data.phone);
                    if (res.data.file_path != null) {
                        var extension = (window.location.origin + '/storage/' + res.data.file_path).split('.').pop().toLowerCase();
                        var file_icon = '';
                        if (extension == 'pdf') {
                            file_icon = '<img src="' + window.location.origin + '/images/pdf.png" width="100">';
                        } else if (extension == 'docx') {
                            file_icon = '<img src="' + window.location.origin + '/images/docx.png" width="100">';
                        }
                        $("#cv_file_path").attr('href', '/storage/' + res.data.file_path);
                        $("#cv_file_path").html(file_icon);
                    } else {
                        $("#cv_file_path").attr('href', 'javascript;');
                        $("#cv_file_path").html('');
                    }
                    $("#phone").val(res.data.phone);

                    if (res.data.qualificaion) {
                        $.each(res.data.qualificaion, function (i, e) {
                            var Qual = '<div class="row qualificaion_row">';
                            Qual += '<div class="col-md-4">';
                            Qual += '<div class="form-group">';
                            Qual += '<label>Course Name</label>';
                            Qual += '<input type="text" name="qualification[' + i + '][course_name]" value="' + e.course_name + '" class="form-control form-control-sm">';
                            Qual += '</div>';
                            Qual += '</div>';
                            Qual += '<div class="col-md-5">';
                            Qual += '<div class="form-group">';
                            Qual += '<label>Institute Name</label>';
                            Qual += '<input type="text" name="qualification[' + i + '][institute_name]" value="' + e.institute_name + '" class="form-control form-control-sm">';
                            Qual += '</div>';
                            Qual += '</div>';
                            Qual += '<div class="col-md-2">';
                            Qual += '<div class="form-group">';
                            Qual += '<label>Year</label>';
                            Qual += '<select name="qualification[' + i + '][qualification_year]" class="custom-select custom-select-sm" autocomplete="off">';
                            Qual += '<option value="">Select Year</option>';
                            for (var d = date("Y", strtotime("-50 year")); d <= date("Y"); d++) {
                                Qual += '<option value="' + d + '" ' + ((e.qualification_year == d) ? "selected" : "") + '>' + d + '</option>';
                            }
                            Qual += '</select>';
                            Qual += '</div>';
                            Qual += '</div>';
                            Qual += '<div class="col-md-1">';
                            if (i + 1 > 1) {
                                Qual += '<div class="form-group mt-4">';
                                Qual += '<label>&nbsp;</label>';
                                Qual += '<a href="javascript:;" class="remove_qual"><i class="fas fa-trash"></i></a>';
                                Qual += '</div>';
                            }
                            Qual += '</div>';
                            Qual += '</div>';
                        });
                        $("#qualifications").html(Qual);                        
                    }
                    $("#comments").val(res.data.comments);
                    $("#area_of_expertise").val(res.data.AreaOfExpertise);

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
        delete_records(ID, "jobs/" + ID);
    });


})
