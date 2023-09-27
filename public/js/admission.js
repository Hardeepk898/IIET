$(document).ready(function () {
    var maxField = 10; //Input fields increment limitation
    var addButton = $('#add_quali'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var x = 1; //Initial field counter is 1
    var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html 
    var fieldHTML = '<div class="card">';
    fieldHTML += '<div class="card-body">';
    fieldHTML += '<div class="row form-group">';
    fieldHTML += '<div class="col-md-6">';
    fieldHTML += '<label>Examination <span class="text-danger">*</span></label>';
    fieldHTML += '<input type="text" name="education[' + x + '][examination]" class="form-control" required>';
    fieldHTML += '</div>';
    fieldHTML += '<div class="col-md-6">';
    fieldHTML += '<label>Board/University <span class="text-danger">*</span></label>';
    fieldHTML += '<input type="text" name="education[' + x + '][university]" class="form-control" required>';
    fieldHTML += '</div>';
    fieldHTML += '</div>';
    fieldHTML += '<div class="row form-group">';
    fieldHTML += '<div class="col-md-4">';
    fieldHTML += '<label>Year of Passing <span class="text-danger">*</span></label>';
    fieldHTML += '<input type="text" name="education[' + x + '][passing_year]" class="form-control" required>';
    fieldHTML += '</div>';
    fieldHTML += '<div class="col-md-4">';
    fieldHTML += '<label>Total <span class="text-danger">*</span></label>';
    fieldHTML += '<input type="text" name="education[' + x + '][total_marks]" class="form-control" required>';
    fieldHTML += '</div>';
    fieldHTML += '<div class="col-md-4">';
    fieldHTML += '<label>Percentage <span class="text-danger">*</span></label>';
    fieldHTML += '<input type="text" name="education[' + x + '][percentage_marks]" class="form-control" required>';
    fieldHTML += '</div>';
    fieldHTML += '</div>';
    fieldHTML += '<a href="javascript:;" class="remove_button btn btn-danger btn-sm">Remove</a>';
    fieldHTML += '</div>';
    fieldHTML += '</div>';
    

    //Once add button is clicked
    $(addButton).click(function () {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function (e) {
        e.preventDefault();
        $(this).parent().parent(".card").remove(); //Remove field html
        x--; //Decrement field counter
    });
    
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        endDate : new Date()
    });
});
