<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Session;
use Validator;

use App\Student;
use App\Guest;
use App\Investasi;
use App\Investasi_project;
use App\Investasi_funding;
use App\Order;
use App\Payment;


class InvestasiController extends Controller
{
    
    public function showProjectIndex()
    {
        $investasiCount = DB::table('investasi_project')
                        ->where('status', '=', 1)
                        ->count();

        $investasi = DB::table('investasi_project')
                        ->join('investee', 'investee.id', 'investasi_project.investee_id')
                        ->select('investasi_project.*', 'investee.nama as nama_investee')
                        ->where('investasi_project.status', '=', 1)
                        ->paginate(8);

        return view('investasi-project-list')->with('investasis', $investasi)->with('investasiCount', $investasiCount);
    }

    public function detailProject($id)
    {
        $where = [
            'investasi_project.id' => $id,
            'investasi_project.status' => 1,
        ];

        $investasi = DB::table('investasi_project')
                        ->join('investee', 'investee.id', 'investasi_project.investee_id')
                        ->select('investasi_project.*', 'investee.nama as nama_investee')
                        ->where($where)
                        ->first();

        return view('investasi-project-detail')->with('investasi', $investasi);
    }

    public function showFundIndex()
    {
        $investasiCount = DB::table('investasi_funding')
            ->where('status', '=', 1)
            ->count();

        $investasi = DB::table('investasi_funding')
                ->join('investee', 'investee.id', 'investasi_funding.investee_id')
                ->select('investasi_funding.*', 'investee.nama as nama_investee')
                ->where('investasi_funding.status', '=', 1)
                ->paginate(8);

        return view('investasi-funding-list')->with('investasis', $investasi)->with('investasiCount', $investasiCount);
    }

    public function detailFund($id)
    {
        $where = [
            'investasi_funding.id' => $id,
            'investasi_funding.status' => 1,
        ];

        $investasi = DB::table('investasi_funding')
                        ->join('investee', 'investee.id', 'investasi_funding.investee_id')
                        ->select('investasi_funding.*', 'investee.nama as nama_investee')
                        ->where($where)
                        ->first();

        return view('investasi-funding-detail')->with('investasi', $investasi);
    }

    // midtrans initializer
    protected function _initPaymentGateway()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server--5w-DiJiV2WQ_vcgFYlGZZ8Y';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }

    protected function _nextStudentProjectInvoiceNumber()
    {
        $where = [
            'tipe_investasi' => 'project',
            'role' => 'student',
        ];

        $lastOrder = Order::where($where)->orderBy('created_at', 'desc')->first();

        if($lastOrder){

            $lastInvoice = explode("/", $lastOrder->invoice);

            return $lastInvoice[1] + 1;
        }else{
            
            return 1;
        }
    }

    protected function _nextGuestProjectInvoiceNumber()
    {
        $where = [
            'tipe_investasi' => 'project',
            'role' => 'guest',
        ];

        $lastOrder = Order::where($where)->orderBy('created_at', 'desc')->first();

        if($lastOrder){

            $lastInvoice = explode("/", $lastOrder->invoice);

            return $lastInvoice[1] + 1;
        }else{

            return 1;
        }
        
        

        $lastInvoice = explode("/", $lastOrder->invoice);

        return $lastInvoice[1] + 1;
    }



    public function beliSaham(Request $request, $id_inv)
    {
        // cek jumlah lembar yang tersedia
        $investasi = Investasi_project::where('investasi_project.id', '=', $id_inv)
                    ->join('investee', 'investee.id', 'investee_id')
                    ->select('investasi_project.*', 'investee.nama as nama_investee', 'investee.id as investee_id')
                    ->first();
        
        $lembar_sisa = $investasi->lembar_total - $investasi->lembar_terbeli;
        if ($request->input('lembar_beli') > $lembar_sisa){
            Session::flash('error', 'Tidak dapat membeli sebanyak '.$request->input('lembar_beli').', hanya tersisa '.$lembar_sisa.' lembar');
            return redirect()->back();
        }else{
            $investasi->lembar_terbeli = $investasi->lembar_terbeli + $request->input('lembar_beli');
            $investasi->save();
        }

        $id_pembeli = $request->session()->get('id');

        $validator = Validator::make($request->all(),[
            'lembar_beli' => 'required',
            'termspolicy' => 'required',
        ]);

        if ($validator->fails()){
            Session::flash('error', $validator->errors()->first());
            return redirect()->back();
        }

        if ($request->session()->get('role') == 'student'){

            //ambil data student
            $student = Student::where('id', '=', $id_pembeli)->first();

            $this->_initPaymentGateway();
            
            $redirectSnap = '';

            \DB::transaction(function() use ($request, $student, $investasi, &$redirectSnap){

                 // INV/#/STD/YYYYMMDD
                $nextInvNum = $this->_nextStudentProjectInvoiceNumber();
                $newInvoice = 'INV/'. $nextInvNum . '/ST/' . date("Ymd");

                $order = Order::create([
                    'invoice' => $newInvoice,
                    'nama_investor' => $student->name,
                    'email_investor' => $student->email,
                    'id_investor' => $student->id,
                    'role' => 'student',

                    'tipe_investasi' => 'project',
                    'investasi_id' => $request->input('project_id'),
                    'nama_investasi' => $investasi->nama_investasi,
                    'nama_investee' => $investasi->nama_investee,
                    'id_investee' => $investasi->investee_id,

                    'lembar_beli' => $request->input('lembar_beli'),
                    'total_harga' => $request->input('total_harga'),
                    
                    'order_date' => NULL,
                    'payment_due' => NULL,
                ]);

                $params = [
                    'transaction_details' => [
                        'order_id' => $order->invoice,
                        'gross_amount' => $order->total_harga,
                    ],
                    'customer_details' => [
                        'first_name' => $order->nama_investor,
                        'last_name' => '',
                        'email' => $order->email_investor,
                        'phone' => $student->mobile_no,
                    ],
                ];
                
                $responseAPI = \Midtrans\Snap::createTransaction($params);
                // $responseAPI = json_decode($snapToken);
               
                // dd($snapToken);
                $redirectSnap = $responseAPI->redirect_url;

                $order->snap_token = $responseAPI->token;
                $order->save();
            });

            // dd($redirectSnap);
            return redirect($redirectSnap);

        }else if ($request->session()->get('role') == 'guest'){
            
            $guest = Guest::where('id', '=', $id_pembeli)->first();

            $this->_initPaymentGateway();
            
            $redirectSnap = '';

            \DB::transaction(function() use ($request, $guest, $investasi, &$redirectSnap){

                // INV/#/STD/YYYYMMDD
               $nextInvNum = $this->_nextGuestProjectInvoiceNumber();
               $newInvoice = 'INV/'. $nextInvNum . '/GS/' . date("Ymd");

               $order = Order::create([
                   'invoice' => $newInvoice,
                   'nama_investor' => $guest->name,
                   'email_investor' => $guest->email,
                   'id_investor' => $guest->id,
                   'role' => 'guest',

                   'tipe_investasi' => 'project',
                   'investasi_id' => $request->input('project_id'),
                   'nama_investasi' => $investasi->nama_investasi,
                   'nama_investee' => $investasi->nama_investee,
                   'id_investee' => $investasi->investee_id,

                   'lembar_beli' => $request->input('lembar_beli'),
                   'total_harga' => $request->input('total_harga'),
                   
                   'order_date' => NULL,
                   'payment_due' => NULL,
               ]);

               $params = [
                   'transaction_details' => [
                       'order_id' => $order->invoice,
                       'gross_amount' => $order->total_harga,
                   ],
                   'customer_details' => [
                       'first_name' => $order->nama_investor,
                       'last_name' => '',
                       'email' => $order->email_investor,
                       'phone' => $guest->mobile_no,
                   ],
               ];
               
               $responseAPI = \Midtrans\Snap::createTransaction($params);
               // $responseAPI = json_decode($snapToken);
              
               // dd($snapToken);
               $redirectSnap = $responseAPI->redirect_url;

               $order->snap_token = $responseAPI->token;
               $order->save();
           });
           
           return redirect($redirectSnap);

        }

        //tanggal deadline => kayaknya ini nanti dari api midtrans bisa di set
        // $duedate = new \DateTime('+2 day');
        // $duedate->format('Y-m-d');

        // try{
        //     $data = [
        //         'student_id' => $id_student,
        //         'investasi_id' => $id_inv,
        //         'status_bayar' => '0',
        //         'status_uang_balik' => '2',
        //         'lembar_beli' => $request->input('lembar_beli'),
        //         'berkas_bukti_pembayaran' => 'belum upload',
        //         'expired_at' => $duedate->format('Y-m-d'),
        //         'updated_at' => \Carbon\Carbon::now(),
        //         'created_at' => \Carbon\Carbon::now(),
        //     ];
        //     DB::table('investasi_student')->insert($data);
        //     Session::flash('success', 'Silahkan segera upload bukti transfer sebelum tanggal '.$duedate->format('Y-m-d').' pukul 24.00');
        //     return redirect()->back();
        // }catch(\Illuminate\Database\QueryException $e)
        // {
        //   $errorCode = $e->errorInfo[1];
        //   $errorMsg = $e->errorInfo[2];
        //   if ($errorCode == 1062) {
        //       return redirect('/');
        //   }
        //   Session::flash('error', $errorMsg);
        //   return redirect()->back();
        // }

    }

    public function donasi(Request $request, $id_inv)
    {
        dd($request, $id_inv);
    }

    protected function _updateHapusLembarBeli($investasi_id, $lembar)
    {
        $investasi = Investasi_project::where('id', '=', $investasi_id)->first();

        $investasi->lembar_terbeli = $investasi->lembar_terbeli - $lembar;
        $investasi->save();

    }

    public function notificationHandler(Request $request)
    {
        // veryvy signature key
        $payload = $request->getContent();
        $notification = json_decode($payload);

        $validKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . 'SB-Mid-server--5w-DiJiV2WQ_vcgFYlGZZ8Y');

        if ($notification->signature_key != $validKey) {
            return response(['message' => 'Invalid signature'], 403);
        }

        $this->_initPaymentGateway();
        
        $paymentNotification = new \Midtrans\Notification();
        $order = Order::where('invoice', '=', $paymentNotification->order_id)->firstOrFail();

        if ($order->status == 'Paid'){
            return response(['message' => 'Order has been paid'], 403);
        }

        $transaction = $paymentNotification->transaction_status;
        $type = $paymentNotification->payment_type;
        $orderId = $paymentNotification->order_id;
        $fraud = $paymentNotification->fraud_status;

        $paymentStatus = null;

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    $paymentStatus = 'Challenge';
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    $paymentStatus = 'Success';
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $paymentStatus = 'Paid';
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $paymentStatus = 'Pending';
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $paymentStatus = 'Deny';

            if ($order->tipe_investasi == 'project'){
                $this->_updateHapusLembarBeli($order->investasi_id, $order->lembar_beli);
            }
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $paymentStatus = 'Expire';

            if ($order->tipe_investasi == 'project'){
                $this->_updateHapusLembarBeli($order->investasi_id, $order->lembar_beli);
            }
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $paymentStatus = 'Cancel';

            if ($order->tipe_investasi == 'project'){
                $this->_updateHapusLembarBeli($order->investasi_id, $order->lembar_beli);
            }

        }
        

        //create notification record => gak jadi pake notification order, payload langsung disimpen di order
        // try{
        //     DB::table('payment_notifications')->insert([
        //         'invoice' => $order->invoice,
        //         'amount' => $paymentNotification->gross_amount,
        //         'method' => 'midtrans',
        //         'status' => $paymentStatus,
        //         'token' => $paymentNotification->transaction_id,
        //         'payload' => $payload,
        //         'payment_type' => $paymentNotification->payment_type,
        //         'va_number' => $vaNumber,
        //         'vendor_name' => $vendorName,
        //         'biller_code' => $paymentNotification->biller_code,
        //         'bill_key' => $paymentNotification->bill_key
        //     ]);
        //     Payment::create([
        //         'invoice' => $order->invoice,
        //         'amount' => $paymentNotification->gross_amount,
        //         'method' => 'midtrans',
        //         'status' => $paymentStatus,
        //         'token' => $paymentNotification->transaction_id,
        //         'payload' => $payload,
        //         'payment_type' => $paymentNotification->payment_type,
        //         'va_number' => $vaNumber,
        //         'vendor_name' => $vendorName,
        //         'biller_code' => $paymentNotification->biller_code,
        //         'bill_key' => $paymentNotification->bill_key,
        //     ]);
        // }
        // catch(\Illuminate\Database\QueryException $e)
        // {
        //     $errorCode = $e->errorInfo[1];
        //     $errorMsg = $e->errorInfo[2];
        //     return response(['message' => $errorMsg], $errorCode);
        // }

        

        \DB::transaction(function() use ($order, $paymentStatus, $payload){
            $order->status = $paymentStatus;
            $order->payload = $payload;
            $order->save();
        });
        
        

        $message = 'Payment Status : '. $paymentStatus;
        $response = [
            'code' => 200,
            'message' => $message,
        ];

        return response($response, 200);
    }
}
