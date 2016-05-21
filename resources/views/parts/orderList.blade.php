<table width="100%" id="order_list">
    <tr>
        <td>
            <b> Owner </b>
        </td>
        <td class="middleCol">
            <b> Price </b>
        </td>
        <td class="rightCols">
            <b> Status </b>
        </td>
        @if (!Auth::guest() && Auth::user()->admin)
        <td></td>
        @endif
    </tr>
    @foreach ($orders as $order)
    <tr>
        <td>
            @foreach ($users as $user)
                @if($order->user_id==$user->id)
                    {{ $user->name }} <br>
                @endif
            @endforeach   
        </td>
        <td class="middleCol">
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
        @if (!Auth::guest() && Auth::user()->admin)
        <td>
            <form class="cart_items_form" id="myForm_{{ $order->id }}_order" method="POST" action="/order">   
                <i class="fa fa-share icon" aria-hidden="true" onclick="document.getElementById('myForm_{{ $order->id }}_order').submit();"></i> 
                <input type="hidden" name="_orderId" value="{{ $order->id }}">
                <input type="hidden" value="GET" name="_method">
            </form>
        </td>
        @endif
    </tr>
    @endforeach 
</table>