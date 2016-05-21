@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Item</div>                
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
                                {{ $product->name }}
                            </td>
                            <td class="rightCol"> 
                            </td>
                        </tr>
                        <tr>
                            <td class="leftCol">
                                <b>Price</b> :
                            </td>
                            <td>
                                {{ $product->price }}
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
                                {{ $product->price_without_vat }}
                            </td>
                            <td class="rightCol"> 
                                (Without VAT)
                            </td>
                        </tr>
                    </table>                          
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
