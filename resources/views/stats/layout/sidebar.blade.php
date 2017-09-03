<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="{!! route('statsIndex', $coin) !!}"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
    <a href="{!! route('advstats', $coin) !!}"><i class="fa fa-percent" aria-hidden="true"></i> Advanced Stats</a>
    {{--<a href="{!! route('advgraph') !!}"><i class="fa fa-line-chart" aria-hidden="true"></i> Advanced Graph</a>--}}
    <a href="{!! route('advmap', $coin) !!}"><i class="fa fa-map" aria-hidden="true"></i> Advanced Map</a>
    {{--<a href="{!! route('advlist') !!}"><i class="fa fa-list" aria-hidden="true"></i> Advanced Node List</a>--}}
</div>
<span onclick="openNav()" class="sidebarOpen"><i class="fa fa-bars fa-3x" aria-hidden="true"></i></span>