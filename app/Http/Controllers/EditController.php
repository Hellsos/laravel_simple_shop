<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use DB;
class EditController extends Controller
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
        
        $order=\App\Order::where('user_id', Auth::user()->id)->where('status_order',1)->first();
        
        $sum = 0;
            
        foreach(\App\Order_list::where('order_id', $order["id"])->get() as $order_list)
        {   
            // Sum of products in Cart of loged User
            $this->sum=$this->sum+$order_list->price;            
        }
    }

    /**
     * Action when is product's info changed
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {        
        
        // Get all order's which are pending
        $orders=\App\Order::where('status_order',1)->get();
        
        
        // Change product's information
        
         DB::table('products')
            ->where('id', $id)
            ->update(array(
                        'name' => $_POST["_myFormName"],
                        'price' => $_POST["_myFormPrice"],
                        'price_without_vat' => $_POST["_myFormPriceWithoutVat"]
                        ));
        
        
        // Foreach through all orders with status_order 1
        foreach($orders as $order) {
                
                // Change information of specific ordered products
                DB::table('order_lists')
                ->where('product_id', $id)
                ->where('order_id',$order->id)
                ->update(array(                     
                            'name' => $_POST["_myFormName"],
                            'price' => $_POST["_myFormPrice"],
                            'price_without_vat' => $_POST["_myFormPriceWithoutVat"]
                            ));



                $sumVat = 0;
                $sumWithoutVat = 0;

                // Get sum of specific order's products
                foreach(\App\Order_list::where('order_id', $order->id)->get() as $order_list)
                {                       
                    $sumVat=$sumVat+$order_list->price;            
                    $sumWithoutVat=$sumWithoutVat+$order_list->price_without_vat;
                }

                // Change sum of orders which are pending
                DB::table('orders')
                    ->where('id', $order->id)
                    ->update(array(                        
                            'price' => $sumVat,
                            'price_without_vat' => $sumWithoutVat
                            ));
        
        }
        
        // Passes into edit view current product info and current Cart sum, POST headers
        $data = array(
            'product' =>  \App\Product::find($id),
            'sum' => $sumVat
        );

        $_POST["status_msg"]=1;
        $_POST["status_msg_body"]="Successfully Changed";
    
        return view('edit',$data);
        
         
    
    }
    
     /**
     * Show the application Edit (specific product).
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // If is nod loged and admin return message about not being admin
        if(!Auth::user()->admin)
        {            
             $data = array(                
                'sum' => ""
             );

            return view('adminPerm', $data);
        }
       
        
        // Passes into edit view current product info and current Cart sum
         $data = array(
            'product' =>  \App\Product::find($id),
            'sum' => $this->sum
        );

        return view('edit',$data);
        
         
    
    }
}
