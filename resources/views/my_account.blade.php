@extends('layout')

@section('title', 'Private Job Recruitment Cell - My Account')

@section('content')
<div class="card profile_text">
    <div class="card-header"><h3>My Account <a class="update_profile btn btn-primary btn-sm font-14" href="javascript:;">Edit</a></h3></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Personal Details</h4>
                <p><b>Name: </b> {{$customer->firstname}} {{$customer->lastname}}</p>
                <p><b>Email: </b> {{$customer->email}}</p>
                <p><b>Phone: </b> {{$customer->phone}}</p>
            </div>
            <div class="col-md-6">
                <h4>CV Details</h4>
                @if(file_exists('storage/' . $customer->file_path))
                @if(pathinfo('storage/' . $customer->file_path, PATHINFO_EXTENSION) == 'pdf')
                <a href="{{'/storage/' . $customer->file_path}}" download><img src="{{ asset('images/pdf.png') }}" width="100"></a>
                @elseif(pathinfo('storage/' . $customer->file_path, PATHINFO_EXTENSION) == 'docx')
                <a href="{{'/storage/' . $customer->file_path}}" download><img src="{{ asset('images/docx.png') }}" width="100"></a>
                @endif
                @else
                <p>No details available.</p>
                @endif
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h4>Qualification</h4>
                @if(count($customer->qualificaion) > 0)
                @foreach($customer->qualificaion as $qualification)
                <div class="alert alert-info mb-3">
                    <b>{{ $qualification->course_name }}</b><br>
                    {{ $qualification->institute_name }}<br>
                    {{ $qualification->qualification_year }}<br>
                </div>
                @endforeach
                @else
                <p>No details available.</p>
                @endif
            </div>
            <div class="col-md-6">
                <h4>Area of expertise</h4>
                @if(count($customer->AreaOfExpertise) > 0)
                <ul>
                    @foreach($customer->AreaOfExpertise as $AreaOfExpertise)
                    <li>{{ $AreaOfExpertise->job_types->job_type }}</li>
                    @endforeach
                </ul>
                @else
                <p>No details available.</p>
                @endif
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <h4>Comments</h4>
                @if($customer->comments != '')
                {{ $customer->comments }}
                @else
                <p>No comments available.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div id="add_profile_details_section" class="d-none"> 
    <div class="card">
        <div class="card-header"><h3>My Account</h3></div>
        <div class="card-body">
            <form id="add_details_form" method="post" action="/my_account" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h4>Personal Details</h4>
                        <div class="form-group">
                            <label>Firstname</label>
                            <input type="text" name="firstname" value="{{$customer->firstname}}" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Lastname</label>
                            <input type="text" name="lastname" value="{{$customer->lastname}}" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" value="{{$customer->phone}}" class="form-control form-control-sm">
                        </div>
                    </div>    
                    <div class="col-md-6">
                        <h4>Upload CV</h4>
                        <div class="form-group">
                            <label>&nbsp;</label> 
                            <input type="file" name="file_path" id="file_path" class="form-control form-control-sm"><br>
                            @if(file_exists('storage/' . $customer->file_path))
                            @if(pathinfo('storage/' . $customer->file_path, PATHINFO_EXTENSION) == 'pdf')
                            <a href="{{'/storage/' . $customer->file_path}}" download><img src="{{ asset('images/pdf.png') }}" width="100"></a>
                            @elseif(pathinfo('storage/' . $customer->file_path, PATHINFO_EXTENSION) == 'docx')
                            <a href="{{'/storage/' . $customer->file_path}}" download><img src="{{ asset('images/docx.png') }}" width="100"></a>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <h4>Qualification <a id="add_qualification_fields" class="btn btn-primary btn-sm text-light" title="Add More Qualification"><i class="fas fa-plus"></i></a></h4>
                        @if(count($customer->qualificaion) > 0)
                        @foreach($customer->qualificaion as $index=>$qualificaion)
                        <div class="row qualificaion_row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Course Name</label>
                                    <input type="text" name="qualification[{{$index+1}}][course_name]" value="{{ $qualificaion->course_name }}" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Institute Name</label>
                                    <input type="text" name="qualification[{{$index+1}}][institute_name]" value="{{ $qualificaion->institute_name }}" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select name="qualification[{{$index+1}}][qualification_year]" class="custom-select custom-select-sm" autocomplete="off">
                                        <option value="">Select Year</option>
                                        @for($i = date("Y",strtotime("-50 year")); $i <= date("Y"); $i++)
                                        <option value="{{$i}}" {{ ($qualificaion->qualification_year == $i)?'selected':'' }}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                @if($index+1 > 1)
                                <div class="form-group mt-4">
                                    <label>&nbsp;</label>
                                    <a href="javascript:;" class="remove_qual"><i class="fas fa-trash"></i></a>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @else 
                        <div class="row qualificaion_row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Course Name</label>
                                    <input type="text" name="qualification[1][course_name]" value="" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Institute Name</label>
                                    <input type="text" name="qualification[1][institute_name]" value="" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select name="qualification[1][qualification_year]" class="custom-select custom-select-sm" autocomplete="off">
                                        <option value="">Select Year</option>
                                        @for($i = date("Y",strtotime("-50 year")); $i <= date("Y"); $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        @endif
                        <div id="more_quali_fields"></div>
                    </div>
                    <div class="col-md-6"></div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Comments</label>
                            <textarea class="form-control" name="comments">{{ $customer->comments }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Area of expertise</label>
                            <select name="area_of_expertise[]" class="form-control custom-select custom-select-sm selectpicker" data-actions-box="true" data-live-search="true" data-selected-text-format="count > 2" title="Area of expertise" data-select-all-text="Select All" data-deselect-all-text="Deselect All" multiple autocomplete="off">
                                @foreach($job_types as $types)
                                <option value="{{$types->id}}" <?php echo ((array_search($types->id, array_column($customer->AreaOfExpertise, 'job_types_id')) !== false) ? 'selected' : '') ?>> {{ $types->job_type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" name="submit" value="Update" class="btn btn-danger btn-sm">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap-select.min.css') }}">
<script src="{{ asset('js/my_account.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/bootstrap/js/bootstrap-select.min.js') }}"></script>
@endsection