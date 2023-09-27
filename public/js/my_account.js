$(document).ready(function () {
    $('.selectpicker').selectpicker();
    $(".update_profile").click(function () {
        $(".profile_text").slideUp();
        $("#add_profile_details_section").removeClass('d-none');
        $("#add_profile_details_section").slideDown();
    });

    var max_fields = 10;
    var x = $(".qualificaion_row").length + 1;
    $("#add_qualification_fields").click(function () {
        var dataHtml = '<div class="row qualificaion_row">';
        dataHtml += '<div class="col-md-4">';
        dataHtml += '<div class="form-group">';        
        
        dataHtml += '<label>Course Name</label>';
        dataHtml += '<input type="text" name="qualification[' + x + '][course_name]" value="" class="form-control form-control-sm">';
        dataHtml += '</div>';
        
        dataHtml += '</div>';
        dataHtml += '<div class="col-md-5">';
        dataHtml += '<div class="form-group">';
        dataHtml += '<label>Institute Name</label>';
        dataHtml += '<input type="text" name="qualification[' + x + '][institute_name]" value="" class="form-control form-control-sm">';
        dataHtml += '</div>';
        dataHtml += '</div>';
        dataHtml += '<div class="col-md-2">';
        dataHtml += '<div class="form-group">';
        dataHtml += '<label>Year</label>';
        dataHtml += '<select name="qualification[' + x + '][qualification_year]" class="custom-select custom-select-sm">';
        dataHtml += '<option value="">Select Year</option>';
        var d = new Date();
        for (var i = d.getFullYear() - 50; i <= d.getFullYear(); i++) {
            dataHtml += '<option value="' + i + '">' + i + '</option>';
        }
        dataHtml += '</select>';
        dataHtml += '</div>';
        dataHtml += '</div>';
        dataHtml += '<div class="col-md-1">';
        dataHtml += '<div class="form-group mt-4">';
        dataHtml += '<label>&nbsp;</label>';
        dataHtml += '<a href="javascript:;" class="remove_qual"><i class="fas fa-trash"></i></a>';
        dataHtml += '<div>';
        dataHtml += '<div>';


        if (x < max_fields) {
            x++;
            $("#more_quali_fields").append(dataHtml);
        }


    });


});

$(document).on("click", ".remove_qual", function (e) { 
    e.preventDefault();
    $(this).closest('div.row').remove();   
})