@extends('admin.layout')

@section('title', 'Private Job Recruitment Cell - Dashboard')

@section('content')
<div class="row details_list_table">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h3>Customers</h3>
                <input type="hidden" id="cust_id" name="id">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table_datatable">
                        <thead class="bg-light">
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Payment</th>
                                <th width="150"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr id="row_{{ $customer->id }}">
                            <td>{{ $customer->firstname }} {{ $customer->lastname }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td width="50" class="text-right">
                                <div id="payment_status_{{ $customer->id }}">
                                    @if($customer->payment_status == 0)                                
                                        <a href="javascript:;" style="font-size: 12px;" class="text-white mark_payment btn btn-danger btn-sm" id="{{$customer->id}}" title="Mark payment done">Mark Payment</a>
                                    @else 
                                        <span class="badge badge-success">Payment done</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="dropdown dropleft float-right">
                                    <button class="btn btn-outline-primary" type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item update_details_btn" id="{{$customer->id}}" href="javascript:;"><i class="fas fa-edit"></i> Edit</a>
                                        <a class="dropdown-item delete_details" id="{{$customer->id}}" href="javascript:;"><i class="fas fa-trash"></i> Delete</a>
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
        <div class="card-header"><h3>Customers</h3></div>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <form id="add_details_form" method="post" action="/admin/customers" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h4>Personal Details</h4>
                        <div class="form-group">
                            <label>Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control form-control-sm">
                        </div>
                    </div>    
                    <div class="col-md-6">
                        <h4>Upload CV</h4>
                        <div class="form-group">
                            <label>&nbsp;</label> 
                            <input type="file" name="file_path" id="file_path" class="form-control form-control-sm"><br>
                            <a id="cv_file_path" class="mt-3" download></a>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <h4>Qualification <a id="add_qualification_fields" class="btn btn-primary btn-sm text-light" title="Add More Qualification"><i class="fas fa-plus"></i></a></h4>
                        <div id="qualifications"></div>
                        <div id="more_quali_fields"></div>
                    </div>
                    <div class="col-md-6"></div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Comments</label>
                            <textarea class="form-control" name="comments" id="comments"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Area of expertise</label>
                            <select name="area_of_expertise[]" id="area_of_expertise" class="form-control custom-select custom-select-sm selectpicker" data-actions-box="true" data-live-search="true" data-selected-text-format="count > 2" title="Area of expertise" data-select-all-text="Select All" data-deselect-all-text="Deselect All" multiple autocomplete="off">
                                @foreach($job_types as $types)
                                <option value="{{$types->id}}"> {{ $types->job_type }}</option>
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
<script type="text/javascript" src="{{ asset('js/customers.js') }}"></script>
@endsection