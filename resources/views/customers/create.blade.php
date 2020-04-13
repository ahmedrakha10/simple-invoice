@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Customer</div>

                    <form action="{{ route('customer.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="container">

                                <div class="row clearfix" style="margin-top:20px">
                                    <div class="col-md-12">
                                        <div class="float-left col-md-12">
                                            Name*: <input type="text" name='name' class="form-control"
                                                          required/>
                                            @if($errors->has('name'))
                                                <div class="alert-danger">{{ $errors->first('name') }}</div>
                                            @endif
                                            Address*: <input type="text" name='address' class="form-control"
                                                             required/>
                                            @if($errors->has('address'))
                                                <div class="alert-danger">{{ $errors->first('address') }}</div>
                                            @endif
                                            Postcode/ZIP: <input type="text" name='postcode'
                                                                 class="form-control"/>
                                            City*: <input type="text" name='city' class="form-control"
                                                          required/>
                                            @if($errors->has('city'))
                                                <div class="alert-danger">{{ $errors->first('city') }}</div>
                                            @endif
                                            State: <input type="text" name='state' class="form-control"/>
                                            Country*: <select name='country_id' class="form-control"
                                                              required>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->title}}
                                                        ({{$country->shortcode}})
                                                    </option>
                                                @endforeach
                                                <option></option>
                                            </select>
                                            @if($errors->has('country'))
                                                <div class="alert-danger">{{ $errors->first('country') }}</div>
                                            @endif
                                            Phone: <input type="text" name='phone' class="form-control"/>
                                            Email: <input type="email" name='email' class="form-control"/>
                                            <br/>
                                            <b>Additional fields</b> (optional):
                                            <br/>
                                            <table class="table table-bordered table-hover">
                                                <tbody>
                                                <tr>
                                                    <th class="text-center" width="50%">Field</th>
                                                    <th class="text-center">Value</th>
                                                </tr>
                                                @for ($i = 0; $i <= 2; $i++)
                                                    <tr>
                                                        <td class="text-center">
                                                            <input type="text"
                                                                   name='customer_fields[{{ $i }}][field_key]'
                                                                   class="form-control"/>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="text"
                                                                   name='customer_fields[{{ $i }}][field_value]'
                                                                   class="form-control"/>
                                                        </td>
                                                    </tr>
                                                @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <input id="submitButton" type="submit" class="btn btn-primary" value="Save Customer"
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

        function submitForm(btn) {
            // disable the button
            btn.disabled = true;
            // submit the form
            btn.form.submit();
        }

    </script>
@endpush
