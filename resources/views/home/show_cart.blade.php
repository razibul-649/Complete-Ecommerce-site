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
      <link rel="shortcut icon" href="{{asset('/')}}images/favicon.png" type="">
      <title>Ecommerce bd </title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <style>
       div .changeColor{
            background-color:#bbd0e4 !important
        }
        
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
        
         <hr>
         @if (Session()->has('msg'))
         <div class="alert alert-success m-2">

            <button type="button"class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h1>   {{Session()->get('msg')}}   </h1>

         </div>
         
       @endif
       @if (Session()->has('msgD'))
         <div class="alert alert-danger m-2">

            <button type="button"class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h1>   {{Session()->get('msgD')}}   </h1>

         </div>
         
       @endif
    

      <div class="m-auto text-center justify-content-center pt-2">
       
        <table class="table table-bordered">
            <tr class="changeColor text-success p-5 text-bold">
                <th>Product Title </th>
                <th> Product Quantity</th>
                <th>Price</th>
                <th>image</th>
                <th> Action </th>
            </tr>
              <?php $totalPrice=0;?>
            @foreach ($user_cart as $cart_item)
            <tr> 
                <td> {{$cart_item->product_title}} </td>
                <td> {{$cart_item->quantity}} </td>
                <td>{{$cart_item->price}} Tk</td>
                <td> <img src="/products/{{$cart_item->image}}" alt="" srcset="" width="100px" height="100px"> </td>
                <td> <a href="{{url('remove_cart',$cart_item->id)}}" class="btn btn-danger" onclick=" return confirm('are sure to remove this product?');">Remove</a></td>
               
                
            </tr>
            <?php $totalPrice= $totalPrice + $cart_item->price ;?>
            @endforeach
          
            
        </table>
         <div>
             <h2 class="text-center text-success pb-4"> Total Price :  {{ $totalPrice}} Tk </h2>
         </div>
           <div>
            <h1 class="pb-3"> Proceed to Order</h1>
            <a href="{{url('cash_order')}}" class="btn btn-danger"> Cash On Delivery</a>
            <a href="{{url('stripe',$totalPrice)}}" class="btn btn-danger">Pay Using Card</a>
           </div>
      </div>
    
     
    
    
      <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
        
           Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        
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