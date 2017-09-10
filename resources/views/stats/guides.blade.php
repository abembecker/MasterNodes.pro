@include('stats.layout.header')
<body>
@include('stats.layout.sidebar')
<div class="container-fluid">
    @include('stats.layout.logo')
    @if(View::exists('stats.guides.'.$coin))
        @include('stats.guides.'.$coin)
    @else
        @include('stats.guides.NOGUIDES')
        @endif
    @include('stats.layout.footer')
    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    </div>
</div>
@include('stats.layout.analytics')
</body>
</html>