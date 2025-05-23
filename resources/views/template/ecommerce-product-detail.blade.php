@extends('layouts.master')
@section('title')
@lang('translation.Product_Detail')
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') Ecommerce @endslot
@slot('title') Product Detail @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-5">
                        <div class="product-detail">
                            <div class="row">
                                <div class="col-3">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="product-1-tab" data-bs-toggle="pill" href="#product-1" role="tab">
                                            <img src="{{asset('assets/images/product/img-1.png')}}" alt="" class="img-fluid mx-auto d-block tab-img rounded">
                                        </a>
                                        <a class="nav-link" id="product-2-tab" data-bs-toggle="pill" href="#product-2" role="tab">
                                            <img src="{{asset('assets/images/product/img-2.png')}}" alt="" class="img-fluid mx-auto d-block tab-img rounded">
                                        </a>
                                        <a class="nav-link" id="product-3-tab" data-bs-toggle="pill" href="#product-3" role="tab">
                                            <img src="{{asset('assets/images/product/img-3.png')}}" alt="" class="img-fluid mx-auto d-block tab-img rounded">
                                        </a>
                                        <a class="nav-link" id="product-4-tab" data-bs-toggle="pill" href="#product-4" role="tab">
                                            <img src="{{asset('assets/images/product/img-6.png')}}" alt="" class="img-fluid mx-auto d-block tab-img rounded">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-9">
                                    <div class="tab-content position-relative" id="v-pills-tabContent">

                                        <div class="product-wishlist">
                                            <a href="#">
                                                <i class="mdi mdi-heart-outline"></i>
                                            </a>
                                        </div>
                                        <div class="tab-pane fade show active" id="product-1" role="tabpanel">
                                            <div class="product-img">
                                                <img src="{{asset('assets/images/product/img-1.png')}}" alt="" class="img-fluid mx-auto d-block" data-zoom="{{asset('assets/images/product/img-1.png')}}">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="product-2" role="tabpanel">
                                            <div class="product-img">
                                                <img src="{{asset('assets/images/product/img-2.png')}}" alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="product-3" role="tabpanel">
                                            <div class="product-img">
                                                <img src="{{asset('assets/images/product/img-3.png')}}" alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="product-4" role="tabpanel">
                                            <div class="product-img">
                                                <img src="{{asset('assets/images/product/img-6.png')}}" alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row text-center mt-2">
                                        <div class="col-sm-6">
                                            <div class="d-grid">
                                                <button type="button" class="btn btn-primary waves-effect waves-light mt-2 me-1">
                                                    <i class="uil uil-shopping-cart-alt me-2"></i> Add to cart
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-grid">
                                                <button type="button" class="btn btn-light waves-effect  mt-2 waves-light">
                                                    <i class="uil uil-shopping-basket me-2"></i>Buy now
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="mt-4 mt-xl-3 ps-xl-4">
                            <h5 class="font-size-14"><a href="#" class="text-muted">Nike</a></h5>
                            <h4 class="font-size-20 mb-3">Nike N012 Running Shoes (Gray)</h4>

                            <div class="text-muted">
                                <span class="badge bg-success font-size-14 me-1"><i class="mdi mdi-star"></i> 4.2</span> 234 Reviews
                            </div>

                            <h5 class="mt-4 pt-2"><del class="text-muted me-2">$280</del>$260 <span class="text-danger font-size-14 ms-2">- 20 % Off</span></h5>

                            <p class="mt-4 text-muted">If several languages coalesce, the grammar of the resulting language is more simple and regular</p>

                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-3">

                                            <h5 class="font-size-14">Specification :</h5>
                                            <ul class="list-unstyled product-desc-list text-muted">
                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> High Quality</li>
                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> Leather</li>
                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> All Sizes available</li>
                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> 4 Different Color</li>
                                            </ul>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mt-3">
                                            <h5 class="font-size-14">Services :</h5>
                                            <ul class="list-unstyled product-desc-list text-muted">
                                                <li><i class="uil uil-exchange text-primary me-1 font-size-16"></i> 10 Days Replacement</li>
                                                <li><i class="uil uil-bill text-primary me-1 font-size-16"></i> Cash on Delivery available</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">

                                    <h5 class="font-size-14 mb-3"><i class="uil uil-location-pin-alt font-size-20 text-primary align-middle me-2"></i> Delivery location</h5>

                                    <div class="d-inline-flex">

                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Enter Delivery pincode">

                                            <button class="btn btn-light" type="button">Check</button>

                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-7 col-sm-8">
                                        <div class="product-desc-color mt-3">
                                            <h5 class="font-size-14">Colors :</h5>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="#" class="active" data-bs-toggle="tooltip" data-bs-placement="top" title="Gray">
                                                        <div class="product-color-item">
                                                            <img src="{{asset('assets/images/product/img-1.png')}}" alt="" class="avatar-md">
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Dark">
                                                        <div class="product-color-item">
                                                            <img src="{{asset('assets/images/product/img-2.png')}}" alt="" class="avatar-md">
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Purple">
                                                        <div class="product-color-item">
                                                            <img src="{{asset('assets/images/product/img-3.png')}}" alt="" class="avatar-md">
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="text-primary border-0 p-1">
                                                        2 + Colors
                                                    </a>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-sm-4">
                                        <div class="mt-3">
                                            <h5 class="font-size-14 mb-3">Select Sizes :</h5>

                                            <div class="d-inline-flex">
                                                <select class="form-select w-sm">
                                                    <option value="1">3</option>
                                                    <option value="2">4</option>
                                                    <option value="3">5</option>
                                                    <option value="4">6</option>
                                                    <option value="5" selected>7</option>
                                                    <option value="6">8</option>
                                                    <option value="7">9</option>
                                                    <option value="8">10</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="mt-4">
                    <h5 class="font-size-14 mb-3">Product description: </h5>
                    <div class="product-desc">
                        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="desc-tab" data-bs-toggle="tab" href="#desc" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="specifi-tab" data-bs-toggle="tab" href="#specifi" role="tab">Specifications</a>
                            </li>
                        </ul>
                        <div class="tab-content border border-top-0 p-4">
                            <div class="tab-pane fade" id="desc" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-3 col-md-2">
                                        <div>
                                            <img src="{{asset('assets/images/product/img-6.png')}}" alt="" class="img-fluid mx-auto d-block">
                                        </div>
                                    </div>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="text-muted p-2">
                                            <p>If several languages coalesce, the grammar of the resulting language is more simple and regular</p>
                                            <p>Everyone realizes why a new common language would be desirable, one could refuse to pay expensive translators.</p>
                                            <p>It will be as simple as occidental in fact.</p>

                                            <div>
                                                <ul class="list-unstyled product-desc-list text-muted">
                                                    <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> Sed ut perspiciatis omnis iste</li>
                                                    <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> Neque porro quisquam est</li>
                                                    <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> Quis autem vel eum iure</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="specifi" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width: 20%;">Category</th>
                                                <td>Shoes</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Brand</th>
                                                <td>Nike</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Color</th>
                                                <td>Gray</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Quality</th>
                                                <td>High</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Material</th>
                                                <td>Leather</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="font-size-14 mb-3">Reviews : </h5>
                    <div class="text-muted mb-3">
                        <span class="badge bg-success font-size-14 me-1"><i class="mdi mdi-star"></i> 4.2</span> 234 Reviews
                    </div>
                    <div class="border p-4 rounded">
                        <div class="border-bottom pb-3">
                            <p class="float-sm-end text-muted font-size-13">12 July, 2020</p>
                            <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i> 4.1</div>
                            <p class="text-muted mb-4">It will be as simple as in fact, it will be Occidental. It will seem like simplified</p>
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15 mb-0">Samuel</h5>
                                </div>

                                <div class="flex-shrink-0">
                                    <ul class="list-inline product-review-link mb-0">
                                        <li class="list-inline-item">
                                            <a href="#"><i class="uil uil-thumbs-up"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#"><i class="uil uil-comment-alt-message"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="border-bottom py-3">
                            <p class="float-sm-end text-muted font-size-13">06 July, 2020</p>
                            <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i> 4.0</div>
                            <p class="text-muted mb-4">Sed ut perspiciatis unde omnis iste natus error sit</p>
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15 mb-0">Joseph</h5>
                                </div>

                                <div class="flex-shrink-0">
                                    <ul class="list-inline product-review-link mb-0">
                                        <li class="list-inline-item">
                                            <a href="#"><i class="uil uil-thumbs-up"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#"><i class="uil uil-comment-alt-message"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="border-bottom py-3">
                            <p class="float-sm-end text-muted font-size-13">26 June, 2020</p>
                            <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i> 4.2</div>
                            <p class="text-muted mb-4">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet</p>
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15 mb-0">Paul</h5>
                                </div>

                                <div class="flex-shrink-0">
                                    <ul class="list-inline product-review-link mb-0">
                                        <li class="list-inline-item">
                                            <a href="#"><i class="uil uil-thumbs-up"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#"><i class="uil uil-comment-alt-message"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

@endsection
