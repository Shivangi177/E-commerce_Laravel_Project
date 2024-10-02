<x-app-layout>
   
</x-app-layout>

<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
  </head>
  <body>
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.navbar')
       
        <!-- Show product -->
        <div style="padding-bottom:30px" class="container-fluid page-body-wrapper">
            <div class="container" align="center">

            @if(session()->has('message'))
             <div class="alert alert-success">
             {{session()->get('message')}}
             <button type="button" class="close" data-dismiss="alert">x</button>
             </div>
            @endif

              <table>
                <tr background-color:grey;>
                    <td style="padding:20px;">Title</td>
                    <td style="padding:20px;">Price</td>
                    <td style="padding:20px;">Description</td>
                    <td style="padding:20px;">Quantity</td>
                    <td style="padding:20px;">Image</td>
                    <td style="padding:20px;">Update</td>
                    <td style="padding:20px;">Delete</td>
                </tr>
                 
                @foreach($data as $product)
                <tr align="center" style="background-color:black;">
                    <td style="padding:20px;">{{$product->title}}</td>
                    <td style="padding:20px;">{{$product->price}}</td>
                    <td style="padding:20px;">{{$product->description}}</td>
                    <td style="padding:20px;">{{$product->quantity}}</td>
                    <td><img height="100" width="100" src="/productimage/{{$product->image}}"></td>
                    <td>
                        <a class="btn btn-primary" href="{{url('updateview',$product->id)}}">Update</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" onclick="confirm('Are you sure you want to delete this  product?')" href="{{url('deleteproduct',$product->id)}}">Delete</a>
                    </td>
                </tr>
                @endforeach
                
              </table>
            </div>
            </div>





        <!-- partial -->
        @include('admin.script')
  </body>
</html>