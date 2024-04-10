<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>{{ $title }}</h1>
            </div>
        </div>
    </div>
    @if (!request()->is('home'))
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        @foreach ($breadCrumbs as $bc)
                            @if ($bc['url'] == "#")
                                <li class="{{ $bc['state'] }}">{{ $bc['name'] }}</li>
                            @else
                                <li><a href="{{ $bc['url'] }}">{{ $bc['name'] }}</a></li>
                            @endif

                        @endforeach

                    </ol>
                </div>
            </div>
        </div>
    @endif
</div>
