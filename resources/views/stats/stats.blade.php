@include('stats.layout.header')
<body>
@include('stats.layout.sidebar')
<div class="container-fluid">
    @include('stats.layout.logo')
    @include('stats.layout.statsbarAdv')
    @include('stats.layout.footer')
    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    </div>
</div>
@include('stats.layout.analytics')
</body>
</html>
