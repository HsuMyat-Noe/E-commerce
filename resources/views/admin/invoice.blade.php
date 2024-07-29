<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<body>
    <h3>Name: {{ $order->name }}</h3>   
    <h3>Address: {{ $order->rec_address }}</h3>   
    <h3>Phone: {{ $order->phone}}</h3>   
    <h3>Product Name: {{ $order->product->title }}</h3>   
    <h3>Price: {{ $order->product->price }}</h3>   
    <h3>Product Image: 
    </h3>
    <img src="products/{{$order->product->image}}" alt="" style="width: 300px;">
</body>
</html>