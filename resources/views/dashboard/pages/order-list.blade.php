@extends('dashboard.layout')

@section('title', 'Order List')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">List Order</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Investasi</li>
            <li class="breadcrumb-item active">Order-List</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

{{-- main content --}}
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Transaksi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>                  
                            <tr>
                                <th>Invoice</th>
                                <th>Investasi</th>
                                <th>Investee</th>
                                <th>Lembar</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Update Order</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <a href="/orders/received/{{ $order->id }}">{{ $order->invoice }}</a>
                                </td>
                                <td>{{ $order->nama_investasi }}</td>
                                <td>{{ $order->nama_investee }}</td>
                                <td>{{ $order->lembar_beli }}</td>
                                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    @if($order->status == 'Paid')
                                    <span class="badge badge-success">Paid</span>
                                    @elseif($order->status == 'Pending')
                                    <span class="badge badge-warning">Pending</span>
                                    @else
                                    <span class="badge badge-warning">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $order->updated_at }}</td>

                                {{-- json dump (belum dipake) --}}
                                {{-- @foreach(json_decode($order->payload, true) as $key => $value)

                                @if ($key == 'va_numbers')
                                    @foreach($value[0] as $k => $v)
                                   
                                        {{$k}} - {{$v}}
                                    @endforeach
                                    @continue
                                @endif
                                
                                @if ($key == 'payment_amounts')
                                    @continue
                                @endif
                                {{$key}} - {{$value}}
                                <br>
                                @endforeach --}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $orders->links() }}
                        {{-- <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li> --}}
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    {{--  --}}
@endsection