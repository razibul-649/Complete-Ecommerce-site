
<html lang="en">
    <head>
      <!-- Required meta tags -->
      @include('admin.css')

      <style>
         .center{
            margin: auto;
            width: 98%;
            text-align: center;
            border: 1px solid white;
            color: rgb(239, 234, 234);
            
         }
         textarea:focus{
            outline: none;
        }
         table th,tr{
            padding-right:4px;
         }
         table th{
            font-size: 1.5rem;
            
           
         }
         table td .imgdesign{
            border-radius: 0;
            width: 100px;
            height: 100px;
         }
        
          div h1{
            font-size: 2rem;
         }
      </style>
    </head>
    <body>
      <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
         @include('admin.sidebar')
        <!-- partial -->
            @include('admin.header')
          <!-- partial -->
          

          <div class="main-panel">
             <div class="content-wrapper">
                    @if(Session()->has('msg'))
                    <div class=" alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ Session()->get('msg')}}
                    </div>
                    @endif
                   <h1 class="text-center mb-4">
                       All Product Information 
                   </h1>
                <table class="center table">
                    <tr class="bg-success">
                        <th>Product Title</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th> Catagory</th>
                        <th>Price</th>
                        <th>Discount price</th>
                        <th>Image</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                      @foreach ($products as $product)
                            <tr>

                                <td>{{$product->title}}</td>
                                <td class="p-0 m-0"> <textarea spellcheck="false" cols="20" rows="" readonly class="p-0 m-0" style=" background: black; width:100%; height:100%"> {{$product->description}}</textarea>
                                 </td>
                                <td>{{$product->quantity}}</td>
                                <td> {{$product->catagory}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->discount_price}}</td>
                                <td>
                                    <img src="/products/{{$product->image}}" alt="" class="imgdesign" srcset="" width="100px" height="100px">
                                </td>
                                 <td> <a href="{{url('delete_product',$product->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')">Delete</a></td>
                                 <td>
                                    <a href="{{url('update_product',$product->id)}}" class="btn btn-info">Edit</a>
                                 </td>
                            </tr>
                      @endforeach
                 
                </table>
             </div>

         </div>


      <!-- container-scroller -->
      <!-- plugins:js -->
       @include('admin.js')
      <!-- End custom js for this page -->
    </body>
  </html>