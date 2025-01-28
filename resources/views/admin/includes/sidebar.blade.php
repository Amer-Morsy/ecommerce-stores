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

        </ul>
    </div>
</div>
