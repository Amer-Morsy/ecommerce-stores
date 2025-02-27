<div class="header-center hidden-sm-down">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div id="_desktop_logo"
                 class="contentsticky_logo d-flex align-items-center justify-content-start col-lg-3 col-md-3">
                <a href="/">
                    <img class="logo img-fluid logo-img"
                         style="width: 80px; height: 80px; border-radius: 50%"
                         src="{{asset('assets/admin/images/logo/logo.png')}}"
                         alt="logo">
                </a>
            </div>
            <div class="col-lg-9 col-md-9 header-menu d-flex align-items-center justify-content-end">
                <div class="data-contact d-flex align-items-center">
                    <div class="title-icon">support<i class="icon-support icon-address"></i></div>
                    <div class="content-data-contact">
                        <div class="support">Call customer services :</div>
                        <div class="phone-support">
                            1234 567 899
                        </div>
                    </div>
                </div>
                <div class="contentsticky_group d-flex justify-content-end">
                    {{--                    <div class="header_link_myaccount">--}}
                    {{--                        <a class="login" href="login-1.html" rel="nofollow" title="Log in to your customer account"><i--}}
                    {{--                                class="header-icon-account"></i></a>--}}
                    {{--                    </div>--}}
                    <div class="header_link_wishlist">
                        <a href="{{route('wishlist.products.index')}}" title="My Wishlists">
                            <i class="header-icon-wishlist"></i>
                        </a>

                    </div>

                    <div id="_desktop_cart">
                        <div class="blockcart cart-preview active" data-refresh-url="">
                            <div class="header-cart">
                                <div class="cart-left">
                                    <a href="{{route('site.cart.index')}}" title="My Wishlists">
                                        <div class="shopping-cart">
                                            <i class="zmdi zmdi-shopping-cart"></i>

                                        </div>

                                    </a>
                                    <div class="cart-products-count">@isset($basket) {{$basket -> itemCount() }} @else
                                            0 @endisset</div>
                                </div>
                                <div class="cart-right d-flex flex-column align-self-end ml-13">
                                    <span class="title-cart">Cart</span>
                                    <span class="cart-item"> items</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
