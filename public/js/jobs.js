$(document).ready(function () {
    $('.selectpicker').selectpicker();
    /*
     * SHOW UPDATE DETAILS FORM
     */
    $(".update_details_btn").click(function () { 
        var ID = $(this).attr('id');
        $("#loader").removeClass('d-none');
        $.ajax({
            url: "jobs/" + ID,
            type: "get",
            success: function (res) {
                $("#loader").addClass('d-none');
                if (res.success) {
                    $("#id").val(ID);
                    $("#title").val(res.data.title);
                    $("#description").val(res.data.description);
                    tinyMCE.activeEditor.setContent(res.data.description);
                    if (res.data.file_path != null) {
                        var extension = (window.location.origin + '/storage/' + res.data.file_path).split('.').pop().toLowerCase();
                        var file_icon = '';
                        if(extension == 'pdf') {
                            file_icon = '<img src="' + window.location.origin + '/images/pdf.png" width="100">';
                        } else if(extension == 'docx') {
                            file_icon = '<img src="' + window.location.origin + '/images/docx.png" width="100">';
                        }
                        $("#jobs_file_path").attr('href','/storage/' + res.data.file_path);
                        $("#jobs_file_path").html(file_icon);
                    } else {
                        $("#jobs_file_path").attr('href','javascript;');
                        $("#jobs_file_path").html('');
                    }
                    
                    var job_types = [];
                    $.each(res.data.job_types,function(i,e){
                        job_types.push(e.id);
                        $("#job_types option[value='" + e.id + "']").prop("selected", true);
                    });
                    
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
        delete_records(ID, "jobs/" + ID);
    });


})
