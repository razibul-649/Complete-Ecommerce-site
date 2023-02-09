<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use Session;
use Stripe;

class HomeController extends Controller
{
    //
    public function redirect(){
        $usertype=Auth::User()->usertype;

        if($usertype=='1'){
                $total_product=Product::all()->count();
                $total_order=Order::all()->count();
                $total_user=User::all()->count();
                $total_delivered=Order::where('delivery_status','=','delivered')->get()->count();
                
                $total_Processing=Order::where('delivery_status','=','processing')->get()->count();
                
                $total_CashOndelivery=Order::where('payment_status','=','cash on delivery')->get()->count();
                
                $total_paid=Order::where('payment_status','=','paid')->get()->count();

                $orders=Order::all();
                $total_revenue=0;

                foreach($orders as $order){
                    $total_revenue=$total_revenue + $order->price;
                }

               return view('admin.home',compact('total_product','total_order','total_user','total_delivered','total_Processing',
               'total_CashOndelivery','total_paid','total_revenue'));
        }else{
            $allProduct=Product::paginate(6);
             $comment=Comment::orderby('id','desc')->get();
             $reply=Reply::all();
          return view('home.userpage',compact('allProduct','comment','reply'));
        }
    }
    public function index(){
        $allProduct=Product::paginate(6);
        
        $comment=Comment::orderby('id','desc')->get();
        $reply=Reply::all();
        
        return view('home.userpage',compact( 'allProduct','comment','reply'));
    }

    public function product_details($id){
        $ProductSingle_details=Product::find($id);
         return  view('home.product_details',['ProductSingle_details'=>$ProductSingle_details]);
    }

    public function add_cart(Request $req, $id){
        
        if(Auth::id()){
            $user=Auth::user();
            $user_id=$user->id;
            $product=Product::find($id);
            $product_exist_id=Cart::where('product_id','=',$id)->where('user_id','=',$user_id)->get('id')->first();

            if($product_exist_id){
           
                $cart=Cart::find($product_exist_id)->first();
                 
                $quantity=$cart->quantity;
                $cart->quantity=$quantity + $req->quantity;

                   
                    if($product->discount_price !=null){
                            
                        $cart->price=$product->discount_price * $cart->quantity;
                    }else{
                        $cart->price=$product->price * $cart->quantity;
                    }
                   $cart->save();
                   return redirect()->back()->with('msg','Product Added Successfuly');
                
            }else{

                    $cart=new Cart;
                    
                    $cart->name=$user->name;
                    $cart->email=$user->email;
                    $cart->phone=$user->phone;
                    $cart->address=$user->address;
                    $cart->user_id=$user->id;


                    $cart->product_title=$product->title;

                    if($product->discount_price !=null){
                        
                       $cart->price=$product->discount_price * $req->quantity;
                    }else{
                        $cart->price=$product->price * $req->quantity;
                    }
                    
                    $cart->quantity=$req->quantity;
                    $cart->image=$product->image;
                    $cart->product_id=$product->id;
                    $cart->save();
                   
                    return redirect()->back()->with('msg','Product Added Successfuly');
                } 

        }else{
           return redirect('login');
        }
     
    }


   public function show_cart(){
    if(Auth::id()){
       
            
        $id=Auth::user()->id;
        $user_cart=Cart::where('user_id','=',$id)->get();
        
        return view('home.show_cart',compact('user_cart'));
    }
    return redirect('login');
   }

   public function remove_cart(Request $req, $id){
      $cart_item=Cart::find($id);
      $cart_item->delete();

      return redirect()->back();


   }



   public function cash_order(){
    
        $user=Auth::user();
        $user_id=$user->id;
   
         // searching the data card table that's card have under the login user have any or null
    
        $check=Cart::where('user_id','=',$user->id)->first();
           


            if($check!=null){
                
                $datas=Cart::where('user_id','=',$user->id)->get();
            
                foreach($datas as $data){
                    
                $order_data=new Order();
                
                $order_data->name=$data->name;
                $order_data->email=$data->email;
                $order_data->phone=$data->phone;
                $order_data->address=$data->address;
                $order_data->user_id=$data->user_id;
        
                $order_data->product_title=$data->product_title; 
                $order_data->price=$data->price;
                $order_data->quantity=$data->quantity;
                $order_data->image=$data->image;
                $order_data->product_id=$data->product_id;
                $order_data->payment_status='cash on delivery';
                $order_data->delivery_status='processing';
        
                $order_data->save(); 
                $cart_id=$data->id;
                $cart=Cart::find($cart_id);
        
                $cart->delete();
        
                }
        
                return redirect()->back()->with('msg','We have received your order. we will connet with you as soon as ');

            } else{
                      
                return redirect()->back()->with('msgD','Sorry Your card is empty please add product in you card');
            }
    
   }

   public function stripe($totalPrice){

    return view('home.stripe',compact('totalPrice'));
   }


   public function stripePost(Request $request,$totalPrice)
    {  
        
        if($totalPrice>0){

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
          
        Stripe\Charge::create ([
                "amount" => $totalPrice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment" 
        ]);
           
            
            $user=Auth::user();
            $user_id=$user->id;
            $datas=Cart::where('user_id','=',$user->id)->get();
                
            foreach($datas as $data){
                
            $order_data=new Order();
            
            $order_data->name=$data->name;
            $order_data->email=$data->email;
            $order_data->phone=$data->phone;
            $order_data->address=$data->address;
            $order_data->user_id=$data->user_id;

            $order_data->product_title=$data->product_title; 
            $order_data->price=$data->price;
            $order_data->quantity=$data->quantity;
            $order_data->image=$data->image;
            $order_data->product_id=$data->product_id;
            $order_data->payment_status='paid';
            $order_data->delivery_status='processing';

            $order_data->save(); 
            $cart_id=$data->id;
            $cart=Cart::find($cart_id);

            $cart->delete();

        }

        Session::flash('success', 'Payment successful!');
              
        return back();
    }else{
        

       return redirect('/show_cart')->with('msgD','Product Card are empty');
    }

    }


    public function show_order(){

        if(Auth::id()){
            $user=Auth::user();
            $userId=$user->id;
            $order=Order::where('user_id','=',$userId)->get();
            return view('home.order_show',compact('order'));
        }else{
            return redirect('login');
        }
    }

    public function cancel_order($id){
        
        $order=Order::find($id);
        $order->delivery_status='you cancel the order';

        $order->save();


        return redirect()->back();
    }


    public function add_comment(Request $req){
       
        if(Auth::id()){
            $comment=new Comment;
            $comment->name=Auth::user()->name;
            $comment->user_id=Auth::user()->id;
            $comment->comment=$req->comment;
            $comment->save();
            return redirect()->back();
            
        }else{
            return redirect('login');
        }

    }

    public function add_reply(Request $req){
        
        if(Auth::id()){
              $reply=new Reply;
              $reply->name=Auth::user()->name;
              $reply->user_id=Auth::user()->id;
              $reply->comment_id=$req->commentId;
              $reply->reply=$req->reply;
              $reply->save();
              return redirect()->back();

        }else{
            return redirect('login');
        }
        
    }

    public function product_search(Request $req){

        $searchText=$req->search;
        $comment=Comment::orderby('id','desc')->get();
        $reply=Reply::all();
        $allProduct=Product::where('title','LIKE',"%$searchText%")->orwhere('catagory','LIKE',"%$searchText%")->paginate(10);


        return view('home.userpage',compact('allProduct','comment','reply'));



    }



  public function all_products(){
     
        $allProduct=Product::paginate(6);
            
        $comment=Comment::orderby('id','desc')->get();
        $reply=Reply::all();
         
    return view('home.all_products',compact('allProduct','comment','reply'));
  }

  
  public function search_product(Request $req){

    $searchText=$req->search;
    $comment=Comment::orderby('id','desc')->get();
    $reply=Reply::all();
    $allProduct=Product::where('title','LIKE',"%$searchText%")->orwhere('catagory','LIKE',"%$searchText%")->paginate(10);


    return view('home.all_products',compact('allProduct','comment','reply'));



}




}
