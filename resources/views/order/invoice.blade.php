@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i>Baby Shop
                <small class="float-right">Date: {{$data->created_at}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>{{$data->name}}</strong><br>
                    {{$data->appartment}}, {{$data->address}}<br>
                    {{$data->city}}, {{$data->postcode}}<br>
                    Phone: {{$data->phone}}<br>
                    Email: {{$data->user_email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{$datass->name}}</strong><br>
                    {{$datass->appartment}}, {{$datass->address}}<br>
                    {{$datass->city}}, {{$datass->postcode}}<br>
                    Phone: {{$datass->phone}}<br>
                    Email: {{$datass->user_email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Transcation Id {{$data->transaction_id}}</b><br>
                  <br>
                  <b>Order ID:</b>  {{$data->id}}<br>
                  <b>Payment Due:</b> {{$data->updated_at}}<br>
                  <!-- <b>Account:</b> 968-34567 -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Product</th>
                      <th>Serial #</th>
                      <th>Price</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total_amount=0;?>
                    <?php $tax=10.34;?>
                    <?php $shipping=5.80;?>
                    @foreach($orderproduct as $a) 
                    <tr>
                      
                      <td>{{$a->quantity}}</td>
                      <td>{{$a->product_name}}</td>
                      <td>{{$a->id}}</td>
                      <td>{{$a->price}}</td>
                      <td> Rs.{{$a->price*$a->quantity}}</td>
                     
                    </tr>
                     <?php $total_amount=$total_amount+($a->price*$a->quantity)?>
                     <?php $total=$tax+$shipping+$total_amount?>
                     @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  {{$data->payment_method}}
                  <!-- <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> -->
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <!-- <p class="lead">Amount Due 2/22/2014</p> -->

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>Rs.<?php echo $total_amount;?></td>
                      </tr>
                      <tr>
                        <th>Tax (9.3%)</th>
                        <td>Rs. <?php echo $tax;?></td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>Rs. <?php echo $shipping;?></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>Rs.<?php echo $total;?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
@endsection