@extends('layouts.master-without-nav')

@section('title')
    Terms and Conditions
@endsection

@section('content')
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body p-5">

                        <h3 class="text-center mb-4 text-primary">Terms of Service and Privacy Policy</h3>

                        <div class="terms-content mb-4" style="height:400px; overflow-y:auto; border:1px solid #ccc; padding:15px; border-radius:10px;">
                            <h5>Terms of Service</h5>
                            <p>
                                Welcome to our course platform. By registering, you agree to comply with our code of conduct, academic honesty, and all usage policies. You must not misuse the platform to access unauthorized content or disrupt services.
                            </p>
                            <p>
                                We reserve the right to modify these terms at any time. Continued use of the platform after updates constitutes acceptance.
                            </p>

                            <h5>Privacy Policy</h5>
                            <p>
                                We collect and use your personal data solely to provide you with educational services, comply with legal obligations, and improve your experience. 
                            </p>
                            <p>
                                Your information will not be sold or shared without your consent except where required by law.
                            </p>
                            <p>
                                For full details, please review our complete Privacy Policy <a href="{{ url('privacy-policy') }}" target="_blank">here</a>.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('terms.accept') }}">
                            @csrf

                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input @error('accepted_terms') is-invalid @enderror" id="accepted_terms" name="accepted_terms" value="1" required>
                                <label class="form-check-label" for="accepted_terms">
                                    I have read and accept the Terms of Service and Privacy Policy.
                                </label>
                                @error('accepted_terms')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-md waves-effect waves-light">Accept and Continue</button>
                            </div>

                        </form>

                    </div>
                </div>

                <div class="mt-5 text-center">
                    <p>©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Created with ❤️ by DevProMaster
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
