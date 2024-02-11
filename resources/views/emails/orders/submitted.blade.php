<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>
<h1>Order Details</h1>
<p><strong>Custommer Name:</strong> {{ $order->user->name }}</p>
<p><strong>Order ID:</strong> {{ $order->id }}</p>
<p><strong>Order Shipping:</strong> {{ $order->shipping }}</p>
<p><strong>Order Items:</strong></p>
<ul>
    @foreach ($order->products as $product)
        <li>{{ $product['name'] }} - Number: {{ $product['quantity'] }}</li>
    @endforeach
</ul>
<p><strong>Order Total Price: </strong> {{ $order->total_price }}</p>
</body>
</html>
