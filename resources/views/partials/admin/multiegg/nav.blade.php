@include('partials/admin.multiegg.notice')

@section('multiegg::nav')
    @yield('multiegg::notice')
    <style>.fa, .fas{padding-left:3px;}</style>
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom nav-tabs-floating">
                <ul class="nav nav-tabs">
                    <li @if($activeTab === 'overview')class="active"@endif><a href="{{ route('admin.multiegg.index') }}">Overview</a></li>
                    <li @if($activeTab === 'lite')class="active"@endif><a href="{{ route('admin.multiegg.lite') }}">Lite</a></li>
                    <li @if($activeTab === 'plus')class="active"@endif><a href="{{ route('admin.multiegg.plus') }}">Plus</a></li>
                    <li @if($activeTab === 'pro')class="active"@endif><a href="{{ route('admin.multiegg.pro') }}">Pro</a></li>
                    <li @if($activeTab === 'support')class="active"@endif><a href="{{ route('admin.multiegg.support') }}">Support</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
