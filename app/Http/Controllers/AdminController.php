<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\Order;
use PDF;
use Notification;
use App\Notifications\MyFirstNotification;
class AdminController extends Controller
{
    //

    public function view_category(){

        if(Auth::id()){
            
          $datas=Catagory::all();
           return view('admin.catagory',compact('datas'));
        }else{
            return redirect('login');
        }
    }

    
    public function add_catagory(Request $req){

      if(Auth::id()){
            
            $data=new Catagory();
            $data->catagory_name= $req->name;
            $data->save();
        return redirect()->back()->with('msg','Catagory add successfully');  
      }else{
        return redirect('login');
      }
    }

    public function delete_catagory($id){

         if(Auth::id()){
            $dataSingle=Catagory::find($id);
            $dataSingle->delete();
            return redirect()->back()->with('msg','Catagory delete successfully');

         }else{
            return redirect('login');
          }


    }

    public function view_product(){
        if(Auth::id()){
            
            $all_catagory= Catagory::all();
            return view('admin.product',compact('all_catagory'));
        }else{
            return redirect('login');
        }
    }


    public function add_product(Request $req){
      if(Auth::id()){
            $product= new Product();
            $product->title=$req->title;
            $product->description=$req->description;
            $product->price=$req->price;
            $product->discount_price=$req->discount;
            $product->quantity=$req->quantity;
            $product->catagory=$req->catagory;
    
            $image=$req->image;
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $req->image->move('products',$imageName);
    
            $product->image=$imageName;
            $product->save();
            return redirect()->back()->with('msg','product add fuccessfully');
      }else{
        return redirect('login');
    }

      

    }

    public function show_product(){
           if(Auth::id()){
             $products=Product::all();
             return view('admin.show_product',['products'=> $products]);
           }else{
            return redirect('login');
        }
    }



    public function delete_product($id){
       if(Auth::id()){
            $product=Product::find($id);
            if($product->image){
                
            unlink(public_path("products/".$product->image));
            }
            
            $product->delete();
            
            return  redirect()->back()->with('msg','product delete fuccessfully');
       }else{
        return redirect('login');
       }

    }

    public function update_product($id){

       if(Auth::id()){
          $productSingle=Product::find($id);
          $all_catagory=Catagory::all();
        
           return view('admin.update_product',['productSingle'=>$productSingle,'all_catagory'=>$all_catagory]);
       }else{
        return redirect('login');
       }
    }

    public function save_update_product(Request $req, $id){
      
        if(Auth::id()){
                    
            $product=Product::find($id);
                        
            $old_img= $product->image;

            $image=$req->image;

            if($image){
                    
                
                    $imageName=time().'.'.$image->getClientOriginalExtension();
                    $req->image->move('products',$imageName); 
                    $product->image=$imageName;
                    
                    if($old_img){
                        unlink(public_path("products/".$old_img));
                    }
                    
                    

                }

                    $product->title=$req->title;
                    $product->description=$req->description;
                    $product->price=$req->price;
                    $product->discount_price=$req->discount;
                    $product->quantity=$req->quantity;
                    $product->catagory=$req->catagory;
                

                    $product->save();
                    return redirect('/show_product')->with('msg','product update fuccessfully');
        }else{
            return redirect('login');
        }
    }



    public function order(){
        if(Auth::id()){
            
         $orders=Order::all();
         return view('admin.order',compact('orders'));
        }else{
            return redirect('login');
        }
    }

    public function delivered($id){
       
        if(Auth::id()){
             $order_delivered=Order::find($id);
             $order_delivered->delivery_status="delivered";
                 if($order_delivered->payment_status=='cash on delivery'){
                    $order_delivered->payment_status="paid";
                 }
          
    
            $order_delivered->update();
            return redirect()->back()->with('msg','Product delivered successfully');
        }else{
            return redirect('login');
        }


    }

    public function print_pdf($id){
       
         if(Auth::id()){
          $order_product=Order::find($id);
          $pdf=PDF::loadView('admin.pdf',['order_product'=>$order_product]);
          return $pdf->download('order_details.pdf');
        }else{
            return redirect('login');
        }

    }

    public function send_email($id){
       
       if(Auth::id()){
           $order=Order::find($id);
       
         return view('admin.email_info',compact('order'));
       }else{
        return redirect('login');
       }
    }

    public function send_user_email(Request $req, $id){
       
       if(Auth::id()){
            $order=Order::find($id);
            

            $details =[
                'greeting'=>$req->greeting,
                'firstline'=>$req->firstline,
                'body'=>$req->body,
                'button'=>$req->button,
                'url'=>$req->url,
                'lastline'=>$req->lastline,

            ];

            Notification::send($order,new MyFirstNotification($details));

            return redirect()->back();
       }else{
        return redirect('login');
       }
    }





    public function search_data(Request $req){
      if(Auth::id()){

            
        $searchText=$req->search;

        $orders=Order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->get();

        return view('admin.order',compact('orders'));
      }else{
        return redirect('login');
      }


    }
}
