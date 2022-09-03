<aside class="main-sidebar sidebar-dark-teal elevation-0" style="background-color: teal">
    <a href="{{ route('home') }}" class="brand-link" style="background-color: #004c4c">
        <img src="https://image.winudf.com/v2/image1/dXNwLm1sZWFybi51c3Btb2JpbGVhcHBfaWNvbl8xNTU0MjA5MTk0XzAxNg/icon.png?w=170&fakeurl=1"
             alt="USP Logo"
             class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-bold">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
