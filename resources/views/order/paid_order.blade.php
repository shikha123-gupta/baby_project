@extends('admin.master')
@section('content')
<style>
  .a{
    width:200px;
  }
  li{
    list-style:none;
  }
</style>
<div class="container">
  <div class="card">
    <div class="card-header">
      <h2>order details</h2>
    </div>
    <div class="card-body">
      <table class=" table table-striped table-hover table-bordered table-responsive">
        <tr>
          <th class="a">#</th>
          <th class="a">Details</th>
          <th class="a">Order Date</th>
          <th class="a">Order Status</th>
          <th class="a">Product Status</th>
          <th class="a">Payment Method</th>
          <th class="a">Payment Status</th>
        </tr>
        <?php $i=1?>
        <tr>
          <td><?php echo $i++;?></td>
          <td>
            <li>Orderno#:{{$order->id}}</li>
            <li>Name:{{$order->name}}</li>
            <li>Contact:{{$order->phone}}</li>
            <li>Email:{{$order->user_email}}</li>
          </td>
          <td>{{$order->created_at}}</td>
          <td>{{$order->order_status}}
            <select name="order_status" class="form-control">
              <option value="Paid">Paid</option>
              <option value="Pending">Pending</option>
              <option value="In Making">In Making</option>
              <option value="Packed">Packed</option>
              <option value="Shipped">Shipped</option>
              <option value="Delivered">Delivered</option>
            </select>
            <input type="submit" value="Update Status" class="bg-info form-control">
            <a href="{{url('order/invoice/' .$order->id)}}" class="bg-success form-control">Invoice</a>
          </td>
          <td>
            @foreach($orderproduct as $a)
             {{$a->product_name}}
            <select name="order_status" class="form-control">
              <option value="Paid">Paid</option>
              <option value="Pending">Pending</option>
              <option value="In Making">In Making</option>
              <option value="Packed">Packed</option>
              <option value="Shipped">Shipped</option>
              <option value="Delivered">Delivered</option>
            </select>
            <input type="submit" value="Update Status" class="bg-info form-control">
            @endforeach
          </td>
          <td>{{$order->payment_method}}</td>
          <td>{{$order->payment_status}}</td>
        </tr>
      </table>
    </div>
  </div>

</div>
@endsection