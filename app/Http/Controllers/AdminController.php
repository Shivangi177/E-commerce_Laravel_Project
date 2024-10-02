<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function product(){
        if(Auth::id()){
            if(Auth::user()->usertype=='1'){
              return view('admin.product');
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        }
    }
    public function uploadproduct(Request $request){
        $data=new product;
        $img=$request->file;    //Requesting for the file
        $imgname=time().'.'.$img->getClientOriginalExtension();    //renaming the image using time function
        $request->file->move('productimage',$imgname);         //Sending image to public folder

        $data->image=$imgname;

        $data->title=$request->title;
        $data->price=$request->price;
        $data->description=$request->desc;
        $data->quantity=$request->quantity;

        $data->save();

        return redirect()->back()->with('message','Product Added Successfully');
    }

    //Shows all product data
    public function showproduct(){
        $data=product::all();
        return view('admin.showproduct',compact('data'));
    }

    //delete data from table
    public function deleteproduct($id){
        $data=product::find($id);   //find the id
        $data->delete();    //Now deleted the data of that particular id
        return redirect()->back()->with('message','Product Deleted Successfully');  //Now back to that particular data table
    }

    //Update data of table to make form
    public function updateview($id){
        $data=product::find($id);
        return view('admin.updateview',compact('data'));

    }


    //Update product data
    public function updateproduct(Request $request,$id){
      $data=product::find($id);
      $img=$request->file;
      if($img){         //Requesting for the file
      $imgname=time().'.'.$img->getClientOriginalExtension();    //renaming the image using time function
      $request->file->move('productimage',$imgname);   //Sending image to public folder

      $data->image=$imgname;       //Saving this image in database
      }

      $data->title=$request->title;
      $data->price=$request->price;
      $data->description=$request->desc;
      $data->quantity=$request->quantity;

      $data->save();

      return redirect()->back()->with('message','Product updated Successfully');  
    }

    public function showorder(){
        $order=order::all();
        return view('admin.showorder',compact('order'));
    }

    public function updatestatus($id){
        $order=order::find($id);
        $order->status='delivered';
        $order->save();
        return redirect()->back();
    }


}
