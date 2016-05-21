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
    
   
</style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Item</div>
                
                
                
                <form id="myForm" method="POST" action="/edit/{{ $product->id }}">  
                <div class="panel-body">
                    <table>
                        <tr>
                            <td class="leftCol">
                                <b>Id</b> :
                            </td>
                            <td>
                                 {{ $product->id }}
                            </td>
                            <td class="rightCol"> 
                            </td>
                        </tr>
                        <tr>
                            <td class="leftCol">
                                <b>Name</b> :
                            </td>
                            <td class="midCol">
                                <input name="_myFormName" type="text" value="{{ $product->name }}">
                            </td>
                            <td class="rightCol"> 
                            </td>
                        </tr>
                        <tr>
                            <td class="leftCol">
                                <b>Price</b> :
                            </td>
                            <td>
                                <input name="_myFormPrice" type="text" value="{{ $product->price }}">
                            </td>
                            <td class="rightCol"> 
                                (VAT)
                            </td>
                        </tr>
                        <tr>
                            <td class="leftCol">
                                <b>Price</b> :
                            </td>
                            <td>
                                <input name="_myFormPriceWithoutVat" type="text" value="{{ $product->priceWithoutVat }}">
                            </td>
                            <td class="rightCol"> 
                                (Without VAT)
                            </td>
                        </tr>
                    </table> 
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       <input type="submit" value="Update">
                       <input type="hidden" value="PUT" name="_method">
                </div>
                </form>
                 @if(isset($_POST["status_msg"]))
                        @if($_POST["status_msg"]==1)
                            <table class="status_msg"><tr><td><i class="fa fa-check-circle-o green" aria-hidden="true"></i></td><td><b>{{ $_POST["status_msg_body"] }}</b></td></tr></table>
                        @endif
                    @endif
               
            </div>
        </div>
    </div>
</div>
@endsection
