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
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      

      
     <script>
      function reply(caller){
         document.getElementById('commentId').value=$(caller).attr('data-commentid');
         $('.replyDiv').insertAfter($(caller));
         $('.replyDiv').show();
     }

     function reply_close(caller){
        
      $('.replyDiv').hide();
     }

     
     </script>
   
    
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <span style="color: black"> <hr style=" background-color: rgb(145, 113, 113); height: 1px; border: 0;"></span>
         

      <!-- product section -->
      
       @include('home.allproduct')

       
       <!-- start comment section -->


  <div class="text-center">
     <h1  style=" text-align:center;padding-top:20px; padding-bottom:5px; font-size:30px;" > Comments</h1>

      <form action="{{url('add_comment')}}" method="POST">

         @csrf
         <textarea style="height:50px; width:500px;" placeholder="comment here something" name="comment"></textarea><br>
      
           <input type="submit" class="btn btn-primary" name="" id="" value="Comment">


      </form>

  </div>

  <div style="padding-left: 20%">
    <h1 style=" font-size:30px; padding-bottom:20px;"> All Comments</h1>
        
       @foreach ($comment as $single_comment)
           
     
       <div>
              <b>{{$single_comment->name}}</b>
              <p>{{$single_comment->comment}}</p>
              <a href="javascript:void(0);" onclick="reply(this)" data-commentid="{{$single_comment->id}}" class="text-success">Reply</a>

            @foreach ($reply as $S_reply)
                @if($single_comment->id==$S_reply->comment_id)
                  <div style="padding-left: 5%; paddinf-bottom:10px;" >
                     <b> {{$S_reply->name}}</b>
                     <p>
                        {{$S_reply->reply}}
                     </p>
                     
                   <a href="javascript:void(0);" onclick="reply(this)" data-commentid="{{$single_comment->id}}" class="text-primary">Reply</a>
                </div>
                
                @endif
            @endforeach
           
       </div>
       @endforeach
        <!--reply section-->

       <div style="display:none;" class="replyDiv">

         <form action="{{url('add_reply')}}" method="POST">
            @csrf
            <input type="text" name="commentId" id="commentId" hidden>
            <textarea style="height: 100px; width:500px;" name="reply" placeholder="write something here"></textarea>
            <br>
            <button type="submit" class="btn btn-warning">Reply</button>

            
            <a href="javascript:void(0)" class="btn btn-danger" onclick="reply_close(this)">Close</a>
        </form>

      </div>
  </div>


  <!-- end comment section -->

      <!-- subscribe section -->
         @include('home.subscriber')
      <!-- end subscribe section -->
      <!-- client section -->
         
        @include('home.client')
      <!-- end client section -->
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2023 All Rights Reserved By <a href="https://razibulprotfolio.netlify.app/">Md. Razibul Islam </a><br>
      
        
         
         </p>
      </div>


      <script>
         document.addEventListener("DOMContentLoaded", function(event) { 
             var scrollpos = localStorage.getItem('scrollpos');
             if (scrollpos) window.scrollTo(0, scrollpos);
         });
 
         window.onbeforeunload = function(e) {
             localStorage.setItem('scrollpos', window.scrollY);
         };
     </script>

     
      <!-- jQery -->
      <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></scrip>
      <!-- popper js -->
      <script src="{{asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('home/js/custom.js')}}"></script>
   </body>
</html>