<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\models\Message;
use Facade\FlareClient\Http\Response;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Facades\PayPal;

class HouseController extends Controller
{
    function index()
    {
        //return view('home.index');
        return view('payment');
    }


    function contact()
    {
        $id = 3;
        return view('contact.index', ['id' => $id]);
    }

    function about()
    {
        return view('about.index');
    }

    function store(Request $request)
    {

        return $request->input();
        //   $request->validate([
        //     'email'=>'required|email',
        //     'message'=>'required|max:224',
        //     'name'=>'required|max:123'
        //   ]);

        // $rules = [
        //     'email'=>'required|email',
        //     'message'=>'required|max:224',
        //     'name'=>'required|max:123'
        // ];

        // $message = [
        //     'email.required' => 'We need to know your email',
        //     'email.email'=> 'Please provide a valid email address',
        //     'message.required'=> 'Please add a message for us',
        //     'name.required'=> 'Please Enter your name'
        // ];

        // $validate = validator::make($request->input(),$rules,$message);

        // if($validate->fails()) return ['errors' => $validate->getMessageBag(),'success'=>false];

        //   $messages = new Message;
        //   $messages->name = $request->name;
        //   $messages->email = $request->email;
        //   $messages->message = $request->message;
        //   $messages->save();

        //   return ['message'=>'Message is send We will reach you shortly !','success'=>true];


    }

    public function cart()
    {
       echo "your order is cancel";
    }

    public function successOrder()
    {
        echo "your order is successfull";
    }

    public function payment()
    {
        $provider = new ExpressCheckout;


        $data = [];
        $data['items'] = [
            [
                'name' => 'Product 1',
                'price' => 1.5,
                'desc'  => 'Description for product 1',
                'qty' => 1
            ],
            [
                'name' => 'Product 2',
                'price' => 2,
                'desc'  => 'Description for product 2',
                'qty' => 2
            ]
        ];


        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = url('/payment/success');
        $data['cancel_url'] = url('/cart');

        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }



        $data['total'] = $total;

        //give a discount of 10% of the order amount
        //  $data['shipping_discount'] = round((10 / 100) * $total, 2);

        $response = $provider->setExpressCheckout($data);


        return redirect($response['paypal_link']);


    }
}
