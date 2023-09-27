/*
 * VALIDATION
 */
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

$(document).ready(function () {
    /*
     * SHOW ADD DETAILS SECTION ON ADD BUTTON CLICK
     */
    $(".add_details_btn").click(function () {
        $(".details_list_table").slideUp();
        $("#add_details_section").removeClass('d-none');
        $("#add_details_section").slideDown();
        $('#add_details_form')[0].reset();
        $('#add_details_form #id').val('');
        $("#news_featured_image").html('');
    });

    /*
     * HIDE ADD DETAILS SECTION
     */
    $(".form_close_btn").click(function () {
        $(".details_list_table").slideDown();
        $("#add_details_section").addClass('d-none');
        $("#add_details_section").slideUp();
    })

    /*
     * DISPLAY DATATABLE
     */
    $('.table_datatable').DataTable();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

/*
 * DELETE RECORDS FROM DB
 */
function delete_records(ID, AJAX_URL) {
    $(".confirmDialogMessage").text('Do you want to delete this record?');
    $("#confirmationModal").modal().one('click', '#confirmOk', function (e) {
        $("#loader").removeClass('d-none');
        $.ajax({
            url: AJAX_URL,
            type: "DELETE",
            success: function (res) {
                $("#loader").addClass('d-none');
                if (res.success) {
                    $("#row_" + ID).remove();
                    $("#confirmationModal").modal("hide");
                    $("#successModal").modal();
                    $("#successModal .modal-body .msg").text(res.message);
                } else {
                    $("#errorModal").modal();
                    $("#errorModal .modal-body .msg").text(res.message);
                }
            }
        });
    }).one('click', '#confirmCancel', function (e) {
        $("#confirmationModal").modal('hide')
    });
}