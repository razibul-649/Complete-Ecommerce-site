<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
          <h2>
             Our <span>products</span>
          </h2>
          <br>
          <div>
                <form action="{{url('product_search')}}" method="GET">
                  @csrf
                  <input type="text" name="search" id="" placeholder="Search for something" style="width: 500px">
                  <input type="submit" value="search">
                </form>
          </div>
       </div>
            @if(Session()->has('msg'))
            <div class=" alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ Session()->get('msg')}}
            </div>
            @endif


       <div class="row">
         @foreach ($allProduct as $product)
            <div class="col-sm-6 col-md-4 col-lg-4">
               <div class="box">
                  <div class="option_container">
                     <div class="options">
                        <a href="{{url('product_details',$product->id)}}" class="option1">
                           Product Details
                        </a>
                       
                           <form action="{{url('add_cart',$product->id)}}" method="Post">
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
                  <div class="img-box">
                     <img src="{{asset('/')}}products/{{$product->image}}" alt="" width="250px" height="250px">
                  </div>
                  <div class="detail-box">
                     <h5>
                        {{$product->title}}
                     </h5>
                     @if($product->discount_price !=null)
                        <h6 style="color: red">
                           Discount price <br>
                           Tk {{$product->discount_price}}
                        </h6>
                        
                        <h6 style="text-decoration: line-through; color:blue">
                           Price <br>
                           Tk {{$product->price}}
                        </h6>
                      @else
                        <h6 style="color: blue">
                            Price <br>
                           Tk {{$product->price}}
                        </h6>
                     @endif
                     
                  </div>
               </div>
            </div>
         
         @endforeach
         <span style="padding-top:20px;">
            {!!$allProduct->withQueryString()->links('pagination::bootstrap-5')!!}
         </span>
      
       
    </div>
 </section>