@extends('layouts.front')
@section('title', __('general.verify'))
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center my-4">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header">{{ __('verify') }}</div>

                    <div class="card-body p-5">

                        <form method="POST" action="{{route('verify-user')}}">
                            @csrf
                            <section>
                                <div class="form-group row no-gutters">
                                    <label class="col-md-2 form-control-label mb-xs-5 required">
                                        Verification Code :
                                    </label>
                                    <div class="col-md-12">

                                        <input class="form-control" name="code" value=""
                                               type="text" required="">
                                        @error('code')
                                        <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                            </section>
                            <footer class="form-footer clearfix">
                                <div class="row no-gutters">
                                    <div class="col-md-10 offset-md-2">
                                        <input type="hidden" name="submitLogin" value="1">
                                        <button class="btn btn-primary" data-link-action="sign-in" type="submit"
                                                class="form-control-submit">
                                            Confirm
                                        </button>
                                    </div>
                                </div>
                            </footer>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop






