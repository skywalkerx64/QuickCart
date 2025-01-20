<x-mail::message>
    # Order Shipped
    Your order {{ $order->reference }} has been shipped !
    <x-mail::table>
        <tr>
            <th>Product</th>
            <th>Amount</th>
        </tr>
        @foreach ($order->details as $detail)
            <tr>
                <td>{{ $detail->product->name }}</td>
                <td>{{ $detail->quantity }}</td>
            </tr>
        @endforeach
    </x-mail::table>
    <x-mail::table>
        <tr>
            <th colspan="2">Totals</th>
        </tr>
        <tr>
            <td>Subtotal</td>
            <td>{{ $order->total }}</td>
        </tr>
        <tr>
            <td>Tax</td>
            <td>{{ $order->tax }}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>{{ $order->total + $order->tax }}</td>
        </tr>
    </x-mail::table>
    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
