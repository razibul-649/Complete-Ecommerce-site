

<html lang="en">
    <head>
      
      <!-- Required meta tags -->
      @include('admin.css')

      <style type="text/css">
        label{
            display: inline-block;
            width: 200px;
            font-weight: bold;
            font-size: 15px;

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

                <h1 class="text-center display-3"> Send Email to {{$order->email}}</h1>

                <form action="{{url('send_user_email',$order->id)}}" method="post">
                    @csrf
                    <div class="text-center pt-6">
                        <label for="greating"> Email Greeting</label>
                        <input type="text" name="greeting" class="text-black" placeholder="greeting here...">


                    </div>

                    <div class="text-center pt-6">
                        <label for=""> Email First Line</label>
                        <input type="text" name="firstline" class="text-black" placeholder="First line here...">


                    </div>
                    <div class="text-center pt-6">
                        <label for=""> Email Body Is </label>
                        <input type="text" name="body" class="text-black" placeholder="body here...">


                    </div>
                    <div class="text-center pt-6">
                        <label for=""> Email Button Name</label>
                        <input type="text" class="text-black"  name="button" placeholder="here button name..">


                    </div>
                    <div class="text-center pt-6">
                        <label for=""> Email Url Is </label>
                        <input type="text" class="text-black" name="url"placeholder="url here...">


                    </div>
                    <div class="text-center pt-6">
                        <label for=""> Email Last Line </label>
                        <input type="text" name="lastline" class="text-black" placeholder="last line here...">


                    </div>
                    <div class="text-center pt-6">
                        <label for=""> </label>
                        <input type="submit" name="submit" value="Send Email" class="btn btn-success">


                    </div>
            </form>

            </div>
          </div>
        

          
       @include('admin.js')
      <!-- End custom js for this page -->
    </body>
  </html>