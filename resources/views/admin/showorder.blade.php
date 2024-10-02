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
        
        <!-- showorder  -->

        <div class="container-fluid page-body-wrapper">
            <div class="container" align="center">

            <table>
                <tr style="background-color:gray;" >
                    <td style="padding:30px;" >Customer Name</td>
                    <td style="padding:30px;" >Phone</td>
                    <td style="padding:30px;" >Address</td>
                    <td style="padding:30px;" >Product Title</td>
                    <td style="padding:30px;" >Price</td>
                    <td style="padding:30px;" >Quantity</td>
                    <td style="padding:30px;" >Status</td>
                    <td style="padding:30px;" >Action</td>
                </tr>
               @foreach($order as $orders)
                <tr align="center" style="background-color:black;">
                  <td style="padding:30px;">{{$orders->name}}</td>
                  <td style="padding:30px;">{{$orders->phone}}</td>
                  <td style="padding:30px;">{{$orders->address}}</td>
                  <td style="padding:30px;">{{$orders->product_name}}</td>
                  <td style="padding:30px;">{{$orders->price}}</td>
                  <td style="padding:30px;">{{$orders->quantity}}</td>
                  <td style="padding:30px;">{{$orders->status}}</td>
                  <td style="padding:30px;"><a class="btn btn-success" href="{{url('updatestatus',$orders->id)}}">Delivered</a></td>
                </tr>
                @endforeach
            </table>
            </div>
        </div>


        <!-- partial -->
        @include('admin.script')
  </body>
</html>