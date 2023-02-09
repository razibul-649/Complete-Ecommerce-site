<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Ecommerce bd </title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style>
        .width{
            width: 70%;
        }
        table .color{
            background-color: blueviolet;
        }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <hr>
          
            <h1 class="text-center display-4 pt-6"> Order Information </h1>
             <table class="mx-auto text-center table table-bordered width">
                <tr class="color">
                    <th>Product Title</th>
                    <th>Quantity</th> 
                    <th> Price</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>

                @foreach ($order as $item)
                    
              
                 <tr>
                        <td>{{$item->product_title}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->payment_status}}</td>
                        <td>{{$item->delivery_status}}</td>
                        <td style="width:100px; height:100px;"><img src="{{asset('/')}}products/{{$item->image}}" alt="" width="100px" height="100px"></td>
                        <td>
                         @if ($item->delivery_status=='processing')
                         <a href="{{url('cancel',$item->id)}}" class="btn btn-danger"  onclick="return confirm('are you sure cancel this product?')">Cancel</a>
                          @else
                            <p class="text-success"> 
                                Not allowed
                            </p>
                         @endif
                            
                        </td> 

                 </tr>
                @endforeach
             </table>
        

      </div>
      
      <div class="cpy_">
         <p class="mx-auto">© 2023 All Rights Reserved By <a href="https://razibulprotfolio.netlify.app/"target="_blank">md razibul islam</a><br>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>