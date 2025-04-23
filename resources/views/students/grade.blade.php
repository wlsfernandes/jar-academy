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
            @php
                $studentEditId = request('edit');
                $editTest = $student->testSubmissions->firstWhere('id', $studentEditId);
                $isOpen = $editTest && $editTest->student_id === $student->id;
            @endphp

            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="heading{{ $index }}">
                    <button class="accordion-button {{ $isOpen ? '' : 'collapsed' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                            aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                            aria-controls="collapse{{ $index }}">
                        <i class="dripicons-graduation font-size-16 text-primary me-2"></i>
                        {{ $student->user->name ?? 'Unnamed Student' }}
                    </button>
                </h2>

                <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $isOpen ? 'show' : '' }}"
                     aria-labelledby="heading{{ $index }}" data-bs-parent="#studentsAccordion">
                    <div class="accordion-body">
                        @foreach($student->certifications as $certification)
                            <div class="mb-4">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th colspan="6">
                                                <strong>#{{ $certification->order }} - {{ $certification->name }}</strong>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Discipline</th>
                                            <th>Test</th>
                                            <th>Test Info</th>
                                            <th>Status</th>
                                            <th>Grade</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($certification->disciplines as $discipline)
                                            @if ($discipline->tests->count())
                                                @foreach($discipline->tests as $test)
                                                    @php
                                                        $studentTest = $student->testSubmissions
                                                            ->where('test_id', $test->id)
                                                            ->first();
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $discipline->title }}</td>
                                                        <td>{{ $test->title ?? 'Untitled Test' }}</td>
                                                        <td>
                                                            @if ($studentTest)
                                                                <span class="badge bg-success">Submitted</span><br>
                                                                <small>At: {{ optional($studentTest->submitted_at)->format('Y-m-d H:i') ?? 'N/A' }}</small><br>
                                                                <small>On time? {{ $studentTest->submitted_within_time ? '✅ Yes' : '❌ No' }}</small>
                                                            @else
                                                                <span class="badge bg-warning text-dark">Not submitted</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($studentTest && $studentTest->grade !== null)
                                                                @if ($studentTest->grade < 7)
                                                                    <span class="badge bg-danger">Disapproved</span>
                                                                @else
                                                                    <span class="badge bg-success">Approved</span>
                                                                @endif
                                                            @else
                                                                <span class="text-muted">No grade</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($studentTest)
                                                                @if ($studentTest->grade === null || request('edit') == $studentTest->id)
                                                                    <form action="{{ route('student-tests.grade', $studentTest->id) }}" method="POST" class="d-flex align-items-center">
                                                                        @csrf
                                                                        <input type="number" step="0.1" min="0" max="10"
                                                                            name="grade" value="{{ $studentTest->grade ?? '' }}"
                                                                            class="form-control form-control-sm me-2" style="width: 80px;">
                                                                        <button class="btn btn-sm btn-primary">Save</button>
                                                                    </form>
                                                                @else
                                                                    {{ number_format($studentTest->grade, 2) }} / 10.0
                                                                    <a href="{{ url()->current() . '?edit=' . $studentTest->id }}" class="btn btn-sm btn-secondary ms-2">Edit</a>
                                                                @endif
                                                            @else
                                                                <em class="text-muted">N/A</em>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($studentTest)
                                                                <a href="{{ url('/student-tests/' . $studentTest->id . '/view') }}"
                                                                   class="text-primary" title="View Submission">
                                                                    <i class="fas fa-eye font-size-16"></i>
                                                                </a>
                                                            @else
                                                                <span class="text-muted">N/A</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>{{ $discipline->title }}</td>
                                                    <td colspan="5" class="text-muted">No test assigned</td>
                                                </tr>
                                            @endif
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
                No students with completed certifications yet.
            </div>
        @endforelse
    </div>
@endsection
