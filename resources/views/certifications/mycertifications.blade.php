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
        <div class="row g-2 mb-2">
    <div class="col-sm-4">
        <a href="{{ url('/resources/' . $discipline->id . '/docs') }}" class="text-decoration-none">
            <div class="card text-center h-100 shadow-sm border">
                <div class="card-body p-2">
                    <i class="uil uil-file-plus font-size-24 text-primary"></i>
                    <p class="mb-0 mt-1 text-muted">Docs</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-4">
        <a href="{{ url('/resources/' . $discipline->id . '/tasks') }}" class="text-decoration-none">
            <div class="card text-center h-100 shadow-sm border">
                <div class="card-body p-2">
                    <i class="uil uil-apps font-size-24 text-primary"></i>
                    <p class="mb-0 mt-1 text-muted">Tasks</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-4">
        <a href="{{ url('/disciplines/' . $discipline->id . '/test') }}" class="text-decoration-none">
            <div class="card text-center h-100 shadow-sm border">
                <div class="card-body p-2">
                    <i class="uil uil-pen font-size-24 text-primary"></i>
                    <p class="mb-0 mt-1 text-muted">Tests</p>
                </div>
            </div>
        </a>
    </div>
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
