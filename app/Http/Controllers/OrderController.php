<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use DB;
class OrderController extends Controller
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
    }

    /**
     * Show the application Order.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // If is not in POST variable with order id redirects to welcome view
        if(!isset($_POST["_orderId"]))
        {
            $data = array(
                'products' =>  \App\Product::all(),
                'orders' => \App\Order::all(),
                'users' =>  \App\User::all(),
                'sum' => $this->sum
            );

            return view('welcome',$data);
        }
            
        // Passes into order view order information, order's products, sum
         $data = array(
            'order' =>  \App\Order::find($_POST["_orderId"]),
            'order_list' => \App\Order_list::where('order_id',$_POST["_orderId"])->get(),
            'sum' => $this->sum
        );

        return view('order',$data);
        
         
    
    }
    
    /**
     * Action when order is deleted
     *
     * @return \Illuminate\Http\Response
     */
    
    public function delete()
    {
         // If is not in POST variable with order id redirects to welcome view
        if(!isset($_POST["_orderId"]))
        {
            $data = array(
                'products' =>  \App\Product::all(),
                'orders' => \App\Order::all(),
                'users' =>  \App\User::all(),
                'sum' => $this->sum
            );

            return view('welcome',$data);
        }
        
        // Delete specific Order
        
        DB::table('orders')->where('id', $_POST['_orderId'])->delete();    
        
        // Passes into Welcome view all Products, Orders which do not have 0 price ( atleast one product in Cart ), users and user's changed sum
        
        $data = array(
                'products' =>  \App\Product::all(),
                'orders' => \App\Order::all(),
                'users' =>  \App\User::all(),
                'sum' => $this->sum
            );
        
        $_POST["status_msg"]=1;
        $_POST["status_msg_body"]="Order Successfully removed";

        return view('welcome',$data);
        
    
    }
    
    /**
     * Action when is order updated
     *
     * @return \Illuminate\Http\Response
     */
    
    public function update()
    {
        
        // If is not in POST variable with order id redirects to welcome view
        if(!isset($_POST["_orderId"]))
        {
            $data = array(
                'products' =>  \App\Product::all(),
                'orders' => \App\Order::all(),
                'users' =>  \App\User::all(),
                'sum' => $this->sum,
                'tempsss' => 0
            );

            return view('welcome',$data);
        }
        
        
        
        if(!isset($_POST["_myFormName"]))
        {
        
            // Editing Order (accept, decline)
        
            // Update orders status to specific _status ( _status=1 -> Accepted, _status=2 -> Declined )
             DB::table('orders')
                ->where('id', $_POST["_orderId"])
                ->update(array(                        
                            'status_order' => $_POST["_status"]
                            ));

            
            $_POST["status_msg"]=1;
            
            
            if($_POST["_status"]==1)
                $_POST["status_msg_body"]="Order Successfully Accepted";        
            else
                $_POST["status_msg_body"]="Order Successfully Declined";



            // Passes into Welcome view all Products, Orders which do not have 0 price ( atleast one product in Cart ), users and user's changed sum
            $data = array(
                    'products' =>  \App\Product::all(),
                    'orders' => \App\Order::where('price','!=','0')->get(),
                    'users' =>  \App\User::all(),
                    'sum' => $this->sum
                );
            return view('welcome',$data);
        
        }
        else
        {
         
            // Editing Order's product's info
            
            DB::table('order_lists')            
            ->where('id',$_POST["_orderListId"])
            ->update(array(                     
                        'name' => $_POST["_myFormName"],
                        'price' => $_POST["_myFormPrice"],
                        'price_without_vat' => $_POST["_myFormPriceWithoutVat"]
                        ));
            
            // Getting sum of specific Order
            $sumVat = 0;
            $sumWithoutVat = 0;

            
            foreach(\App\Order_list::where('order_id', $_POST["_orderId"])->get() as $order_list)
            {   
                $sumVat=$sumVat+$order_list->price;            
                $sumWithoutVat=$sumWithoutVat+$order_list->price_without_vat;
            }

            // Update specific Order's prices
            DB::table('orders')
                ->where('id',$_POST["_orderId"])
                ->update(array(                        
                            'price' => $sumVat,
                            'price_without_vat' => $sumWithoutVat
                            ));

            $_POST["status_msg"]=1;
            $_POST["status_msg_body"]="Product in cart Successfully Changed";

             // Passes into order view order information, order's products, sum
             $data = array(
                'order' =>  \App\Order::find($_POST["_orderId"]),
                'order_list' => \App\Order_list::where('order_id',$_POST["_orderId"])->get(),
                'sum' => $this->sum
            );

            return view('order',$data);
            
        }
    
    }
}
