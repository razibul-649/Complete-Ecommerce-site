
<html lang="en">
    <head>
      <!-- Required meta tags -->
     
      @include('admin.css')

      <style>
        div h1{
            font-size: 2rem;
            font-weight: bolder;
            margin-bottom: 2rem;


        }
        label{
              display: inline-block;
              padding-bottom: 10px;
              width: 200px;     
        }

        .imgp{
          padding-right:20px;
          margin-right:20px;
          margin-left: 100px;
        }
        .imgC{
          margin: auto;
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
                
                  <div class="text-center pt-3">
                     <h1>Add Product</h1>
                            @if(Session()->has('msg'))
                            <div class=" alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ Session()->get('msg')}}
                            </div>
                            @endif
                     <form action="{{url('save_update_product',$productSingle->id)}}" method="POST" enctype="multipart/form-data">
                           @csrf
                        <div>
                            
                          <label for="title"> Product  Title :</label>
                          <input type="text" class=" text-black" value="{{$productSingle->title}}" name="title"placeholder="Title here please..."><br> <br>
                        
                        </div>
                        <div>
                            
                          <label for="description"> Product description:</label>
                          <input type="text" class=" text-black" value="{{$productSingle->description}}" name="description"placeholder="Description here please..."><br> <br>
                        </div>

                        <div>  
                          <label for="price"> Product Price :</label>
                          <input type="number" class=" text-black" value="{{$productSingle->price}}" name="price"placeholder="Price here please..."><br><br>
                        </div>

                        <div>
                             
                          <label for="discount">Product Discount :</label>
                          <input type="number" class=" text-black" value="{{$productSingle->discount_price}}" name="discount"placeholder="Discount here please..."><br><br>
                        </div>
   
                        <div>
                            
                        <label for="quantity">Product Quantity :</label>
                        <input type="number" min="0" value="{{$productSingle->quantity}}" class=" text-black" name="quantity"placeholder="Quantity here please..." required> <br><br>
                        </div>
   
                        <div>
                            
                          <label for="catagory">Product Catagory :</label>
                             <select class="text-black" name="catagory" required>

                              
                                 <option value="{{$productSingle->catagory}}" selected> {{$productSingle->catagory}}</option>
                                @foreach ($all_catagory as $catagory)
                                <option value="{{$catagory->catagory_name}}"> {{$catagory->catagory_name}}</option>
                                @endforeach
                             
                                
                             </select>
                        </div>
                         <div>
                             <label for="image_name" class="m-auto"> Current Image :</label>
                             <img src="/products/{{$productSingle->image}}"  width="100px" class="imgC"  height="100px" alt="" srcset=""> <br>

                         </div>

                        <div>
                          <label for="image" class="ImgP">Product Image Here</label>
                          <input type="file" name="image"><br><br>
                        </div>
                        
                          <div>
                            <label for="submit"></label>
                            <input type="submit" class="btn bg-primary" name="submit" value="Update Product ">
                          </div>
                     </form>
                     

                     

                    


                  </div>
              </div>

          </div>
         
      <!-- container-scroller -->
      <!-- plugins:js -->
       @include('admin.js')
      <!-- End custom js for this page -->
    </body>
  </html>