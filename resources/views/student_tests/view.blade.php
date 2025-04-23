@extends('layouts.master')

@section('title', 'Student Test View')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-between" style="margin:15px">
                <a href="{{ url('/disciplines') }}" class="btn btn-secondary waves-effect">
                    <i class="bx bx-arrow-back"></i> @lang('app.go_back')
                </a>
            </div>
        </div>
    </div>
</div>    

<h4 class="mb-4">Submission for: {{ $submission->test->title }} ({{ $submission->student->user->name ?? 'Unnamed' }})</h4>

    <div class="card">
        <div class="card-body">
            <p><strong>Discipline:</strong> {{ $submission->test->discipline->title }}</p>
            <p><strong>Submitted at:</strong> {{ optional($submission->submitted_at)->format('Y-m-d H:i') ?? 'Not submitted' }}</p>
            <p><strong>Grade:</strong> {{ $submission->grade !== null ? number_format($submission->grade, 2) . ' / 10.0' : 'Not graded' }}</p>
            <hr>
            <h5>Answer:</h5>
            <pre class="bg-light p-3 rounded">{!!   $submission->answer ?? 'No answer submitted.' !!}</pre>
        </div>
    </div>
@endsection
