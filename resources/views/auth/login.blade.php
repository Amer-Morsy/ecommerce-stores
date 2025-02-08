@extends('layouts.front')
@section('title', __('general.login'))
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center my-4">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header">{{ __('login') }}</div>

                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <section>
                                <div class="form-group row no-gutters">
                                    <label class="col-md-2 form-control-label mb-xs-5 required">
                                        Mobile :
                                    </label>
                                    <div class="col-md-10">

                                        <input class="form-control" name="mobile" value="{{ old('mobile') }}"
                                               type="text" required="">
                                        @error('mobile')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row no-gutters">
                                    <label class="col-md-2 form-control-label mb-xs-5 required">
                                        {{__('general.password')}} :
                                    </label>
                                    <div class="col-md-10">

                                        <div class="input-group js-parent-focus">
                                            <input class="form-control js-child-focus js-visible-password"
                                                   name="password" type="password" value="" pattern=".{5,}"
                                                   required="">
                                            <span class="input-group-btn">
                                                        <button class="btn" type="button" data-action="show-password"
                                                                data-text-show="Show" data-text-hide="Hide">
                                                          {{__('general.show')}}
                                                        </button>
                                                    </span>
                                        </div>
                                        @error('password')
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>

                            </section>
                            <footer class="form-footer clearfix mt-5">
                                <div class="row no-gutters mt-5">
                                    <div class="col-md-4 offset-md-2">
                                        <input type="hidden" name="submitLogin" value="1">
                                        <button class="btn btn-primary" data-link-action="sign-in" type="submit"
                                                class="form-control-submit">
                                            {{__('general.login')}}
                                        </button>
                                    </div>
                                    <div class="col-md-4 offset-md-2">
                                        <div class="no-account">
                                            <a href="{{route('register')}}"
                                               data-link-action="display-register-form">
                                                {{__('general.no_account')}}
                                            </a>
                                        </div>
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
