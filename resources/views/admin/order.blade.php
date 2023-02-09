
<html lang="en">
    <head>
      <!-- Required meta tags -->
      @include('admin.css')

      <style>
        .fw{
            font-size: 2rem;
            padding:20px;
            border: 2px solid white;
        }
        .design{
            border: 2px solid white;
            width: 90%;
        }
        .bg{
            background-color: blue;
            color: black;
            font-size: 20px;
        }
       
        .table td img{
            height: 100px;
            width:100px;
            border-radius: 0;
        }
        table tr th,td{
            padding-right:10px;
            padding-bottom: 4px;
            padding-left: 4px;
        }
        
      </style>
    </head>
    <body>
      <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
         @include('admin.sidebar')
        <!-- partial -->
            @include('admin.header')
        
            
          <div class="main-panel">
            <div class="content-wrapper">
                @if(Session()->has('msg'))
                  <div class=" alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                      {{ Session()->get('msg')}}
                   </div>
                @endif
                 <h1 class=" text-center fw"> All Order Information</h1>

                 <div class="text-center pt-3">
                  <form action="{{url('search')}}" method="GET">
                    <input type="text" name="search" class="text-black" placeholder="search here something">
                    <input type="submit" value="Searching" class="btn btn-outline-danger p-2">
                  </form>
                 </div>
                 

                 <table class="design mx-auto">
                     <tr class="bg"> 
                         <th>Name</th>
                         <th>Email</th>
                         <th>Address</th>
                         <th>Phone</th>
                         <th>Product Title</th>
                         <th>Qauntity</th>
                         <th>Price</th>
                         <th>Payment Status</th>
                         <th>Delivery Status</th>
                         <th>Product Image</th>
                         <th>Deliverd</th>
                         <th>Print pdf</th>
                         <th>Send Email</th>
                        
                     </tr>
                     @forelse ($orders as $order)
                     
                     <tr>
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}} tk</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                       
                        <td> <img src="/products/{{$order->image}}" alt="" class="changeImage" width="100px" height="100px" srcset=""></td>
                        <td>
                            @if ($order->delivery_status =='processing')
                                
                              <a href="{{url('delivered',$order->id)}}" class="btn btn-danger" onclick="return confirm('are you sure this product is delivered?')">delivered</a>

                              @else 
                                <p class="text-success">Delivered</p>
                            @endif
                        </td>
                        <td><a href="{{url('print_pdf',$order->id)}}" class="btn btn-success">pdf</a></td>
                        
                          <td><a href="{{url('send_email',$order->id)}}" class="btn btn-info">Send</a></td>
                     </tr>

                     @empty
                      <tr>
                        <td colspan="16" class="text-center text-danger">No data found</td>
                      </tr>
                         
                
                         
                     @endforelse
                 </table>
                
                 
            </div>
          </div>
              
      <!-- plugins:js -->
       @include('admin.js')
      <!-- End custom js for this page -->
    </body>
  </html>