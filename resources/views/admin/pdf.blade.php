<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order pdf</title>
</head>
<body>
      <h1>Order Details</h1>
      Customer Name :<h3>{{$order_product->name}}</h3>
      Customer Email : <h3>{{$order_product->email}}</h3>
      Customer Phone :  <h3>{{$order_product->phone}}</h3>
      Customer Address : <h3>{{$order_product->address}}</h3>
     
      Customer Id :  <h3>{{$order_product->user_id}}</h3>
      Product Name : <h3>{{$order_product->product_title}}</h3>
      Product Quantity :<h3>{{$order_product->quantity}}</h3>
      Product Payment Status : <h3>{{$order_product->payment_status}}</h3>
      Product Id :<h3>{{$order_product->product_id}}</h3>
      <img src="products/{{$order_product->image}}" alt="" height="300" width="400">
      

</body>
</html>