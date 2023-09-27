@extends('layout')

@section('title', 'Private Job Recruitment Cell - Jobs')

@section('content')
<div class="card jobs">
    <div class="card-header"><h3>Jobs</h3></div>
    <div class="card-body">
        <h4><a href="{{ URL::to('jobs/' . $job->id) }}">{{ $job->title }}</a></h4>
        <p class="font-12">Posted on: {{ date('d F, Y', strtotime($job->created_at)) }} </p>
        <div class="description">@php echo htmlspecialchars_decode($job->description); @endphp</div>
        <p>
                @if(file_exists('storage/' . $job->file_path))
                @if(pathinfo('storage/' . $job->file_path, PATHINFO_EXTENSION) == 'pdf')
                <a href="{{'/storage/' . $job->file_path}}" download><img src="{{ asset('images/pdf.png') }}" width="100"></a>
                @elseif(pathinfo('storage/' . $job->file_path, PATHINFO_EXTENSION) == 'docx')
                <a href="{{'/storage/' . $job->file_path}}" download><img src="{{ asset('images/docx.png') }}" width="100"></a>
                @endif
                @endif
            </p>
        <p><a href="" class="btn btn-primary btn-sm mt-3">Apply</a></p>

    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/my_account.js') }}"></script>
@endsection