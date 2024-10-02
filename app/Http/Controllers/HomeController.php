<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class HomeController extends Controller
{
    //login
    public function redirect(){
        $usertype=Auth::user()->usertype;
        if($usertype=='1'){
            return view('admin.home');   //dashboard
        }
        else{
            $data=product::paginate(3);
            $user=Auth::user();
            $count=cart::where('phone',$user->phone)->count();
            return view('user.home',compact('data','count'));
        }
    }

    //paginate product
    public function index(){
        if(Auth::id()){
            return redirect('redirect');
        }
        else{
            $data=product::paginate(3);
        return view('user.home',compact('data'));
        }
    }

    //Search product
    public function search(Request $req){
        $search=$req->search;

        //if we don't search anything
        if($search==''){
            $data=product::paginate(3);
        return view('user.home',compact('data'));
        }
        $data=Product::where('title','like','%'.$search.'%')->get();
        return view('user.home',compact('data'));
        
    }

    public function addcart(Request $req,$id){
       if(auth::id()) {
        $user=auth::user();
        $product=product::find($id);
        $cart=new cart;
        $cart->name=$user->name;
        $cart->phone=$user->phone;
        $cart->address=$user->address;
        $cart->product_title=$product->title ?? "skirt";
        $cart->price=$product->price ?? "500";
        $cart->quantity=$req->quantity;
        $cart->save();

        return redirect()->back()->with('message',"Product added Successfully");    //it means if the user is logged in then it will added to cart
       }
       else{
        return redirect('login'); //it will first login if user is not login
       }
    }

    //Show cart
    public function showcart(){
        $user=auth::user();
        $cart=cart::where('phone',$user->phone)->get();    //comparing user phone no. to cart phone no. and then insert user that phone no. data to cart table 
        $count=cart::where('phone',$user->phone)->count();   //comparing user phone no. to cart phone no. and then find how many time this phone number is showing
        return view('user.showcart',compact('count','cart'));

    }


    //Delete
    public function deletecart($id){
        $data=Cart::find($id);
        $data->delete();
        return redirect()->back()->with('message',"Product deleted successfully");
    }

    public function confirmorder(Request $request){
        $user=auth::user();
        $name=$user->name;
        $phone=$user->phone;
        $address=$user->address;

        foreach($request->productname as $key=>$productname){
          $order=new order();
          $order->product_name=$request->productname[$key];
          $order->price=$request->price[$key];
          $order->quantity=$request->quantity[$key];
          $order->name=$name;
          $order->phone=$phone;
          $order->address=$address;
          $order->status="Not delivered";

          $order->save();
        }

        DB::table('carts')->where('phone',$phone)->delete();
        return redirect()->back()->with('message','Product ordered successfully');


    }
}
