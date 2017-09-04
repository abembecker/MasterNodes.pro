<footer class="navbar-fixed-bottom" style="text-align: center">
    <div>
        <div class="col-md-3 col-xs-12">
            Help Make this software Better: <a href="https://github.com/MasterNodesPro/MasterNodes.pro" target="_blank">GitHub</a>
        </div>
        <div class="col-md-3 dateupdated hidden-xs hidden-sm">Data Updated: {!! $stats['lastUpdated'] !!}</div>
        <div class="col-md-3 col-xs-12">Create a Masternode: <a href="{!! $stats['coinData']['createAMasterNodeURL'] !!}" target="_blank">{!! $stats['coinData']['createAMasterNodeURLTitle'] !!}</a></div>
        <div class="col-md-3 col-xs-12">Donate: <span style="color: lawngreen">{!! $stats['coinData']['donate'] !!}</span></div>
    </div>
</footer>