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

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>Ordem</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Gratuíto?</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($certifications as $certification)
                                    <tr>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" type="button"
                                                onclick="toggleDisciplines('disciplines-{{ $certification->id }}')">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                              <b>{{ $certification->order }}</b> 
                                        </td>
                                        <td>{{ $certification->name ?? '' }}</td>
                                        <td>{{ $certification->amount ?? '' }}</td>
                                        <td>
                                            @if ($certification->isFree)
                                                <span class="badge bg-info text-dark">Yes</span>
                                            @else
                                                <span class="badge bg-warning text-dark">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/certifications/' . $certification->id) }}"
                                                class="text-primary me-2">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ url('/certifications/' . $certification->id . '/edit') }}"
                                                class="text-primary me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-danger"
                                                onclick="event.preventDefault(); if(confirm('Confirm delete?')) document.getElementById('delete-form-{{ $certification->id }}').submit();">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <form id="delete-form-{{ $certification->id }}" method="POST"
                                                action="{{ url('/certifications/' . $certification->id) }}"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>

                                    @if($certification->disciplines && $certification->disciplines->count())
                                        <tr id="disciplines-{{ $certification->id }}" style="display: none;">
                                            <td></td>
                                            <td colspan="4">
                                                <div class="table-responsive ps-4">
                                                    <table class="table table-sm table-bordered mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Ordem</th>
                                                                <th>Discipline</th>
                                                                <th>Price</th>
                                                                <th>Gratuíto?</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($certification->disciplines as $discipline)
                                                                <tr>
                                                                    <td>{{ $discipline->order }}</td>
                                                                    <td>{{ $discipline->title }}</td>
                                                                    <td>{{ $discipline->amount ?? '-' }}</td>
                                                                    <td>
                                                                        @if ($discipline->isFree)
                                                                            <span class="badge bg-info text-dark">Yes</span>
                                                                        @else
                                                                            <span class="badge bg-warning text-dark">No</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ url('/disciplines/' . $discipline->id) }}"
                                                                            class="text-primary me-2">
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>
                                                                        <a href="{{ url('/disciplines/' . $discipline->id . '/edit') }}"
                                                                            class="text-primary me-2">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                        <a href="#" class="text-danger"
                                                                            onclick="event.preventDefault(); if(confirm('Confirm delete?')) document.getElementById('delete-discipline-{{ $discipline->id }}').submit();">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </a>
                                                                        <form id="delete-discipline-{{ $discipline->id }}" method="POST"
                                                                            action="{{ url('/disciplines/' . $discipline->id) }}"
                                                                            style="display: none;">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function toggleDisciplines(id) {
            const row = document.getElementById(id);
            if (row.style.display === 'none') {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    </script>
@endsection