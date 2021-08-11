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
          <th class="a">Payment Status</th>
          <th class="a">Payment Method</th>
          <th class="a">Action</th>
        </tr>
        <?php $i=1?>
        @foreach($order as $a)
        <tr>
          <td><?php echo $i++;?></td>
          <td>
            <li>Orderno#:{{$a->id}}</li>
            <li>Name:{{$a->name}}</li>
            <li>Contact:{{$a->phone}}</li>
            <li>Email:{{$a->user_email}}</li>
          </td>
          <td>{{$a->created_at}}</td>
          <td>{{$a->order_status}}</td>
          <td>{{$a->payment_method}}</td>
          <td>
            <a class="bg-info form-control" href="{{url('/order/paid_order/' .$a->id)}}">View</a>
          </td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>

</div>
@endsection