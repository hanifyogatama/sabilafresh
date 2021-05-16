<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Pembayaran;

class PaymentController extends Controller
{
    public function notification(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);

        $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . env('MIDTRANS_SERVER_KEY'));

        if ($notification->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }

        $this->initPaymentGateway();
        $statusCode = null;

        $paymentNotification = new \Midtrans\Notification();
        $order = Pemesanan::where('kode', $paymentNotification->order_id)->firstOrFail();

        if ($order->isPaid()) {
            return response(['message' => 'sudah dibayar sebelumnya'], 422);
        }

        $transaction = $paymentNotification->transaction_status;
        $type = $paymentNotification->payment_type;
        $orderId = $paymentNotification->order_id;
        $fraud = $paymentNotification->fraud_status;

        $vaNumber = null;
        $vendorName = null;
        if (!empty($paymentNotification->va_numbers[0])) {
            $vaNumber = $paymentNotification->va_numbers[0]->va_number;
            $vendorName = $paymentNotification->va_numbers[0]->bank;
        }

        $paymentStatus = null;
        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    $paymentStatus = Pembayaran::CHALLENGE;
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    $paymentStatus = Pembayaran::SUCCESS;
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $paymentStatus = Pembayaran::SETTLEMENT;
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $paymentStatus = Pembayaran::PENDING;
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $paymentStatus = Pembayaran::DENY;
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $paymentStatus = Pembayaran::EXPIRE;
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $paymentStatus = Pembayaran::CANCEL;
        }

        $paymentParams = [
            'pemesanan_id' => $order->id,
            'no_pembayaran' => Pembayaran::generateCode(),
            'jumlah' => $paymentNotification->gross_amount,
            'metode' => 'midtrans',
            'status' => $paymentStatus,
            'token' => $paymentNotification->transaction_id,
            'payload' => $payload,
            'tipe_pembayaran' => $paymentNotification->payment_type,
            'nomor_va' => $vaNumber,
            'vendor_pembayaran' => $vendorName,
        ];


        $payment = Pembayaran::create($paymentParams);

        if ($paymentStatus && $payment) {
            \DB::transaction(
                function () use ($order, $payment) {
                    if (in_array($payment->status, [Pembayaran::SUCCESS, Pembayaran::SETTLEMENT])) {
                        $order->status_pembayaran = Pemesanan::PAID;
                        $order->status = Pemesanan::CONFIRMED;
                        $order->save();
                    }
                }
            );
        }

        $message = 'Pembayaran : ' . $paymentStatus;

        $response = [
            'code' => 200,
            'message' => $message,
        ];

        return response($response, 200);
    }

    public function completed(Request $request)
    {
        $code = $request->query('order_id');
        $order = Pemesanan::where('kode', $code)->firstOrFail();

        if ($order->status_pembayaran == Pemesanan::UNPAID) {
            return redirect('payments/failed?order_id=' . $code);
        }

        \Session::flash('success', "Thank you!");

        return redirect('orders/received/' . $order->id);
    }


    public function failed(Request $request)
    {
        $code = $request->query('order_id');
        $order = Pemesanan::where('kode', $code)->firstOrFail();

        \Session::flash('error', "maaf,proses pembayaran gagal");

        return redirect('orders/received/' . $order->id);
    }


    public function unfinish(Request $request)
    {
        $code = $request->query('order_id');
        $order = Pemesanan::where('kode', $code)->firstOrFail();

        \Session::flash('error', "maaf,proses pembayaran tidak bisa dilanjutkan");

        return redirect('orders/received/' . $order->id);
    }
}
