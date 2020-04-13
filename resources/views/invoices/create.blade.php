@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Invoice</div>
                    <form action="{{ route('invoice.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="container">
                                <div class="row clearfix">
                                    <div class="col-md-4 offset-4 text-center">
                                        Invoice number*:
                                        <br/>
                                        <input type="text" name='invoice[invoice_number]'
                                               value="{{Helper::generateInvoiceNumber()}}" class="form-control"
                                               placeholder="AA001" required/>
                                        <span style="padding-right: 22px;"> Invoice date*: </span>
                                        <br/>
                                        <input type="text" name='invoice[invoice_date]' class="form-control"
                                               value="{{ date('Y-m-d') }}" required/>
                                    </div>
                                </div>
                                <div class="row clearfix" style="margin-top:20px">
                                    <div class="col-md-12">
                                        <div class="float-left col-md-6">



                                                {{--<label style="font-weight: bold"> Select Customer--}}
                                                    {{--: {{$customer->name  }}<br/>--}}
                                            <label> Customer Name : <br>
                                                    <select name='invoice[customer_id]' id="select2"
                                                            class="form-control">
                                                        @foreach($customers as $customer)
                                                            <option
                                                                value="{{$customer->id}}">{{$customer->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </label>

                                        </div>
                                        <div class="float-right col-md-4">
                                            <b>Seller details</b>:
                                            <br/><br/>
                                            Your company name
                                            <br/>
                                            1 Street Name, London, United Kingdom
                                            <br/>
                                            Email: xxxxx@company.com
                                            <br/>
                                            VAT Number: xx xxxxx xxxx
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix" style="margin-top: 20px;">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover" id="tab_logic">
                                            <thead>
                                            <tr>
                                                <th class="text-center"> #</th>
                                                <th class="text-center"> Product</th>
                                                <th class="text-center"> Qty</th>
                                                <th class="text-center"> Price ({{ config('invoices.currency')}})</th>
                                                <th class="text-center"> Total ({{ config('invoices.currency')}})</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr id='addr0'>
                                                <td>1</td>
                                                <td>

                                                    <select id="product_id" name="product[]" class="form-control name">
                                                        <option value="" disabled selected>Select your option</option>
                                                        @foreach($products as $product)
                                                            <option value="{{$product->id}}"
                                                                    data-price="{{$product->price}}">{{$product->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="number" name='qty[]' placeholder='Enter Qty'
                                                           class="form-control qty" step="0" min="0"/></td>
                                                <td><input type="number" name='price[]' placeholder='Price'
                                                           id="price" class="form-control price" step="0.00" min="0"
                                                           readonly/></td>
                                                <td><input type="number" name='total[]' placeholder='0.00'
                                                           class="form-control total" readonly/></td>
                                            </tr>
                                            <tr id='addr1'></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <input type="button" id="add_row" class="btn btn-primary float-left"
                                               value="Add Row"/>
                                        <input type="button" id='delete_row' class="float-right btn btn-info"
                                               value="Delete Row"/>
                                    </div>
                                </div>
                                <div class="row clearfix" style="margin-top:20px">
                                    <div class="col-md-12">
                                        <div class="float-right col-md-5">
                                            <table class="table table-bordered table-hover" id="tab_logic_total">
                                                <tbody>
                                                <tr>
                                                    <th class="text-center">Sub Total ({{ config('invoices.currency')}}
                                                        )
                                                    </th>
                                                    <td class="text-center"><input type="number" name='sub_total'
                                                                                   placeholder='0.00'
                                                                                   class="form-control"
                                                                                   id="sub_total" readonly/></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Tax</th>
                                                    <td class="text-center">
                                                        <div class="input-group mb-2 mb-sm-0">
                                                            <input type="number" name="invoice[tax_percent]"
                                                                   class="form-control"
                                                                   id="tax" value="{{$tax}}"
                                                                   placeholder="0">
                                                            <div class="input-group-addon">&nbsp;%</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Tax Amount ({{ config('invoices.currency')}}
                                                        )
                                                    </th>
                                                    <td class="text-center"><input type="number" name='tax_amount'
                                                                                   id="tax_amount" placeholder='0.00'
                                                                                   class="form-control" readonly/></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Grand Total
                                                        ({{ config('invoices.currency')}})
                                                    </th>
                                                    <td class="text-center"><input type="number" name='total_amount'
                                                                                   id="total_amount" placeholder='0.00'
                                                                                   class="form-control" readonly/></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <input id="submitButton" type="submit" class="btn btn-primary" value="Save Invoice"
                                       onclick="submitForm(this);"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')



    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });

        function submitForm(btn) {
            // disable the button
            btn.disabled = true;
            // submit the form
            btn.form.submit();
        }

        $(document).ready(function () {
            $("#product_id").change(function () {
                var price = $("#product_id").find(":selected").data("price");
                $("#price").val(price);
            });

        });
        $(document).ready(function () {
            var i = 1;
            $("#add_row").click(function () {
                b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;
            });
            $("#delete_row").click(function () {
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }
                calc();
            });

            $('#tab_logic tbody').on('keyup change', function () {
                calc();
            });
            $('#tax').on('keyup change', function () {
                calc_total();
            });


        });

        function calc() {
            $('#tab_logic tbody tr').each(function (i, element) {
                var html = $(this).html();
                if (html != '') {
                    var qty = $(this).find('.qty').val();
                    var price = $(this).find('.price').val();
                    $(this).find('.total').val(qty * price);

                    calc_total();
                }
            });
        }

        function calc_total() {
            total = 0;
            $('.total').each(function () {
                total += parseInt($(this).val());
            });
            $('#sub_total').val(total.toFixed(2));
            tax_sum = total / 100 * $('#tax').val();
            $('#tax_amount').val(tax_sum.toFixed(2));
            $('#total_amount').val((tax_sum + total).toFixed(2));
        }
    </script>
@endpush
