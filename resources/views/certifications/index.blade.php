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
                    <h5 class="my-0 text-primary">Certifications</h5>
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

                    <a href="{{ url('certifications/create') }}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Add New
                    </a>

                    <div class="row">
                        @foreach ($certifications as $certification)
                            <div class="col-md-12 col-lg-12 mb-12">
                                <div class="card border border-primary h-100">
                                    <div
                                        class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>#{{ $certification->order }}</strong> - {{ $certification->name }}
                                            <br>
                                            <small>${{ $certification->amount ?? '0.00' }}</small>
                                            <br>
                                            <span
                                                class="badge {{ $certification->isFree ? 'bg-info text-dark' : 'bg-warning text-dark' }}">
                                                {{ $certification->isFree ? 'Gratuito' : 'Pago' }}
                                            </span>
                                        </div>
                                        @if($certification->disciplines->count())
                                            <button class="btn btn-sm btn-light" onclick="toggleCard(this)">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        @endif
                                    </div>

                                    <div class="card-body">
                                        <div class="d-flex justify-content-end gap-3">
                                            <a href="{{ url('/certifications/' . $certification->id) }}" class="text-primary"
                                                title="View"><i class="fas fa-eye"></i></a>
                                            <a href="{{ url('/certifications/' . $certification->id . '/edit') }}"
                                                class="text-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="text-danger" title="Delete"
                                                onclick="event.preventDefault(); if(confirm('Confirm delete?')) document.getElementById('delete-form-{{ $certification->id }}').submit();">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <form id="delete-form-{{ $certification->id }}" method="POST"
                                                action="{{ url('/certifications/' . $certification->id) }}"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>

                                    @if($certification->disciplines->count())
                                        <div class="card-body border-top" style="display: none;">
                                            <h6 class="text-muted mb-3">Disciplinas:</h6>
                                            @foreach($certification->disciplines as $discipline)
                                                <div class="border rounded p-2 mb-2">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <strong>#{{ $discipline->order }}</strong> - {{ $discipline->title }}
                                                            <br>
                                                            <small>${{ $discipline->amount ?? '0.00' }}</small>
                                                            <br>
                                                            <span
                                                                class="badge {{ $discipline->isFree ? 'bg-info text-dark' : 'bg-warning text-dark' }}">
                                                                {{ $discipline->isFree ? 'Gratuito' : 'Pago' }}
                                                            </span>
                                                        </div>
                                                        <div class="d-flex gap-2 align-items-start pt-2">
                                                            <a href="{{ url('/disciplines/' . $discipline->id) }}" class="text-primary"
                                                                title="View"><i class="fas fa-eye"></i></a>
                                                            <a href="{{ url('/disciplines/' . $discipline->id . '/edit') }}"
                                                                class="text-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                            <a href="#" class="text-danger" title="Delete"
                                                                onclick="event.preventDefault(); if(confirm('Confirm delete?')) document.getElementById('delete-discipline-{{ $discipline->id }}').submit();">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                            <form id="delete-discipline-{{ $discipline->id }}" method="POST"
                                                                action="{{ url('/disciplines/' . $discipline->id) }}"
                                                                style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
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
            const cardBody = btn.closest('.card').querySelectorAll('.card-body')[1];
            const icon = btn.querySelector('i');
            if (cardBody.style.display === 'none') {
                cardBody.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                cardBody.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }
    </script>
@endsection