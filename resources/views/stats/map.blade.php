@include('stats.layout.header')
<body>
@include('stats.layout.sidebar')
<div class="container-fluid">
    @include('stats.layout.logo')
    @include('stats.layout.statsbar')
    <div class="row middle">
        <div class="col-md-1"></div>
        <div class="col-md-10" style="text-align: center;">
                    <div id="map"></div>
        </div>
        <div class="col-md-1"></div>
    </div>
    @include('stats.layout.footer')
    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    </div>
</div>
@include('stats.layout.map')
@include('stats.layout.analytics')
</body>
</html>