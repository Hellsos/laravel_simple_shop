@extends('layouts.app')

@section('content')

<style>
    .leftCol {
        text-align: right;
        padding-right: 20px;
    }
    
    .midCol {
        padding-right: 20px;
    }
    
    .rightCol {
        opacity: 0.6;
    }
    
    .orderList input {
        width: 200px;
        height: 20px;
        background-color: transparent;
        border: 1px solid #CCC;
        padding-left: 10px;
        margin-top: 5px;
    }
    
    #orderPrice {
        margin-top: 20px;
    }
    
    .btnform {
        display: inline-block;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Order</div>
                <div class="panel-body">
                    
                    <b>Id</b> :  {{ $order->id }}<br>
                    <b>Status</b> :
                    @if ($order->status_order==0)
                        Declined
                    @elseif($order->status_order==1)
                        Pending
                    @else
                        Accepted
                    @endif     
                    <br>
                    <br>
                    <b>Products in list</b>
                    
                    <table width="100%" id="product_list">
                        <tr>
                            <td width="33%"  align="center">
                                Name
                            </td>
                            <td width="33%"  align="center">
                                Price (VAT)
                            </td>
                            <td width="33%"  align="center">
                                Price
                            </td>                
                            @if (!Auth::guest() && Auth::user()->admin)
                            <td  align="right">
                            </td>
                            @endif
                        </tr>
                        <tr>
                            <td colspan="3">
                                
                            @foreach ($order_list as $order_item)      
                                <form id="myForm_{{ $order_item->id }}_edit" method="POST" action="/order">      
                                    <table width="100%" class="orderList">
                                        <tr>
                                            <td width="33%" align="center">
                                                 @if (!Auth::guest() && Auth::user()->admin)
                                                    <input name="_myFormName" type="text" value="{{ $order_item->name }}">
                                                 @else                                 
                                                    {{ $order_item->name }}
                                                 @endif
                                            </td>
                                            <td width="33%" align="center">
                                                @if (!Auth::guest() && Auth::user()->admin)
                                                    <input name="_myFormPrice" type="text" value="{{ $order_item->price }}">
                                                 @else                                 
                                                    {{ $order_item->price }}
                                                 @endif
                                            </td>
                                            <td width="33%" align="center">
                                                @if (!Auth::guest() && Auth::user()->admin)
                                                    <input name="_myFormPriceWithoutVat" type="text" value="{{ $order_item->price_without_vat }}">
                                                 @else                                 
                                                    {{ $order_item->price_without_vat }}
                                                 @endif
                                            </td>
                                             @if (!Auth::guest() && Auth::user()->admin)
                                            <td align="right">
                                               <i class="fa fa-floppy-o" aria-hidden="true" onclick="document.getElementById('myForm_{{ $order_item->id }}_edit').submit();"></i> 
                                            </td>
                                            @endif
                                        </tr>                                
                                    </table>
                                    <input type="hidden" name="_orderId" value="{{ $order->id }}">
                                    <input type="hidden" name="_orderListId" value="{{ $order_item->id }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" value="PUT" name="_method">
                                </form>
                            @endforeach
                            </td>
                        </tr>
                    </table>
                    
                    <div id="orderPrice">
                        <b> Total Price :</b> {{ $order->price }}
                    </div>
                
                    <form class="btnform" id="myFormRemove" method="POST" action="/order">      
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input class="submitGrey" type="submit" value="Remove">
                           <input type="hidden" value="DELETE" name="_method">
                           <input type="hidden" name="_orderId" value="{{ $order->id }}">
                    </form>
                    
                     @if (!Auth::guest() && Auth::user()->admin)
                        <form class="btnform" id="myFormAccept" method="POST" action="/order">      
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                               <input class="submitGreen" type="submit" value="Accept">
                               <input type="hidden" value="PUT" name="_method">
                               <input type="hidden" name="_orderId" value="{{ $order->id }}">
                               <input type="hidden" name="_status" value="2">
                        </form>
                    
                        <form class="btnform" id="myForReject" method="POST" action="/order">      
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                               <input class="submitRed" type="submit" value="Reject">
                               <input type="hidden" value="PUT" name="_method">
                               <input type="hidden" name="_orderId" value="{{ $order->id }}">
                               <input type="hidden" name="_status" value="0">
                        </form>
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
