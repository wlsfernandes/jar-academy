<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PayPalController extends Controller
{
    /**
     * Create a PayPal order for payment.
     */

    public function createPayment($id)
    {

        $course = Course::where('institution_id', Auth::user()->institution_id)
            ->findOrFail($id);
        $amount = $course->amount;

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setAccessToken($provider->getAccessToken());

        // Create an order with PayPal
        $response = $provider->createOrder([
            "intent" => "CAPTURE", // Indicates that payment will be captured immediately
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "BRL", // Currency set to BRL
                        "value" => $amount, // The amount to charge
                    ]
                ]
            ],
            "application_context" => [
                "return_url" => route('paypal.capture'), // Redirects here after approval
                "cancel_url" => route('test.paypal') // Redirects here if user cancels
            ]
        ]);

        // Redirect the user to PayPal to approve the payment
        if (isset($response['id']) && isset($response['links'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect($link['href']);
                }
            }
        }

        // If something goes wrong, redirect back with an error
        return redirect()->back()->withErrors('Something went wrong while creating the payment.');
    }

    /**
     * Capture the payment after user approval.
     */
    public function capturePayment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setAccessToken($provider->getAccessToken());

        try {
            // Capture the payment using the token from PayPal
            $response = $provider->capturePaymentOrder($request->query('token'));

            // Check if the payment was successful
            if (isset($response['status']) && $response['status'] === 'COMPLETED') {
                return redirect()->route('courses.listCourses')->with('success', 'Payment successful.');
            }

            // If the payment was not completed, handle the error
            return redirect()->route('courses.listCourses')->withErrors('Payment failed. Please try again.');
        } catch (Exception $e) {
            // Handle exceptions and display error messages
            return redirect()->route('courses.listCourses')->withErrors('An error occurred: ' . $e->getMessage());
        }
    }
}
