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
    @foreach($certifications as $certification)
        <div class="col-md-12 mb-4">
            <div class="card border border-primary h-100">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span><strong>#{{ $certification->order }}</strong> - {{ $certification->name }}</span>
                    @if($certification->disciplines->count())
                        <button class="btn btn-sm btn-light" onclick="toggleCard(this)">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    @endif
                </div>

                <div class="card-body p-2" style="display: none;">
                    
                    {{-- Books Section --}}
                    @if($certification->books->count())
                        <div class="alert alert-info d-flex align-items-center gap-2 mb-3" role="alert">
                            <i class="fas fa-book-open fa-lg"></i>
                            <span>
                                {{ $certification->books->count() }}
                                {{ Str::plural('book', $certification->books->count()) }} available for this certification.
                            </span>
                        </div>

                        <ul class="list-group list-group-flush mb-4">
                            @foreach ($certification->books as $book)
                                <li class="list-group-item">
                                    <strong>{{ $book->title }}</strong>
                                    @if($book->author)
                                        <em> by {{ $book->author }}</em>
                                    @endif
                                    <br>
                                    <a href="{{ $book->book_url }}" target="_blank">
                                        <i class="fas fa-link"></i> View Book
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Disciplines Section --}}
                    @if($certification->disciplines->count())
                        @foreach($certification->disciplines as $discipline)
                            @php
                                $isPaid = in_array($discipline->id, $paidDisciplineIds);
                                $user = auth()->user();
                            @endphp

                            <div class="border rounded p-2 mb-2">
                                <p class="mb-1">
                                    <strong>#{{ $discipline->order }}</strong> - {{ $discipline->title }}
                                </p>

                                @if ($user->is_free || $isPaid)
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
                                            <a href="{{ url('/task/' . $discipline->id . '/tasks') }}" class="text-decoration-none">
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
                                @else
                                    <div class="text-center my-2">
                                        <a href="{{ url('/paypal/discipline/' . $discipline->id) }}" class="px-3 text-success">
                                            <img src="{{ asset('assets/images/paypal.png') }}" style="width: 120px;" alt="Pay with PayPal">
                                        </a>
                                        <p class="text-muted small mt-2">Please complete your payment to access this discipline.</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div> <!-- end .card-body -->
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
