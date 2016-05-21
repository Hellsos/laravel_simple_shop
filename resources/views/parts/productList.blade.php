@foreach($products as $product)
<li>
    <table width="100%" id="product_list">
        <tr>
            <td>
                {{ $product->name }}
            </td>
            <td width="25%">
                Price: {{ $product->price }}
            </td>
            <td width="30%" align="right">  
            @if (!Auth::guest())
                @if (!Auth::user()->admin)
                    <form id="myForm_{{ $product->id }}" method="POST" action="/">                            
                        <i class="fa fa-shopping-cart" aria-hidden="true" onclick="document.getElementById('myForm_{{ $product->id }}').submit();"></i>    
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_productId" value="{{ $product->id }}">
                        <input type="hidden" name="_name" value="{{ $product->name }}">
                        <input type="hidden" name="_price" value="{{ $product->price }}">
                        <input type="hidden" name="_myFormPriceWithoutVat" value="{{ $product->price_without_vat }}">
                    </form>
                @endif
                @if (!Auth::guest() && Auth::user()->admin)
                    <a href="/edit/{{ $product->id }}">
                        <i class="fa fa-pencil-square-o icon" aria-hidden="true"></i>
                    </a> 
                @endif
            @endif
            <a href="/show/{{ $product->id }}">
                <i class="fa fa-search icon" aria-hidden="true"></i>
            </a>
            @if (!Auth::guest() && Auth::user()->admin)
                <form id="myForm_{{ $product->id }}_del" method="POST" action="/">   
                    <i class="fa fa-trash-o icon" aria-hidden="true" onclick="document.getElementById('myForm_{{ $product->id }}_del').submit();"></i>    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_productId" value="{{ $product->id }}">
                    <input type="hidden" value="DELETE" name="_method">
                </form>
            @endif
            </td>
        </tr>
    </table>
</li>
@endforeach    