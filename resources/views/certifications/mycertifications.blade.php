@extends('layouts.master')

@section('title', 'AMID')

@section('content')
    @component('common-components.breadcrumb')
    @slot('pagetitle') Certifications @endslot
    @slot('title') Certifications @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card border border-primary">
                <div class="card-header bg-transparent border-primary">
                    <h5 class="my-0 text-primary">My Certifications</h5>
                </div>
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        @foreach ($certifications as $certification)
                            <div class="col-md-12 col-lg-12 mb-12">
                                <div class="card border border-primary h-100">
                                    <div
                                        class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                        <span><strong>#{{ $certification->order }}</strong> - {{ $certification->name }}</span>
                                        @if($certification->disciplines->count())
                                            <button class="btn btn-sm btn-light" onclick="toggleCard(this)">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        @endif
                                    </div>

                                    @if($certification->disciplines->count())
                                        <div class="card-body p-2" style="display: none;">
                                        @foreach($certification->disciplines as $discipline)
                                                @php
                                                    $pivot = $discipline->pivot ?? null;
                                                    $isSubmitted = $pivot && $pivot->is_submitted;
                                                @endphp
    <div class="border rounded p-2 mb-2">
        <p class="mb-1">
            <strong>#{{ $discipline->order }}</strong> - {{ $discipline->title }}
        </p>
        <div class="d-flex justify-content-start gap-3 align-items-center">
            <a href="{{ url('/resources/' . $discipline->id . '/docs') }}" class="text-primary" title="Docs">
                <i class="uil uil-file-plus font-size-18"></i>
            </a>
            <a href="{{ url('/resources/' . $discipline->id . '/tasks') }}" class="text-primary" title="Tasks">
                <i class="uil uil-apps font-size-18"></i>
            </a>
            <a href="{{ url('/disciplines/' . $discipline->id . '/test') }}" class="text-primary" title="Tests">
                <i class="uil uil-pen font-size-18"></i>
            </a>

            @if (!$isSubmitted)
                <form action="{{ route('student.markDisciplineDone') }}" method="POST" onsubmit="return confirm('Mark as done?')">
                    @csrf
                    <input type="hidden" name="discipline_id" value="{{ $discipline->id }}">
                    <button class="btn btn-sm btn-outline-success" type="submit" title="Mark as Done">
                        <i class="fas fa-check"></i>
                    </button>
                </form>
            @else
                <span class="text-success" title="Submitted">
                    <i class="fas fa-check-circle"></i>
                </span>
            @endif
        </div>
    </div>
@endforeach

                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    function toggleCard(btn) {
        const body = btn.closest('.card').querySelector('.card-body');
        const icon = btn.querySelector('i');
        if (body.style.display === 'none') {
            body.style.display = 'block';
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            body.style.display = 'none';
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }
</script>
@endsection
