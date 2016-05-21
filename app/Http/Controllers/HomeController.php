<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    private $sum = 0;
    
    public function __construct()
    {
        $this->middleware('auth');
        $sum = 0;
        
         if(!Auth::guest())
        {
            $order=\App\Order::where('user_id', Auth::user()->id)->where('status_order',1)->first();

            $sum = 0;

            foreach(\App\Order_list::where('order_id', $order["id"])->get() as $order_list)
            {   
                // Sum of products in Cart of loged User
                $this->sum=$this->sum+$order_list->price;            
            }
        }     
        /*
        
        if(!Auth::guest())
            $order=\App\Order::where('user_id', Auth::user()->id)->where('status_order',1)->first();
        else
        {
            $order=\App\Order::where('user_id', 0)->where('status_order',1)->first();
            return;
        }
        
        
            
        foreach(\App\Order_list::where('order_id', $order["id"])->get() as $order_list)
        {
            $this->sum=$this->sum+$order_list->price;            
        }*/
    }

    /**
     * Show the application Cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get current Cart
        $order=\App\Order::where('user_id', Auth::user()->id)->where('status_order',1)->first();
        
        $array = array();
        
        // Get ordered products in Cart     
        foreach(\App\Order_list::where('order_id', $order["id"])->get() as $order)
        {
            array_push($array,$order);
        }
        
        // Get all users's Orders
        $myOrders=\App\Order::where('user_id',Auth::user()->id)->get();
        
        // Passes into home view users's all ordered products, current order and its sum
        $data = array(
            'orders' => $array,
            'sum' => $this->sum,
            'myOrders' => $myOrders
        );
        
        return view('home', $data);
    
    }
    
    /**
     * Acion when is deleted item from cart
     *
     * @return \Illuminate\Http\Response
     */
    
    public function delete()
    {
        // Get current Cart
        $order=\App\Order::where('user_id', Auth::user()->id)->where('status_order',1)->first();
        
        // Delete specific ordered product
        DB::table('order_lists')->where('id', $_POST['_productId'])->delete();
        
        $array = array();
        $currentOrder=$order["id"];
                     
        // Get current products according to ordered products
        foreach(\App\Order_list::where('order_id', $order["id"])->get() as $order)
        {
            array_push($array, \App\Product::find($order->product_id));
        }
        
         $sumVat = 0;
        $sumWithoutVat = 0;
        
        // Get current sum of price and price (without VAT)
                
        foreach(\App\Order_list::where('order_id',$currentOrder)->get() as $order_list)
        {    
            $sumVat=$sumVat+$order_list->price;            
            $sumWithoutVat=$sumWithoutVat+$order_list->price_without_vat;
        }
        
        // Updating order's prices
        
        DB::table('orders')
            ->where('id', $currentOrder)
            ->update(array(                        
                        'price' => $sumVat,
                        'price_without_vat' => $sumWithoutVat
                        ));
        
        // Get user's orders
        $myOrders=\App\Order::where('user_id',Auth::user()->id)->where('price','!=',0)->get();
        
        // Passes into home view all ordered products in Cart,  POST headers, user's changed sum
        $data = array(
            'orders' => $array,
            'sum' => $sumVat,
            'myOrders' => $myOrders
        );
        
        $_POST["status_msg"]=1;
        $_POST["status_msg_body"]="Successfully removed from Cart";
        
        return view('home', $data);
    }
    
}
