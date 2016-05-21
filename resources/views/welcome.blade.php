@extends('layouts.app')

@section('content')

 <style>
        
            ul li {
                text-align: left;
                 font-family: 'Arial';   
                list-style-type: none
            }
            
            ul {
                padding-left: 20px;
                padding-right: 20px;
            }
            
            .leftSide {
                border-left: 3px solid #CCC;
            }
            
            .icon {
                margin-left: 20px;
            }
            
            table {
                font-family: 'Arial';      
            }
     form {
         display: inline-block;
     }
     
     #product_list .fa {
         cursor: pointer;
         color: #337ab7;
         
     }
     
     #order_list {
         margin-left: 20px;
     }
    #order_list .fa{ 
         cursor: pointer;
         color: #337ab7;        
     }
     
     #order_list .middleCol {
         text-align: center;
     }
      #order_list .rightCol {
         text-align: center;
     }
        </style>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Main Page</div>
               
                <div class="panel-body">
                     @if (Auth::guest())
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <h2>Products</h2>
                                </td>
                            </tr>
                            <tr>         
                                <td valign="top">                            
                                    <ul>
                                        @include('parts/productList', array('products'=>$products))
                                    </ul>                           
                                </td>
                            </tr>
                        </table>  
                    @else
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center" width="50%">
                                    <h2>Products</h2>
                                </td>
                                <td class="leftSide" align="center" width="50%">
                                    <h2>Orders</h2>
                                </td>
                            </tr>
                            <tr>         
                                <td valign="top">                            
                                    <ul>
                                        @include('parts/productList', array('products'=>$products))
                                    </ul>
                                    @if (!Auth::guest() && Auth::user()->admin)
                                        <a href="/create"> Create new Product </a>
                                    @endif
                                </td>
                                <td class="leftSide" valign="top">
                                     @include('parts/orderList', array('orders'=>$orders))
                                </td>
                            </tr>
                        </table>  
                    @endif
                    
                    @if(isset($_POST["status_msg"]))
                        @if($_POST["status_msg"]==1)
                            <table class="status_msg"><tr><td><i class="fa fa-check-circle-o green" aria-hidden="true"></i></td><td><b>{{ $_POST["status_msg_body"] }}</b></td></tr></table>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
