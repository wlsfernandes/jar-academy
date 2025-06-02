@extends('layouts.master')

@section('title', 'Grade')

@section('content')
    <h4 class="mb-4">Students Grade</h4>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="accordion" id="studentsAccordion">
        @forelse($students as $index => $student)
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="heading{{ $index }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                        <i class="dripicons-graduation font-size-16 text-primary me-2"></i>
                        {{ $student->user->name ?? 'Unnamed Student' }}
                    </button>
                </h2>

                <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}"
                    data-bs-parent="#studentsAccordion">
                    <div class="accordion-body">
                        @foreach($student->certifications as $certification)
                            <div class="mb-4">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th colspan="3">
                                                <strong>#{{ $certification->order }} - {{ $certification->name }}</strong>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Discipline</th>
                                            <th>Task</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($certification->disciplines as $discipline)
    @foreach($discipline->tasks as $task)
        @php
            $submission = \App\Models\StudentTask::where('student_id', $student->user->id)
                ->where('task_id', $task->id)
                ->first();
        @endphp
        <tr>
            <td>{{ $discipline->title }}</td>
            <td>{{ $task->title ?? 'Untitled Task' }}</td>
            <td>
                @if ($submission && !empty($submission->answer))
                    <a href="{{ url('/task/' . $task->id . '/edit') }}" class="btn btn-sm btn-outline-primary mt-2">
                        <i class="uil uil-pen font-size-18"></i> ✏️ View Answer
                    </a>

                    @if ($submission->url)
                        <a href="{{ $submission->url }}" target="_blank" class="btn btn-sm btn-outline-secondary mt-2 ms-2">
                            📄 View Attachment
                        </a>
                    @endif
                @else
                    <span class="badge bg-danger">❌ Not Concluded</span>
                @endif
            </td>
        </tr>
    @endforeach
@endforeach

                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning">
                No students or certifications found.
            </div>
        @endforelse
    </div>

@endsection