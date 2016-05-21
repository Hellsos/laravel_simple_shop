<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use DB;
class CreateController extends Controller
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
     * Show the application Create.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // If is nod loged and admin return message about not being admin
        if(!Auth::user()->admin)
        {            
             $data = array(                
                'sum' => ""
             );

            return view('adminPerm', $data);
        }
        
        // Passes into create view current Cart sum
         $data = array(
            'sum' => $this->sum
        );

        return view('create',$data);
            
    }
    
    /**
     * Action when new product is created
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function post()
    {
        // Insert new product into DB
        DB::table('products')->insert(
                array(
                    'name' => $_POST["_myFormName"],
                    'price' => $_POST["_myFormPrice"],
                    'price_without_vat' => $_POST["_myFormPriceWithoutVat"]
                )
            );
        
         // Passes into Welcome view all Products, Orders which do not have 0 price ( atleast one product in Cart ), users and user's sum
          $data = array(
            'products' =>  \App\Product::all(),
            'orders' => \App\Order::where('price','!=','0')->get(),
            'users' =>  \App\User::all(),
            'sum' => $this->sum
        );
        
        $_POST["status_msg"]=1;
        $_POST["status_msg_body"]="Product Successfully Created";

        return view('welcome',$data);
    }
}
