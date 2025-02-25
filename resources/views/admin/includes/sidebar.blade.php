<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            {{--Dashboard--}}
            <li class="nav-item active"><a href="{{route('admin.dashboard')}}"><i class="la la-home"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('general.home')}} </span></a>
            </li>
            {{--Settings--}}
            <li class=" nav-item"><a href="#"><i class="la la-gear"></i>
                    <span class="menu-title"
                          data-i18n="nav.templates.main"> {{ __('admin/sidebar.settings') }}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">
                            {{ __('admin/sidebar.shipping methods') }} </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{ route('edit.shipping.methods', 'free') }}"
                                   data-i18n="nav.templates.vert.classic_menu">{{ __('admin/sidebar.free shipping') }}</a>
                            </li>
                            <li><a class="menu-item" href="{{ route('edit.shipping.methods', 'inner') }}">
                                    {{ __('admin/sidebar.inner shipping') }} </a>
                            </li>
                            <li><a class="menu-item" href="{{ route('edit.shipping.methods', 'outer') }}"
                                   data-i18n="nav.templates.vert.compact_menu"> {{ __('admin/sidebar.outer shipping') }} </a>
                            </li>

                        </ul>
                    </li>
                    <li><a class="menu-item" href="#"
                           data-i18n="nav.templates.vert.main"> {{__('general.slider_images')}} </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('admin.sliders.create')}}"
                                   data-i18n="nav.templates.vert.classic_menu">{{__('general.add')}}</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>
            {{--Categories--}}
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('general.categories')}}</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Category::count()}} </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.categories')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('general.show_all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.categories.create')}}"
                           data-i18n="nav.dash.crypto">{{__('general.add')}}</a>
                    </li>
                </ul>
            </li>
            {{--Brands--}}
            @can('brands')
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('general.brands')}}</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Brand::count()}} </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.brands')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('general.show_all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.brands.create')}}"
                           data-i18n="nav.dash.crypto">{{__('general.add')}}</a>
                    </li>
                </ul>
            </li>
            @endcan
            {{--Tags--}}
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('general.tags')}}</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Tag::count()}} </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.tags')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('general.show_all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.tags.create')}}"
                           data-i18n="nav.dash.crypto">{{__('general.add')}}</a>
                    </li>
                </ul>
            </li>
            {{--products--}}
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('general.products')}}</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Product::count()}} </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.products')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('general.show_all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.products.general.create')}}"
                           data-i18n="nav.dash.crypto">{{__('general.add')}}</a>
                    </li>
                </ul>
            </li>
            {{--attributes--}}
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('general.attributes')}}</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Attribute::count()}} </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.attributes')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('general.show_all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.attributes.create')}}"
                           data-i18n="nav.dash.crypto">{{__('general.add')}}</a>
                    </li>
                </ul>
            </li>
            {{--options--}}
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('general.options')}}</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Option::count()}} </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.options')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('general.show_all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.options.create')}}"
                           data-i18n="nav.dash.crypto">{{__('general.add')}}</a>
                    </li>
                </ul>
            </li>
            {{--roles--}}
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('general.permissions')}}</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Role::count()}} </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.roles.index')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('general.show_all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.roles.create')}}"
                           data-i18n="nav.dash.crypto">{{__('general.add')}}</a>
                    </li>
                </ul>
            </li>
            {{--users--}}
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('general.users')}}</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Admin::where('id', '<>', auth()->id())->count()}} </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.users.index')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('general.show_all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.users.create')}}"
                           data-i18n="nav.dash.crypto">{{__('general.add')}}</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
