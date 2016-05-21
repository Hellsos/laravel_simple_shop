<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use DB;
class ShowController extends Controller
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
     * Show the application Show (specific product).
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
        // Passes into show specific product and current user's price
         $data = array(
            'product' =>  \App\Product::find($id),
            'sum' => $this->sum
        );

        return view('show',$data);
        
         
    
    }
}
