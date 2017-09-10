@include('main.layout.header')
<style>
    .popover-title {
        color: white;
        background-color: black;
        font-size: 15px;
    }
</style>
<body class="exo">
{{--<script type="text/javascript" src="//go.onclasrv.com/apu.php?zoneid=1392435"></script>--}}
{{--@include('main.layout.sidebar')--}}
<div class="container-fluid">
    @include('main.layout.logo')
    <div class="row middle">
        <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
        </div>
        <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
    </div>
    <div class="row">
        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs  text-center"><script data-cfasync=false src="//s.ato.mx/p.js#id=2194065&size=160x600"></script></div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="mstr-spon-click">
                                <h3>Want your Coin Listed here?</h3>
                                <div>Email us:
                                    <a href="mailto:addme@masternodes.pro">addme@masternodes.pro</a> or join us on
                                    <a href="https://join.slack.com/t/masternodespro/shared_invite/MjM4NTczMzQyMDgzLTE1MDQ5NjEyMjEtYmFlOTVhMDVmZg"><i class="fa fa-slack" aria-hidden="true"></i>SLACK</a>
                                </div>
                                <br/>
                                <br/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mstr-coin-wrapper">
                            @foreach ($coinList as $key => $one)
                                @if(isset($one['ads']) && isset($one['ads']['location']) && $one['ads']['location'] === 'top')
                                    @if ($one['ads']['start'] <= date("m/d/Y") && $one['ads']['end'] >= date("m/d/Y") && $one['ads']['type'] === 'list')
                                        @include('main.layout.adsTopList')
                                    @else
                                        @include('main.layout.adsTopListNone')
                                    @endif
                                @endif
                            @endforeach</div>
                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <br/>
                    <br/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6"><h3 class="mstr-sort-header">Sort By...</h3></div>
                <div class="col-sm-6">
                    <select class="form-control btn-primary" id="gridSorter"></select>
                </div>
            </div>
            <div class="row activeCoinList">
                @include('main.layout.activeCoinList')
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="mstr-welcome-header text-center">Coming Soon...</h3>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('main.layout.activeComingSoonList')
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="mstr-welcome-header text-center">Help Fund Masternode Detail Site for 1 Year.</h3>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('main.layout.activeDonateList')
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <br/>
                    <br/>
                </div>
                <div class="col-md-offset-1 col-md-10 hidden-sm hidden-xs text-center">
                    <a class="twitter-timeline" data-height="400" data-theme="dark" data-link-color="#000000" href="https://twitter.com/MasterNodesPro">Tweets by MasterNodesPro</a>
                    <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>


            </div>
            <div class="row">
                <div class="col-md-12">
                    <br/><br/>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs  text-center"><script data-cfasync=false src="//s.ato.mx/p.js#id=2194065&size=160x600"></script></div>
    </div>
    @include('main.layout.footer')
    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    </div>
</div>
@include('main.layout.analytics')
<script>
    $('[data-toggle="popover"]').popover()
</script>
</body>
</html>