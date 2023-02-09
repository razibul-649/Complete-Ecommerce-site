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
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')


      <!-- end header section -->

        <!-- product details-->
        <hr>
        <div class="col-sm-6 col-md-4 col-lg-3" style="margin:auto; width:50%; padding:30px; boder:2px solid red">
              <div class="border border-primary p-2"> 

                <div class="img-box">
                    <img src="/products/{{$ProductSingle_details->image}}" alt="" width="300px" height="300px">
                 </div>
                 <div class="detail-box">
                    <h5>
                       {{$ProductSingle_details->title}}
                    </h5>
                    @if($ProductSingle_details->discount_price !=null)
                       <h6 style="color: red">
                          Discount price <br>
                          Tk {{$ProductSingle_details->discount_price}}
                       </h6>
                       
                       <h6 style="text-decoration: line-through; color:blue">
                          Price <br>
                          Tk {{$ProductSingle_details->price}}
                       </h6>
                     @else
                       <h6 style="color: blue">
                           Price <br>
                          Tk {{$ProductSingle_details->price}}
                       </h6>
                    @endif
  
                    <h6 class=" bg-black">  <span class="text-lg font-weight-bold"> Product Catagory </span> :{{$ProductSingle_details->catagory}} </h6>
                    <h6>  <span class="text-lg font-weight-bold">Product Description </span>  : {{$ProductSingle_details->description}} </h6>
                    <h6>  <span class="text-lg font-weight-bold"> Product Qunantity</span> :{{$ProductSingle_details->quantity}} </h6>
                    
                    <form action="{{url('add_cart',$ProductSingle_details)}}" method="Post">
                     @csrf
                     <div class="row">
                        <div class="col-md-4">
                            
                           <input type="number" name="quantity" value="1" min="1" width="100px;">
                        </div>

                        <div class="col-md-4">
                              
                             <input type="submit" value="Add to Card">
                        </div>
                  </div>
                  </form>
                    
                 </div>


              </div>
               
            </div>
       </div>

    



        
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
    
      <!-- jQery -->
      <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('home/js/custom.js')}}"></script>
   </body>
</html>