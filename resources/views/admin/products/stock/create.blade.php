@extends('layouts.admin')
@section('title', __('general.inventory') .' | '. __('general.products') )
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.dashboard')}}">{{__('general.home')}} </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.products')}}">
                                        {{__('general.products')}} </a>
                                </li>
                                <li class="breadcrumb-item active"> {{__('general.add')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> {{__('general.add')}}</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('admin.products.stock.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="product_id" value="{{$id}}">
                                            <div class="form-body">

                                                <h4 class="form-section"><i
                                                        class="ft-home"></i> {{__('general.inventory')}}</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sku">  {{__('general.sku')}}
                                                            </label>
                                                            <input type="text" id="sku"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{old('sku')}}"
                                                                   name="sku">
                                                            @error("sku")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="in_stock">{{__('general.status')}}
                                                            </label>
                                                            <select id="in_stock" name="in_stock"
                                                                    class="select2 form-control">
                                                                <optgroup label="{{__('general.select')}}">
                                                                    <option
                                                                        value="1">{{__('general.in_stock')}}</option>
                                                                    <option
                                                                        value="0">{{__('general.out_stock')}}</option>
                                                                </optgroup>
                                                            </select>
                                                            @error('in_stock')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- QTY  -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="manageStock">{{__('general.manage_stock')}}
                                                            </label>
                                                            <select name="manage_stock" class="select2 form-control"
                                                                    id="manageStock">
                                                                <optgroup label="{{__('general.select')}}">
                                                                    <option
                                                                        value="1">{{__('general.yes')}}</option>
                                                                    <option value="0"
                                                                            selected>{{__('general.no')}}</option>
                                                                </optgroup>
                                                            </select>
                                                            @error('manage_stock')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" style="display:none" id="qtyDiv">
                                                        <div class="form-group">
                                                            <label for="qty">{{__('general.quantity')}}
                                                            </label>
                                                            <input type="text" id="qty"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{old('qty')}}"
                                                                   name="qty">
                                                            @error("qty")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> {{__('general.back')}}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{__('general.edit')}}
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $(document).on('change', '#manageStock', function () {
            if ($(this).val() == 1) {
                $('#qtyDiv').show();
            } else {
                $('#qtyDiv').hide();
            }
        });
    </script>
@endsection
