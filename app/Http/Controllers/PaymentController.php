<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('invoice')->paginate(10);
        return view('payments.index', compact('payments')); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount_paid' => 'required|numeric',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
        ]);

        $payment = Payment::create($validatedData);
        return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validatedData = $request->validate([
            'invoice_id' => 'sometimes|exists:invoices,id',
            'amount_paid' => 'sometimes|numeric',
            'payment_date' => 'sometimes|date',
            'payment_method' => 'sometimes|string',
        ]);

        $payment->update($validatedData);
        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}