@extends('layout')

@section('title', 'Private Job Recruitment Cell - Jobs')

@section('content')
<div class="card jobs">
    <div class="card-header"><h3>Jobs</h3></div>
    <div class="card-body">
        @if(count($job_details) > 0)
        @foreach($job_details as $job)
        <div class="alert alert-info mb-3">
            <h4><a href="{{ URL::to('jobs/' . $job->id) }}">{{ $job->title }}</a></h4>
            <p class="font-12">Posted on: {{ date('d F, Y', strtotime($job->created_at)) }} </p>
            <div class="description">@php echo substr(htmlspecialchars_decode($job->description),0,300) . '....'; @endphp</div>
            
            <p><a href="" class="btn btn-primary btn-sm mt-3">Apply</a></p>
        </div>
        @endforeach
        @else
        <p>No jobs found.</p>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/my_account.js') }}"></script>
@endsection