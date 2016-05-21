@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">My Cart</div>
                <div class="panel-body">                   
                    <table width="100%" id="product_list" cellpadding="0" cellspacin="0">
                        <tr>
                            <td width="50%">
                                <h2>Content</h2>
                            </td>
                            <td class="leftSide">
                                <h2>My Orders</h2>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                            @foreach ($orders as $order)
                                <form class="cart_items_form" id="myForm_{{ $order->id }}" method="POST" action="/cart">    
                                    <table class="cart_items">
                                        <tr>
                                            <td>
                                                {{ $order->name }} 
                                            </td>
                                            <td width="20%">
                                                Price: {{ $order->price }} 
                                            </td>  
                                            <td width="5%">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_productId" value="{{ $order->id }}">
                                                <input type="hidden" value="DELETE" name="_method">
                                                <i class="fa fa-trash-o" aria-hidden="true" onclick="document.getElementById('myForm_{{ $order->id }}').submit();"></i>    
                                            </td>
                                        </tr>
                                      </table>
                                  </form>
                            @endforeach
                             </td>
                             <td class="leftSide" valign="top">
                                <table width="100%" id="order_list">
                                    <tr>                              
                                        <td class="middleCol">
                                            <b> Price </b>
                                        </td>
                                        <td class="rightCol" width="40%">
                                            <b> Status </b>
                                        </td>
                                        <td width="13%">
                                        </td>
                                    </tr>  
                                </table>                                         
                                @foreach ($myOrders as $order)
                                    <form id="myForm_{{ $order->id }}" method="POST" action="/order">                                      
                                        <table width="100%" id="MyOrder_list" onclick="document.getElementById('myForm_{{ $order->id }}').submit();">
                                            <tr>                                 
                                                <td class="middleCol" width="46%">
                                                    {{ $order->price}}
                                                </td>
                                                <td class="rightCol">
                                                    @if ($order->status_order==0)
                                                        Declined
                                                    @elseif($order->status_order==1)
                                                        Pending
                                                    @else
                                                        Accepted
                                                    @endif   
                                                </td>
                                                <td width="10%">
                                                    <form class="cart_items_form" id="myForm_{{ $order->id }}_order" method="POST" action="/order">   
                                                         <i class="fa fa-share icon" aria-hidden="true" onclick="document.getElementById('myForm_{{ $order->id }}_order').submit();"></i> 
                                                         <input type="hidden" name="_orderId" value="{{ $order->id }}">
                                                         <input type="hidden" value="GET" name="_method">
                                                     </form>
                                                </td>
                                            </tr>
                                        </table>
                                        <input type="hidden" name="_orderId" value="{{ $order->id }}">
                                        <input type="hidden" value="GET" name="_method">
                                    </form>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                    
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
