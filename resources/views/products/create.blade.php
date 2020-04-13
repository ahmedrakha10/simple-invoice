@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Product</div>

                    <form action="{{ route('product.store') }}" method="post">
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
                                            <br/>
                                            Price*: <input type="text" name='price' class="form-control"
                                                           required/>
                                            @if($errors->has('price'))
                                                <div class="alert-danger">{{ $errors->first('price') }}</div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div  style="padding-left: 13px;" class="form-group">
                                    <input  id="submitButton" type="submit" class="btn btn-primary" value="Save Product"
                                           onclick="submitForm(this);"/>
                                </div>
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
