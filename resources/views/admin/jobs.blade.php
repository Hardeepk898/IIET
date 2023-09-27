@extends('admin.layout')

@section('title', 'Private Job Recruitment Cell - Dashboard')

@section('content')
<div class="row details_list_table">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h3>Jobs
                    <a class="float-right btn btn-primary btn-sm add_details_btn" href="javascript:;"><i class="fas fa-plus"></i> Jobs</a>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table_datatable">
                        <thead class="bg-light">
                            <tr>
                                <th width="40"></th>
                                <th>Title</th>
                                <th width="150">Creation Time</th>
                                <th width="150"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($job_details as $job)
                            <tr id="row_{{ $job->id }}">
                            <td>
                                @if($job->status == 1)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">In-Active</span>
                                @endif
                            </td>
                            <td>{{ $job->title }}</td>
                            <td>{{ date('d-m-Y h:i A',strtotime($job->created_at)) }}</td>
                            <td>
                                <div class="dropdown dropleft float-right">
                                    <button class="btn btn-outline-primary" type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item update_details_btn" id="{{$job->id}}" href="javascript:;"><i class="fas fa-edit"></i> Edit</a>
                                        <a class="dropdown-item delete_details" id="{{$job->id}}" href="javascript:;"><i class="fas fa-trash"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="add_details_section" class="d-none"> 
    <div class="main-card mb-3 card">
        <div class="card-header"><h3>Jobs</h3></div>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <form id="add_details_form" method="post" action="/admin/jobs" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" required>
                    <div class="invalid-feedback">
                        Title is required.
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description"></textarea>
                </div>  
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="featured_image">Upload Documents</label><br>
                            <input type="file" name="file_path" id="file_path" class="form-control"><br>
                            <a id="jobs_file_path" class="mt-3" download></a>
                        </div>     
                    </div>
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="custom-select" required>
                                <option value="1">Active</option>
                                <option value="0">In-Active</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select status.
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group mt-3 text-right">      
                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                    <button class="btn btn-default btn-outline-primary btn-sm form_close_btn" type="button">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/jquery.tagsinput.js') }}"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/jquery.tagsinput.css') }}" />
<script>
$(document).ready(function () {
    $('#skills').tagsInput();
});

</script>
<script src="https://cdn.tiny.cloud/1/t7udjskxs5z1diraylv8i5tcj16rr7gqv68nnl1khoqd51a1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: '#description',
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }
});
</script>
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap-select.min.css') }}">
<script type="text/javascript" src="{{ asset('assets/vendor/bootstrap/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jobs.js') }}"></script>
@endsection