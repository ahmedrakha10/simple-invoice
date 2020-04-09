@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{route('invoice.create')}}" class="btn btn-primary"> Create Invoice</a>
                        <br/> <br/>
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Invoice Date</th>
                                <th>Invoice Number</th>
                                <th>Customer Name</th>
                                <th>Total Amount</th>
                                <th>Invoice Details</th>
                                <th>Action</th>
                            </tr>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$invoice->invoice_date}}</td>
                                    <td>{{$invoice->invoice_number}}</td>
                                    <td class="text-center"><span
                                            style=" background-color: #2183d8; color: white;padding: 3px 7px;border-radius: 6px;font-weight: 300;">{{optional($invoice->customer)->name}}</span>
                                    </td>
                                    <td>{{$invoice->total_amount}}</td>
                                    <td>
                                        <a href="{{route('invoice.show',$invoice->id)}}" class="btn btn-sm btn-info">View Invoice</a>
                                    </td>
                                    <td>
                                        <a href="{{route('invoice.download',$invoice->id)}}"
                                           class="btn btn-sm btn-warning">Download PDF</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
