@extends('layouts.master')
@section('title')
    @lang('translation.Orders')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Ecommerce @endslot
        @slot('title') Orders @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div>
                                
                        <div class="float-end">
                            <form class="d-inline-flex mb-3">
                                <label class="form-check-label my-2 me-2" for="order-selectinput">Orders</label>
                                <select class="form-select" id="order-selectinput">
                                    <option selected>All</option>
                                    <option value="1">Active</option>
                                    <option value="2">Unpaid</option>
                                </select>
                            </form>
                            
                        </div>
                        <button type="button" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Add New Order</button>
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check text-center font-size-16">
                                            <input type="checkbox" class="form-check-input" id="ordercheck">
                                            <label class="form-check-label" for="ordercheck"></label>
                                        </div>
                                    </th>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Billing Name</th>
                                    <th>Total</th>
                                    <th>Payment Status</th>
                                    <th style="width: 120px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>
                                        <div class="form-check text-center font-size-16">
                                            <input type="checkbox" class="form-check-input" id="ordercheck1">
                                            <label class="form-check-label" for="ordercheck1"></label>
                                        </div>
                                    </td>
                                    
                                    <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0132</a> </td>
                                    <td>
                                        10 Jul, 2020
                                    </td>
                                    <td>Melvin Martin</td>
                                    
                                    <td>
                                        $142
                                    </td>
                                    <td>
                                        <div class="badge bg-pill bg-success-subtle text-success font-size-12">Paid</div>
                                    </td>
                                    
                                    <td>
                                        <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="form-check text-center font-size-16">
                                            <input type="checkbox" class="form-check-input" id="ordercheck2">
                                            <label class="form-check-label" for="ordercheck2"></label>
                                        </div>
                                    </td>
                                    
                                    <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0131</a> </td>
                                    <td>
                                        09 Jul, 2020
                                    </td>
                                    <td>Roy Michael</td>
                                    
                                    <td>
                                        $130
                                    </td>
                                    <td>
                                        <div class="badge bg-pill bg-success-subtle text-success font-size-12">Paid</div>
                                    </td>
                                    
                                    <td>
                                        <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="form-check text-center font-size-16">
                                            <input type="checkbox" class="form-check-input" id="ordercheck3">
                                            <label class="form-check-label" for="ordercheck3"></label>
                                        </div>
                                    </td>
                                    
                                    <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0130</a> </td>
                                    <td>
                                        08 Jul, 2020
                                    </td>
                                    <td>Shelby Wolf</td>
                                    
                                    <td>
                                        $123
                                    </td>
                                    <td>
                                        <div class="badge bg-pill bg-warning-subtle text-warning font-size-12">unpaid</div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check text-center font-size-16">
                                            <input type="checkbox" class="form-check-input" id="ordercheck4">
                                            <label class="form-check-label" for="ordercheck4"></label>
                                        </div>
                                    </td>
                                    
                                    <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0129</a></td>
                                    <td>
                                        07 Jul, 2020
                                    </td>
                                    <td>James Riddick</td>
                                    
                                    <td>
                                        $173
                                    </td>
                                    <td>
                                        <div class="badge bg-pill bg-success-subtle text-success font-size-12">Paid</div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check text-center font-size-16">
                                            <input type="checkbox" class="form-check-input" id="ordercheck5">
                                            <label class="form-check-label" for="ordercheck5"></label>
                                        </div>
                                    </td>
                                    
                                    <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0128</a></td>
                                    <td>
                                        07 Jul, 2020
                                    </td>
                                    <td>George Kwan</td>
                                    
                                    <td>
                                        $160
                                    </td>
                                    <td>
                                        <div class="badge bg-pill bg-danger-subtle text-danger font-size-12">Chargeback</div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check text-center font-size-16">
                                            <input type="checkbox" class="form-check-input" id="ordercheck6">
                                            <label class="form-check-label" for="ordercheck6"></label>
                                        </div>
                                    </td>
                                    
                                    <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0127</a> </td>
                                    <td>
                                        06 Jul, 2020
                                    </td>
                                    <td>Kevin Patterson</td>
                                    
                                    <td>
                                        $165
                                    </td>
                                    <td>
                                        <div class="badge bg-pill bg-success-subtle text-success font-size-12">Paid</div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check text-center font-size-16">
                                            <input type="checkbox" class="form-check-input" id="ordercheck7">
                                            <label class="form-check-label" for="ordercheck7"></label>
                                        </div>
                                    </td>
                                    
                                    <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0126</a> </td>
                                    <td>
                                        05 Jul, 2020
                                    </td>
                                    <td>Danny Orr</td>
                                    
                                    <td>
                                        $161
                                    </td>
                                    <td>
                                        <div class="badge bg-pill bg-success-subtle text-success font-size-12">Paid</div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check text-center font-size-16">
                                            <input type="checkbox" class="form-check-input" id="ordercheck8">
                                            <label class="form-check-label" for="ordercheck8"></label>
                                        </div>
                                    </td>
                                    
                                    <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0125</a> </td>
                                    <td>
                                        04 Jul, 2020
                                    </td>
                                    <td>Sylvia Garcia</td>
                                    
                                    <td>
                                        $153
                                    </td>
                                    <td>
                                        <div class="badge bg-pill bg-warning-subtle text-warning font-size-12">unpaid</div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check text-center font-size-16">
                                            <input type="checkbox" class="form-check-input" id="ordercheck9">
                                            <label class="form-check-label" for="ordercheck9"></label>
                                        </div>
                                    </td>
                                    
                                    <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0124</a></td>
                                    <td>
                                        04 Jul, 2020
                                    </td>
                                    <td>Charles Denney</td>
                                    
                                    <td>
                                        $152
                                    </td>
                                    <td>
                                        <div class="badge bg-pill bg-success-subtle text-success font-size-12">Paid</div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check text-center font-size-16">
                                            <input type="checkbox" class="form-check-input" id="ordercheck10">
                                            <label class="form-check-label" for="ordercheck10"></label>
                                        </div>
                                    </td>
                                    
                                    <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0123</a> </td>
                                    <td>
                                        03 Jul, 2020
                                    </td>
                                    <td>Lisa Farrell</td>
                                    
                                    <td>
                                        $167
                                    </td>
                                    <td>
                                        <div class="badge bg-pill bg-success-subtle text-success font-size-12">Paid</div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check text-center font-size-16">
                                            <input type="checkbox" class="form-check-input" id="ordercheck11">
                                            <label class="form-check-label" for="ordercheck11"></label>
                                        </div>
                                    </td>
                                    
                                    <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0122</a> </td>
                                    <td>
                                        02 Jul, 2020
                                    </td>
                                    <td>Connie Franco</td>
                                    
                                    <td>
                                        $163
                                    </td>
                                    <td>
                                        <div class="badge bg-pill bg-success-subtle text-success font-size-12">Paid</div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check text-center font-size-16">
                                            <input type="checkbox" class="form-check-input" id="ordercheck12">
                                            <label class="form-check-label" for="ordercheck12"></label>
                                        </div>
                                    </td>
                                    
                                    <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0121</a> </td>
                                    <td>
                                        02 Jul, 2020
                                    </td>
                                    <td>Lara Casillas</td>
                                    
                                    <td>
                                        $171
                                    </td>
                                    <td>
                                        <div class="badge bg-pill bg-success-subtle text-success font-size-12">Paid</div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table -->
                </div>
            </div>

        </div>
    </div>
    <!-- end row -->

@endsection
@section('script')
    <script src="{{ asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/assets/js/pages/ecommerce-datatables.init.js') }}"></script>
@endsection
