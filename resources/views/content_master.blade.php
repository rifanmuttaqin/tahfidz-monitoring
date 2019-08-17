<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @yield('alert')
            <div class="card">
                <div class="header">   
                    @yield('title')
                </div>
                <div class="content">
                    {{ Breadcrumbs::render() }}
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
</div>