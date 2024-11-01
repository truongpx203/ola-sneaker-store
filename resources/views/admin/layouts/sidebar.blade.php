<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('theme/admins/velzon/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('theme/admins/velzon/assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('theme/admins/velzon/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('theme/admins/velzon/assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">

                    <a class="nav-link menu-link" href="{{route('dashboard')}}"  

                        role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                 
                </li> <!-- end Dashboard Menu -->
             
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#user" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="user">
                        <i class="ri-gift-line"></i> <span data-key="t-layouts">User</span> 
                    </a>
                    <div class="collapse menu-dropdown" id="user">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('list.user') }}" class="nav-link"
                                    data-key="t-horizontal">Danh sách</a>
                             
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('products.create') }}" class="nav-link"
                                    data-key="t-horizontal">Thêm mới </a>
                             
                            </li>
                            
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Danh mục sản phẩm </span> 
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('categories.index')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Danh sách</a>
                             
                            </li>
                            <li class="nav-item">
                                <a href="{{route('categories.create')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới </a>
                             
                            </li>
                            
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarProducts">
                        <i class="ri-gift-line"></i> <span data-key="t-layouts">Sản phẩm</span> 
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProducts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}" class="nav-link"
                                    data-key="t-horizontal">Danh sách</a>
                             
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('products.create') }}" class="nav-link"
                                    data-key="t-horizontal">Thêm mới </a>
                             
                            </li>
                            
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#variantProducts" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="variantProducts">
                        <i class="ri-product-hunt-line"></i> <span data-key="t-layouts">Sản phẩm biến thể </span>
                    </a>
                    <div class="collapse menu-dropdown" id="variantProducts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('variants.index') }}" class="nav-link" data-key="t-horizontal">Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProductsizes" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarProductsizes">
                        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Kích thước sản phẩm</span> 
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProductsizes">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('productsize.index')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Danh sách</a>
                             
                            </li>
                            <li class="nav-item">
                                <a href="{{route('productsize.create')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới </a>
                             
                            </li>
                            
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#bills" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="bills">
                        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Hóa đơn</span> 
                    </a>
                    <div class="collapse menu-dropdown" id="bills">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('bills.index')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Danh sách</a>
                             
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#review" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="review">
                        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Đánh giá</span> 
                    </a>
                    <div class="collapse menu-dropdown" id="review">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('reviews.index')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Danh sách</a>
                             
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#voucher" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="voucher">
                        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Mã giảm giá</span> 
                    </a>
                    <div class="collapse menu-dropdown" id="voucher">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('voucher.index')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Danh sách</a>
                             
                            </li>
                        </ul>
                    </div>
                </li>
                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>