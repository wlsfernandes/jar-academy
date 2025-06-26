@extends('layouts.master')
@section('title')
    User
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
    @slot('pagetitle')
    User
    @endslot
    @slot('title')
    Amid - User
    @endslot
    @endcomponent



    <div class="row">
        <div class="col-lg-12">
            <div class="card border border-primary">
                <div class="card-header bg-transparent border-primary">
                    <h5 class="my-0 text-primary"><i class="uil-chat-bubble-user"></i> Users Management</b></h5>
                </div>
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle"></i> <!-- Success icon -->
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li><i class="bx bx-error"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>

                        <!--   <a href="{{ url('/user/create') }}">
                                                                                <button type="button" class="btn btn-success waves-effect waves-light mb-3"><i
                                                                                        class="fas fa-plus"></i> Add New</button> </a> -->
                    </div>

                    <h4 class="card-title">Users</h4>
                    <p>All Reset Password it will received a password of <code>amidLearning2030</code></p>
                    <table id="datatable-users" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Reset Password</th>
                                <th>
                                    <div class="badge bg-pill bg-info-subtle text-info font-size-12">
                                        Free Access
                                    </div>
                                </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name ?? '' }}</td>
                                    <td>{{ $user->email ?? '' }}</td>
                                    <td>
                                        @if($user->roles->isNotEmpty())
                                            {{ $user->roles->pluck('name')->join(', ') }}
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Reset Passowrd -->
                                        <a href="#" class="px-3 text-primary"
                                            onclick="event.preventDefault(); document.getElementById('block-file-form-team-{{ $user->id }}').submit();">
                                            <i class="uil uil-refresh text-info font-size-18"></i>
                                        </a>
                                        <form id="block-file-form-team-{{ $user->id }}"
                                            action="{{ route('user.resetPassword', $user->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>

                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="px-3 text-primary"
                                            onclick="event.preventDefault(); if(confirm('Confirm change free status?')) { document.getElementById('free-form-{{ $user->id }}').submit(); }">

                                            @if ($user->is_free)
                                                <i class="text-success uil-unlock-alt font-size-20" title="Free User"></i>
                                            @else
                                                <i class="text-secondary uil-lock-alt font-size-20" title="Paid User"></i>
                                            @endif
                                        </a>

                                        <form id="free-form-{{ $user->id }}"
                                            action="{{ url('/user/' . $user->id . '/toggle-free') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('POST')
                                        </form>

                                    </td>
                                    <td>
                                        <!--    <a href="{{ url('/user/' . $user->id . '/edit') }}" class="px-3 text-primary"><i
                                                                                                                                                            class="uil uil-pen font-size-18"></i></a> -->

                                        <a href="javascript:void(0);" class="px-3 text-danger"
                                            onclick="event.preventDefault(); if(confirm('Confirm delete?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }">
                                            <i class="uil uil-trash-alt font-size-18"></i>
                                        </a>

                                        <form id="delete-form-{{ $user->id }}" action="{{ url('/access/' . $user->id) }}"
                                            method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <script src="{{ asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#datatable-users').DataTable({
                "pageLength": -1,
                "lengthMenu": [[-1, 10, 25, 50, 100], ["All", 10, 25, 50, 100]],
                "dom": 'Bfrtip',
                "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endsection