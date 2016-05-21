<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use DB;
class IndexController extends Controller
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
     * Show the application Index page with all products and orders.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
   
        // Passes into Welcome view all Products, Orders which do not have 0 price ( atleast one product in Cart ), users and user's sum
        
        $data = array(
            'products' =>  \App\Product::all(),
            'orders' => \App\Order::where('price','!=','0')->get(),
            'users' =>  \App\User::all(),
            'sum' => $this->sum
        );

        return view('welcome',$data);
        
    }
    
     /**
     * Acion when is added item into cart
     *
     * @return \Illuminate\Http\Response
     */
    
    public function post()
    {
        
        // Get current Cart
        $order=\App\Order::where('user_id', Auth::user()->id)->where('status_order',1)->first();
                
        // If is firstOrder true (in DB doesnot exist ID of order)
        $firstOrder=true;
        
        
        // If exists current Cart in DB firstOrder is false
        if($order["id"])
            $firstOrder=false;        
       
        $id=0;
        
        
        if($firstOrder)
        {
            // Inserts new order into db and returns its Id into $id
            
            $id = DB::table('orders')->insertGetId(
                array(
                    'user_id' => Auth::user()->id,
                    'status_order' => 1,
                    'price' => $_POST['_price'],
                    'price_without_vat' => $_POST['_myFormPriceWithoutVat'],
                )
            );
        }
        else
        {
            // $id is current order Id
            $id=$order["id"];
        }
        
        
        
        // Inserts ordered product into product list        
        DB::table('order_lists')->insert(
                array(
                    'order_id' => $id,
                    'product_id' => $_POST['_productId'],
                    'name' => $_POST['_name'],
                    'price' => $_POST['_price'],
                    'price_without_vat' => $_POST['_myFormPriceWithoutVat'],
                )
            );
      
        
        
        
        
        $sumVat = 0;
        $sumWithoutVat = 0;
        
        // Fetching all orders according to current Id
        
        foreach(\App\Order_list::where('order_id', $id)->get() as $order_list)
        {   
            // Getting information from products about product
            $orderList =\App\Product::find($order_list->product_id); 
            // Increasing price into variable total price (with VAT)
            $sumVat=$sumVat+$orderList->price;           
            // Increasing price into variable total price
            $sumWithoutVat=$sumWithoutVat+$orderList->price_without_vat;
        }
        
        // Updating order's prices
        
         DB::table('orders')
            ->where('id', $order["id"])
            ->update(array(                        
                        'price' => $sumVat,
                        'price_without_vat' => $sumWithoutVat
                        ));
        
        // Passes into Welcome view all Products, Orders which do not have 0 price ( atleast one product in Cart ), users and user's changed sum
        $data = array(
            'products' =>  \App\Product::all(),
            'orders' => \App\Order::where('price','!=','0')->get(),
            'users' =>  \App\User::all(), 
            'sum' => $sumVat
            
        );
        
        $_POST["status_msg"]=1;
        $_POST["status_msg_body"]="Successfully added to Cart";

        return view('welcome',$data);
    }
    
    public function delete()
    {        

        // Deleting product from products
        DB::table('products')->where('id', $_POST['_productId'])->delete();
        
        // Passes into Welcome view all Products, Orders which do not have 0 price ( atleast one product in Cart ), users and user's sum
        $data = array(
            'products' =>  \App\Product::all(),
            'orders' => \App\Order::where('price','!=','0')->get(),
            'users' =>  \App\User::all(),
            'sum' => $this->sum
            
        );
        
        $_POST["status_msg"]=1;
        $_POST["status_msg_body"]="Product Successfully removed";

        return view('welcome',$data);
    }
}
