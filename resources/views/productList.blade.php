@foreach($products as $product)
                                <li>
                                    <table width="100%" id="product_list">
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td width="25%">Price: {{ $product->price }}</td>
                                            <td width="30%">  
                                                @if (!Auth::guest())
                                                <form id="myForm_{{ $product->id }}" method="POST" action="/">                            
                                                
                                                 
                                                <i class="fa fa-shopping-cart" aria-hidden="true" onclick="document.getElementById('myForm_{{ $product->id }}').submit();"></i>    
                                                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="_productId" value="{{ $product->id }}">
                                                    <input type="hidden" name="_name" value="{{ $product->name }}">
                                                    <input type="hidden" name="_price" value="{{ $product->price }}">
                                                    <input type="hidden" name="_priceWithoutVat" value="{{ $product->priceWithoutVat }}">
                                                </form>
                                                 @if (!Auth::guest() && Auth::user()->admin)
                                                 <a href="/edit/{{ $product->id }}">
                                                    <i class="fa fa-pencil-square-o icon" aria-hidden="true"></i>
                                                 </a> 
                                                 @endif
                                                @endif
                                                <a href="/show/{{ $product->id }}">
                                                    <i class="fa fa-search icon" aria-hidden="true"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    </table>
                                </li>
                                @endforeach    