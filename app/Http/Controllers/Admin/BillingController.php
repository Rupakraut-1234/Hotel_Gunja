<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Booking;
   use Carbon\Carbon;
use App\Models\RoomCategory;

class BillingController extends Controller
{
public function generateBill($bookingId)
{
    $booking = Booking::with('bookable.plans')->findOrFail($bookingId);

    $total = 0;

    // Calculate nights
    $checkIn = Carbon::parse($booking->check_in);
    $checkOut = Carbon::parse($booking->check_out);
    $nights = $checkIn->diffInDays($checkOut);

    // If booking is room category
    if ($booking->bookable instanceof RoomCategory) {

        $plan = $booking->bookable->plans->first();

        if ($plan) {
            $total = $plan->price_per_night * $nights;
        }
    }

    $discount = 0;
    $tax = $total * 0.12; // 12% VAT
    $net = $total - $discount + $tax;

    $bill = Bill::create([
        'booking_id' => $booking->id,
        'total_amount' => $total,
        'discount' => $discount,
        'tax' => $tax,
        'net_amount' => $net,
        'generated_by' => auth()->id(),
    ]);

    return redirect()->back()->with('success', 'Bill generated successfully.');
}
}

