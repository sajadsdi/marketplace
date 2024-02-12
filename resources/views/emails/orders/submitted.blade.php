<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>
<h1>Order Details</h1>
<p><strong>Customer Name:</strong> {{ $order->user->name }}</p>
<p><strong>Customer Mail:</strong> {{ $order->user->email }}</p>
<p><strong>Order ID:</strong> {{ $order->id }}</p>
<p><strong>Order Shipping:</strong> {{ $order->shipping ? 'yes' : 'no' }}</p>
<p><strong>Order Items:</strong></p>
<ul>
    @foreach ($order->products as $product)
        <li>{{ $product->title }} x {{ $product->pivot->quantity }} : {{ number_format($product->pivot->price * $product->pivot->quantity + $product->pivot->shipping_price) }}</li>
    @endforeach
</ul>
<p><strong>Order Total Price: </strong> {{ number_format($order->total_price) }}</p>
</body>
</html>
