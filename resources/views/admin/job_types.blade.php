@extends('admin.layout')

@section('title', 'Private Job Recruitment Cell - Job Types')

@section('content')
<div class="row details_list_table">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h3>Job Types
                    <a class="float-right btn btn-primary btn-sm add_details_btn" href="javascript:;"><i class="fas fa-plus"></i> Job Type</a>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table_datatable">
                        <thead class="bg-light">
                            <tr>
                                <th width="40"></th>
                                <th>Type</th>
                                <th width="150"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($job_types as $job)
                            <tr id="row_{{ $job->id }}">
                                <td>
                                    @if($job->status == 1)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">In-Active</span>
                                    @endif
                                </td>
                                <td>{{ $job->job_type }}</td>
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
        <div class="card-header"><h3>Job Types</h3></div>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <form id="add_details_form" method="post" action="/admin/job_types" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label for="title">Type</label>
                    <input type="text" name="job_type" class="form-control" id="job_type" required>
                    <div class="invalid-feedback">
                        Title is required.
                    </div>
                </div>
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
<script type="text/javascript" src="{{ asset('js/job_types.js') }}"></script>
@endsection