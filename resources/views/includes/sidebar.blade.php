<nav class="navbar navbar-expand-sm navbar-default">
    <div class="navbar-header">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="/"><img src="{{ asset('images/sidebarLogo.png') }}" alt="ASTA-INDIA" /></a>
        <a class="navbar-brand hidden" href="/"><img src="{{ asset('images/logo2.png') }}" alt="ASTA-INDIA" /></a>
    </div>

    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="">
                <a href="/">
                    <i class="menu-icon fa fa-dashboard"></i>Dashboard
                </a>
            </li>
            <h3 class="menu-title">Billing Section</h3>
            <!-- /.menu-title -->

            <li class="{{ (request()->is('billing')) ? 'active' : '' }}">
                <a href="{{ route('billing.index') }}">
                    <i class="menu-icon ti-list"></i>All bills
                </a>
            </li>

            <li class="{{ (request()->is('billing/create')) ? 'active' : '' }}">
                <a href="{{ route('billing.create') }}">
                    <i class="menu-icon ti-receipt"></i>Create new bill
                </a>
            </li>

            <li>
                <a href="widgets.html">
                    <i class="menu-icon ti-export"></i>Export bill
                </a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
