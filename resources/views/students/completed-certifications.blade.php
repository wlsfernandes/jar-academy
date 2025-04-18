@extends('layouts.master')

@section('title', 'Completed Certifications')

@section('content')
    <h4 class="mb-4">Students with Completed Certifications</h4>

    @forelse($students as $student)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <strong>{{ $student->user->name ?? 'Unnamed Student' }}</strong>
            </div>
            <div class="card-body">
                @foreach($student->certifications as $certification)
                    <div class="mb-3 border rounded p-3 bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>#{{ $certification->order }} - {{ $certification->name }}</strong><br>
                                <small class="text-muted">Completed: {{ $certification->pivot->completed_at }}</small>
                            </div>

                            <div>
                                @if ($certification->pivot->is_approved)
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <form method="POST" action="{{ route('student.certification.approval') }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input type="hidden" name="certification_id" value="{{ $certification->id }}">
                                        <input type="hidden" name="status" value="approved">
                                        <button class="btn btn-success btn-sm">Approve</button>
                                    </form>

                                    <form method="POST" action="{{ route('student.certification.approval') }}" class="d-inline ms-2">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input type="hidden" name="certification_id" value="{{ $certification->id }}">
                                        <input type="hidden" name="status" value="rejected">
                                        <button class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <ul class="mt-3">
                            @foreach($certification->disciplines as $discipline)
                                <li>
                                    <strong>{{ $discipline->title }}</strong>

                                    @if ($discipline->tests->count())
                                        @foreach($discipline->tests as $test)
                                            <div class="ms-3">
                                                <p><strong>Test:</strong> {{ $test->title ?? 'Untitled Test' }}</p>

                                                @php
                                                    $studentTest = $student->testSubmissions
                                                        ->where('test_id', $test->id)
                                                        ->first();
                                                @endphp

                                                @if ($studentTest)
                                                    <div class="text-success">
                                                        <span class="badge bg-success mb-1">Submitted</span><br>
                                                        <strong>Submitted at:</strong> {{ optional($studentTest->submitted_at)->format('Y-m-d H:i') ?? 'N/A' }}<br>
                                                        <strong>On time?</strong> {{ $studentTest->submitted_within_time ? '✅ Yes' : '❌ No' }}
                                                    </div>
                                                @else
                                                    <p class="text-warning"><span class="badge bg-warning text-dark">Test not submitted</span></p>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted ms-3">No test assigned to this discipline.</p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="alert alert-warning">
            No students with completed certifications yet.
        </div>
    @endforelse
@endsection
