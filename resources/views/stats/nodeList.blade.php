@include('layout.header')
<body>
@include('layout.sidebar')
<div class="container-fluid">
    @include('layout.logo')
    @include('layout.statsbar')
    <div class="row middle hide">
        <div class="col-md-1"></div>
        <div class="col-md-10" style="text-align: center; overflow:hidden;">
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">How To Tag Your Master</div>
                <div class="panel-heading">
                    Step 1: Go to <a href="https://my.masternodes.pro" target="_blank">My.MasterNodes.Pro</a>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="row middle">
        <div class="col-md-1"></div>
        <div class="col-md-10" style="overflow:hidden;">
            <table id="myTable" class="display table table-hover">
                <thead>
                <tr>
                     <th>Status</th>
                    <th>{!! strtoupper($stats['coinData']['coin']) !!} Address</th>
                    <th>Tag</th>
                    <th>City</th>
                    <th>Region</th>
                    <th>Country</th>
                    <th>{!! strtoupper($stats['coinData']['coin']) !!} Generated</th>
                </tr>
                </thead>
                @foreach($stats['masterNodeList'] as $key => $value)
                    <tr onclick="clickMe({!! $key !!})">
                        <td>{!! $value['status'] !!}</td>
                        <td>{!! $value['addr'] !!}</td>
                        <td><kbd @if(isset($value['ipData']) && isset($value['ipData']['tag'])) class="label-info" @endif>@if(isset($value['ipData']) && isset($value['ipData']['tag'])) {!! $value['ipData']['tag'] !!} @else Not Tagged @endif</kbd></td>
                        <td>@if(isset($value['ipData']) && isset($value['ipData']['city'])) {!! $value['ipData']['city'] !!} @endif</td>
                        <td>@if(isset($value['ipData']) && isset($value['ipData']['region_name'])) {!! substr($value['ipData']['region_name'], 0, 15) !!} @endif</td>
                        <td>@if(isset($value['ipData']) && isset($value['ipData']['country_name'])) {!! $value['ipData']['country_name'] !!} @endif</td>
                        <td>{!! $value['total'] !!}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-1"></div>
    </div>
    @include('layout.footer')
    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            "order": [[6, "desc"]]
        });
    });
</script>
@include('layout.analytics')
</body>
</html>