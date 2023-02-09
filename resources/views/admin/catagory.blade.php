
<html lang="en">
    <head>
      <!-- Required meta tags -->
      @include('admin.css')
      <style>
          div h2{
            font-size: larger;
            font-weight: bold;
            padding-bottom: 40px;
          }
          .center1{
            margin: auto;
            width: 50%; 
            text-align: center;
            margin-top: 30px;
            border: 3px solid rgb(238, 246, 238);

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
              <div class="text-center pt-10">
                <h2> Add Catagory</h2>
                <form action="{{url('/add_catagory')}}" method="POST">
                  @csrf
                    <input type="text" name="name" placeholder="Write Category Name" class="text-black mb-1"> <br><br>
                    <input type="submit" class="btn btn-outline-info p-2" name="submit" value="Add Catagory">
                </form>
              </div>
                  <table class="table center1">
                      <tr>
                         <td>Catagory Name</td>
                         <td> Action</td>
                      </tr>
                      @foreach ($datas as $data)
                       <tr>
                         <td>{{$data->catagory_name}}</td>
                         <td> <a href="{{url('delete_catagory',$data->id)}}"  onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger">Delete</a></td>
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