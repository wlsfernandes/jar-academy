<!-- JAVASCRIPT -->
 <script src="{{ secure_asset('/assets/libs/jquery/jquery.min.js')}}"></script>
 <script src="{{ secure_asset('/assets/libs/bootstrap/bootstrap.min.js')}}"></script>
 <script src="{{ secure_asset('/assets/libs/metismenu/metismenu.min.js')}}"></script>
 <script src="{{ secure_asset('/assets/libs/simplebar/simplebar.min.js')}}"></script>
 <script src="{{ secure_asset('/assets/libs/node-waves/node-waves.min.js')}}"></script>
 <script src="{{ secure_asset('/assets/libs/waypoints/waypoints.min.js')}}"></script>
 <script src="{{ secure_asset('/assets/libs/jquery-counterup/jquery-counterup.min.js')}}"></script>

 @yield('script')

 <!-- App js -->
 <script src="{{ secure_asset('/assets/js/app.min.js')}}"></script>
 
 @yield('script-bottom')