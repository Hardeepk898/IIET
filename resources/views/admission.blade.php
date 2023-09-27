@extends('layout')

@section('title', 'Private Job Recruitment Cell - Admission')

@section('content')
<div class="card jobs">
    <div class="card-header"><h3>Admission</h3></div>
    <div class="card-body">
        <form class="needs-validation" action="/admission" method="post" novalidate>
            @csrf
            <h4><b>Personal Details</b></h4>
            <div class="row form-group">
                <div class="col-md-6">
                    <label>First Name <span class="text-danger">*</span></label>
                    <input type="text" name="firstname" class="form-control" required>
                    <div class="invalid-feedback">
                        First name is required.
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Last Name</label>
                    <input type="text" name="lastname" class="form-control">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Contact Number <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control" required>
                    <div class="invalid-feedback">
                        Contact number is required.
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label>DOB</label>
                    <input type="text" name="dob" class="form-control datepicker" autocomplete="off">
                </div>
                <div class="col-md-6">
                    <label>Guardian's Name</label>
                    <input type="text" name="guardian_name" class="form-control">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label>Religion</label>
                    <input type="text" name="religion" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Gender</label><br><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="1">
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="2">
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>
            </div>
            <h4 class="mt-3"><b>Address Details</b></h4>
            <div class="row form-group">
                <div class="col-md-6">
                    <label>Address 1</label>
                    <input type="text" name="address1" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Address 2</label>
                    <input type="text" name="address2" class="form-control">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label>City</label>
                    <input type="text" name="city" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>State</label>
                    <input type="text" name="state" class="form-control">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label>Country</label>
                    <input type="text" name="country" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Postcode</label>
                    <input type="text" name="postcode" class="form-control">
                </div>
            </div>
            <h4 class="mt-3"><b>Job Details</b></h4>
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="job_types">Job Types</label>
                        <select name="job_types[]" id="job_types" class="form-control custom-select selectpicker" data-actions-box="true" data-live-search="true" data-selected-text-format="count > 2" title="Job Types" data-select-all-text="Select All" data-deselect-all-text="Deselect All" multiple required>
                            @foreach($job_types as $type)
                            <option value="{{ $type->id }}">{{ $type->job_type }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select job type.
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="mt-3"><b>Course Details</b></h4>
            <div class="row form-group">
                <div class="col-md-6">
                    <label>Course <span class="text-danger">*</span></label>
                    <input type="text" name="course" class="form-control" required>
                    <div class="invalid-feedback">
                        Please enter the name of course.
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Center <span class="text-danger">*</span></label>
                    <input type="text" name="center" class="form-control" required>
                    <div class="invalid-feedback">
                        Please enter the name of center.
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <label>Category</label><br><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="category" name="category" value="1">
                        <label class="form-check-label" for="cat1">Gen</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="category" name="category" value="2">
                        <label class="form-check-label" for="cat2">SC</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="category" name="category" value="3">
                        <label class="form-check-label" for="cat3">ST</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="category" name="category" value="4">
                        <label class="form-check-label" for="cat4">OBC</label>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label>School Name</label>
                    <input type="text" name="school_name" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Class</label>
                    <input type="text" name="class" class="form-control">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <label>Last Academic Qualification <a href="javascript:;" id="add_quali" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add</a></label>
                    <div class="field_wrapper">
                        <div class="card">
                            <div class="card-body">
                                <div class="row form-group">
                                    <div class="col-md-6">                            
                                        <label>Examination <span class="text-danger">*</span></label>
                                        <input type="text" name="education[0][examination]" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Please enter the name of examination.
                                        </div>
                                    </div>
                                    <div class="col-md-6">                            
                                        <label>Board/University <span class="text-danger">*</span></label>
                                        <input type="text" name="education[0][university]" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Board/University name is required.
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4">                            
                                        <label>Year of Passing <span class="text-danger">*</span></label>
                                        <input type="text" name="education[0][passing_year]" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Year of passing is required.
                                        </div>
                                    </div>
                                    <div class="col-md-4">                            
                                        <label>Total <span class="text-danger">*</span></label>
                                        <input type="text" name="education[0][total_marks]" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Please enter your total marks.
                                        </div>
                                    </div>
                                    <div class="col-md-4">                            
                                        <label>Percentage <span class="text-danger">*</span></label>
                                        <input type="text" name="education[0][percentage_marks]" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Please enter the percentage.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm">
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<link rel="stylesheet" href="{{ asset('js/datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/datepicker/dist/css/bootstrap-datepicker-custom.css') }}">
<script type="text/javascript" src="{{ asset('js/datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/admission.js') }}"></script>
@endsection