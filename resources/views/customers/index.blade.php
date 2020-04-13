@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Customers</div>


                    @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{route('customer.create')}}" class="btn btn-primary"> Create Customer</a>
                        <br/> <br/>
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Customer Address</th>
                                {{--<th>Customer City</th>--}}
                                <th>Customer State</th>
                                <th>Customer Country</th>
                                <th>Customer Phone</th>
                                <th>Customer Email</th>
                                <th>Customer Postcode/ZIP</th>
                                <th>New Invoice</th>
                            </tr>
                            @forelse($customers as $customer)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->address}}</td>
                                    {{--<td>{{$customer->city}}</td>--}}
                                    <td>{{$customer->state}}</td>
                                    <td>{{$customer->country->title ?? '' }}</td>
                                    <td>{{$customer->phone}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->postcode}}</td>
                                    <td><a class="btn btn-xs btn-primary" href="{{route('invoice.create')}}?customer_id={{$customer->id}}">New Invoice</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">No customers found</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
