@extends('layouts.master')
@section('title')
@lang('translation.Checkout')
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') Ecommerce @endslot
@slot('title') Checkout @endslot
@endcomponent

<div class="row">
    <div class="col-xl-8">
        <div class="custom-accordion">
            <div class="card">
                <a href="#checkout-billinginfo-collapse" class="text-reset" data-bs-toggle="collapse">
                    <div class="p-4">

                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <i class="uil uil-receipt text-primary h2"></i>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Billing Info</h5>
                                <p class="text-muted text-truncate mb-0">Sed ut perspiciatis unde omnis iste</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                            </div>
                        </div>

                    </div>
                </a>

                <div id="checkout-billinginfo-collapse" class="collapse show">
                    <div class="p-4 border-top">
                        <form>
                            <div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="billing-name">Name</label>
                                            <input type="text" class="form-control" id="billing-name" placeholder="Enter name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="billing-email-address">Email Address</label>
                                            <input type="email" class="form-control" id="billing-email-address" placeholder="Enter email">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="billing-phone">Phone</label>
                                            <input type="text" class="form-control" id="billing-phone" placeholder="Enter Phone no.">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="billing-address">Address</label>
                                    <textarea class="form-control" id="billing-address" rows="3" placeholder="Enter full address"></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-4 mb-lg-0">
                                            <label class="form-label">Country</label>
                                            <select class="form-control form-select" title="Country">
                                                <option value="0">Select Country</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AQ">Antarctica</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AW">Aruba</option>
                                                <option value="AU">Australia</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaijan</option>
                                                <option value="BS">Bahamas</option>
                                                <option value="BH">Bahrain</option>
                                                <option value="BD">Bangladesh</option>
                                                <option value="BB">Barbados</option>
                                                <option value="BY">Belarus</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BZ">Belize</option>
                                                <option value="BJ">Benin</option>
                                                <option value="BM">Bermuda</option>
                                                <option value="BT">Bhutan</option>
                                                <option value="BO">Bolivia</option>
                                                <option value="BW">Botswana</option>
                                                <option value="BV">Bouvet Island</option>
                                                <option value="BR">Brazil</option>
                                                <option value="BN">Brunei Darussalam</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BF">Burkina Faso</option>
                                                <option value="BI">Burundi</option>
                                                <option value="KH">Cambodia</option>
                                                <option value="CM">Cameroon</option>
                                                <option value="CA">Canada</option>
                                                <option value="CV">Cape Verde</option>
                                                <option value="KY">Cayman Islands</option>
                                                <option value="CF">Central African Republic</option>
                                                <option value="TD">Chad</option>
                                                <option value="CL">Chile</option>
                                                <option value="CN">China</option>
                                                <option value="CX">Christmas Island</option>
                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                <option value="CO">Colombia</option>
                                                <option value="KM">Comoros</option>
                                                <option value="CG">Congo</option>
                                                <option value="CK">Cook Islands</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="CI">Cote d'Ivoire</option>
                                                <option value="HR">Croatia (Hrvatska)</option>
                                                <option value="CU">Cuba</option>
                                                <option value="CY">Cyprus</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="DK">Denmark</option>
                                                <option value="DJ">Djibouti</option>
                                                <option value="DM">Dominica</option>
                                                <option value="DO">Dominican Republic</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egypt</option>
                                                <option value="SV">El Salvador</option>
                                                <option value="GQ">Equatorial Guinea</option>
                                                <option value="ER">Eritrea</option>
                                                <option value="EE">Estonia</option>
                                                <option value="ET">Ethiopia</option>
                                                <option value="FK">Falkland Islands (Malvinas)</option>
                                                <option value="FO">Faroe Islands</option>
                                                <option value="FJ">Fiji</option>
                                                <option value="FI">Finland</option>
                                                <option value="FR">France</option>
                                                <option value="GF">French Guiana</option>
                                                <option value="PF">French Polynesia</option>
                                                <option value="GA">Gabon</option>
                                                <option value="GM">Gambia</option>
                                                <option value="GE">Georgia</option>
                                                <option value="DE">Germany</option>
                                                <option value="GH">Ghana</option>
                                                <option value="GI">Gibraltar</option>
                                                <option value="GR">Greece</option>
                                                <option value="GL">Greenland</option>
                                                <option value="GD">Grenada</option>
                                                <option value="GP">Guadeloupe</option>
                                                <option value="GU">Guam</option>
                                                <option value="GT">Guatemala</option>
                                                <option value="GN">Guinea</option>
                                                <option value="GW">Guinea-Bissau</option>
                                                <option value="GY">Guyana</option>
                                                <option value="HT">Haiti</option>
                                                <option value="HN">Honduras</option>
                                                <option value="HK">Hong Kong</option>
                                                <option value="HU">Hungary</option>
                                                <option value="IS">Iceland</option>
                                                <option value="IN">India</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="IQ">Iraq</option>
                                                <option value="IE">Ireland</option>
                                                <option value="IL">Israel</option>
                                                <option value="IT">Italy</option>
                                                <option value="JM">Jamaica</option>
                                                <option value="JP">Japan</option>
                                                <option value="JO">Jordan</option>
                                                <option value="KZ">Kazakhstan</option>
                                                <option value="KE">Kenya</option>
                                                <option value="KI">Kiribati</option>
                                                <option value="KR">Korea, Republic of</option>
                                                <option value="KW">Kuwait</option>
                                                <option value="KG">Kyrgyzstan</option>
                                                <option value="LV">Latvia</option>
                                                <option value="LB">Lebanon</option>
                                                <option value="LS">Lesotho</option>
                                                <option value="LR">Liberia</option>
                                                <option value="LY">Libyan Arab Jamahiriya</option>
                                                <option value="LI">Liechtenstein</option>
                                                <option value="LT">Lithuania</option>
                                                <option value="LU">Luxembourg</option>
                                                <option value="MO">Macau</option>
                                                <option value="MG">Madagascar</option>
                                                <option value="MW">Malawi</option>
                                                <option value="MY">Malaysia</option>
                                                <option value="MV">Maldives</option>
                                                <option value="ML">Mali</option>
                                                <option value="MT">Malta</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MQ">Martinique</option>
                                                <option value="MR">Mauritania</option>
                                                <option value="MU">Mauritius</option>
                                                <option value="YT">Mayotte</option>
                                                <option value="MX">Mexico</option>
                                                <option value="MD">Moldova, Republic of</option>
                                                <option value="MC">Monaco</option>
                                                <option value="MN">Mongolia</option>
                                                <option value="MS">Montserrat</option>
                                                <option value="MA">Morocco</option>
                                                <option value="MZ">Mozambique</option>
                                                <option value="MM">Myanmar</option>
                                                <option value="NA">Namibia</option>
                                                <option value="NR">Nauru</option>
                                                <option value="NP">Nepal</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="AN">Netherlands Antilles</option>
                                                <option value="NC">New Caledonia</option>
                                                <option value="NZ">New Zealand</option>
                                                <option value="NI">Nicaragua</option>
                                                <option value="NE">Niger</option>
                                                <option value="NG">Nigeria</option>
                                                <option value="NU">Niue</option>
                                                <option value="NF">Norfolk Island</option>
                                                <option value="MP">Northern Mariana Islands</option>
                                                <option value="NO">Norway</option>
                                                <option value="OM">Oman</option>
                                                <option value="PW">Palau</option>
                                                <option value="PA">Panama</option>
                                                <option value="PG">Papua New Guinea</option>
                                                <option value="PY">Paraguay</option>
                                                <option value="PE">Peru</option>
                                                <option value="PH">Philippines</option>
                                                <option value="PN">Pitcairn</option>
                                                <option value="PL">Poland</option>
                                                <option value="PT">Portugal</option>
                                                <option value="PR">Puerto Rico</option>
                                                <option value="QA">Qatar</option>
                                                <option value="RE">Reunion</option>
                                                <option value="RO">Romania</option>
                                                <option value="RU">Russian Federation</option>
                                                <option value="RW">Rwanda</option>
                                                <option value="KN">Saint Kitts and Nevis</option>
                                                <option value="LC">Saint LUCIA</option>
                                                <option value="WS">Samoa</option>
                                                <option value="SM">San Marino</option>
                                                <option value="ST">Sao Tome and Principe</option>
                                                <option value="SA">Saudi Arabia</option>
                                                <option value="SN">Senegal</option>
                                                <option value="SC">Seychelles</option>
                                                <option value="SL">Sierra Leone</option>
                                                <option value="SG">Singapore</option>
                                                <option value="SK">Slovakia (Slovak Republic)</option>
                                                <option value="SI">Slovenia</option>
                                                <option value="SB">Solomon Islands</option>
                                                <option value="SO">Somalia</option>
                                                <option value="ZA">South Africa</option>
                                                <option value="ES">Spain</option>
                                                <option value="LK">Sri Lanka</option>
                                                <option value="SH">St. Helena</option>
                                                <option value="PM">St. Pierre and Miquelon</option>
                                                <option value="SD">Sudan</option>
                                                <option value="SR">Suriname</option>
                                                <option value="SZ">Swaziland</option>
                                                <option value="SE">Sweden</option>
                                                <option value="CH">Switzerland</option>
                                                <option value="SY">Syrian Arab Republic</option>
                                                <option value="TW">Taiwan, Province of China</option>
                                                <option value="TJ">Tajikistan</option>
                                                <option value="TZ">Tanzania, United Republic of</option>
                                                <option value="TH">Thailand</option>
                                                <option value="TG">Togo</option>
                                                <option value="TK">Tokelau</option>
                                                <option value="TO">Tonga</option>
                                                <option value="TT">Trinidad and Tobago</option>
                                                <option value="TN">Tunisia</option>
                                                <option value="TR">Turkey</option>
                                                <option value="TM">Turkmenistan</option>
                                                <option value="TC">Turks and Caicos Islands</option>
                                                <option value="TV">Tuvalu</option>
                                                <option value="UG">Uganda</option>
                                                <option value="UA">Ukraine</option>
                                                <option value="AE">United Arab Emirates</option>
                                                <option value="GB">United Kingdom</option>
                                                <option value="US">United States</option>
                                                <option value="UY">Uruguay</option>
                                                <option value="UZ">Uzbekistan</option>
                                                <option value="VU">Vanuatu</option>
                                                <option value="VE">Venezuela</option>
                                                <option value="VN">Viet Nam</option>
                                                <option value="VG">Virgin Islands (British)</option>
                                                <option value="VI">Virgin Islands (U.S.)</option>
                                                <option value="WF">Wallis and Futuna Islands</option>
                                                <option value="EH">Western Sahara</option>
                                                <option value="YE">Yemen</option>
                                                <option value="ZM">Zambia</option>
                                                <option value="ZW">Zimbabwe</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-4 mb-lg-0">
                                            <label class="form-label" for="billing-city">City</label>
                                            <input type="text" class="form-control" id="billing-city" placeholder="Enter City">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-0">
                                            <label class="form-label" for="zip-code">Zip / Postal code</label>
                                            <input type="text" class="form-control" id="zip-code" placeholder="Enter Postal code">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
                <a href="#checkout-shippinginfo-collapse" class="collapsed text-reset" data-bs-toggle="collapse">
                    <div class="p-4">

                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <i class="uil uil-truck text-primary h2"></i>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Shipping Info</h5>
                                <p class="text-muted text-truncate mb-0">Neque porro quisquam est</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                            </div>
                        </div>

                    </div>
                </a>

                <div id="checkout-shippinginfo-collapse" class="collapse">
                    <div class="p-4 border-top">
                        <h5 class="font-size-14 mb-3">Shipping Info</h5>
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="card border rounded active shipping-address">
                                    <div class="card-body">
                                        <a href="#" class="float-end ms-1" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="uil uil-pen font-size-16"></i>
                                        </a>
                                        <h5 class="font-size-14 mb-4">Address 1</h5>

                                        <h5 class="font-size-14">James Morgan</h5>
                                        <p class="mb-1">1557 Sundown Lane Smithville, TX 78957</p>
                                        <p class="mb-0">Mo. 012-345-6789</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card border rounded shipping-address">
                                    <div class="card-body">
                                        <a href="#" class="float-end ms-1" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="uil uil-pen font-size-16"></i>
                                        </a>
                                        <h5 class="font-size-14 mb-4">Address 2</h5>

                                        <h5 class="font-size-14">James Morgan</h5>
                                        <p class="mb-1">1557 Sundown Lane Smithville, TX 78957</p>
                                        <p class="mb-0">Mo. 012-345-6789</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <a href="#checkout-paymentinfo-collapse" class="collapsed text-reset" data-bs-toggle="collapse">
                    <div class="p-4">

                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <i class="uil uil-bill text-primary h2"></i>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Payment Info</h5>
                                <p class="text-muted text-truncate mb-0">Duis arcu tortor, suscipit eget</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                            </div>
                        </div>

                    </div>
                </a>

                <div id="checkout-paymentinfo-collapse" class="collapse">
                    <div class="p-4 border-top">
                        <div>
                            <h5 class="font-size-14 mb-3">Payment method :</h5>

                            <div class="row">

                                <div class="col-lg-3 col-sm-6">
                                    <div data-bs-toggle="collapse">
                                        <label class="card-radio-label">
                                            <input type="radio" name="pay-method" id="pay-methodoption1" class="card-radio-input">

                                            <span class="card-radio text-center text-truncate">
                                                <i class="uil uil-postcard d-block h2 mb-3"></i>
                                                Credit / Debit Card
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6">
                                    <div>
                                        <label class="card-radio-label">
                                            <input type="radio" name="pay-method" id="pay-methodoption2" class="card-radio-input">

                                            <span class="card-radio text-center text-truncate">
                                                <i class="uil uil-paypal d-block h2 mb-3"></i>
                                                Paypal
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6">
                                    <div>
                                        <label class="card-radio-label">
                                            <input type="radio" name="pay-method" id="pay-methodoption3" class="card-radio-input" checked>

                                            <span class="card-radio text-center text-truncate">
                                                <i class="uil uil-money-bill d-block h2 mb-3"></i>
                                                <span>Cash on Delivery</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row my-4">
            <div class="col">
                <a href="ecommerce-products" class="btn btn-link text-muted">
                    <i class="uil uil-arrow-left me-1"></i> Continue Shopping </a>
            </div> <!-- end col -->
            <div class="col">
                <div class="text-end mt-2 mt-sm-0">
                    <a href="#" class="btn btn-success">
                        <i class="uil uil-shopping-cart-alt me-1"></i> Procced </a>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row-->
    </div>
    <div class="col-xl-4">
        <div class="card checkout-order-summary">
            <div class="card-body">
                <div class="p-3 bg-light mb-4">
                    <h5 class="font-size-16 mb-0">Order Summary <span class="float-end ms-2">#MN0124</span></h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-centered mb-0 table-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0" style="width: 110px;" scope="col">Product</th>
                                <th class="border-top-0" scope="col">Product Desc</th>
                                <th class="border-top-0" scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><img src="{{asset('assets/images/product/img-1.png')}}" alt="product-img" title="product-img" class="avatar-md"></th>
                                <td>
                                    <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail" class="text-reset">Nike N012 Running Shoes</a></h5>
                                    <p class="text-muted mb-0">$ 260 x 2</p>
                                </td>
                                <td>$ 520</td>
                            </tr>
                            <tr>
                                <th scope="row"><img src="{{asset('assets/images/product/img-2.png')}}" alt="product-img" title="product-img" class="avatar-md"></th>
                                <td>
                                    <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail" class="text-reset">Adidas Running Shoes</a></h5>
                                    <p class="text-muted mb-0">$ 260 x 1</p>
                                </td>
                                <td>$ 260</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h5 class="font-size-14 m-0">Sub Total :</h5>
                                </td>
                                <td>
                                    $ 780
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h5 class="font-size-14 m-0">Discount :</h5>
                                </td>
                                <td>
                                    - $ 78
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <h5 class="font-size-14 m-0">Shipping Charge :</h5>
                                </td>
                                <td>
                                    $ 25
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h5 class="font-size-14 m-0">Estimated Tax :</h5>
                                </td>
                                <td>
                                    $ 18.20
                                </td>
                            </tr>

                            <tr class="bg-light">
                                <td colspan="2">
                                    <h5 class="font-size-14 m-0">Total:</h5>
                                </td>
                                <td>
                                    $ 745.2
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

@endsection
