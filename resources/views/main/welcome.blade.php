@include('main.layout.header')
<style>
    .popover-title {
        color: white;
        background-color: black;
        font-size: 15px;
    }
</style>
<body>
@include('main.layout.sidebar')
<div class="container-fluid">
    @include('main.layout.logo')
    <div class="row middle">
        <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
        </div>
        <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
    </div>
    <div class="row" style="margin-top: 50px;">
        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs" style="text-align: center;"><a href="https://www.vultr.com/?ref=6877914" target="_blank"><span style="font-size: 16px">Best VPS Hosting<br>for Masternodes</span><br><img src="https://www.vultr.com/media/banner_4.png" width="160"
                                                                                                                                                                                                                                     height="600"></a></div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="text-align: center;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <div class="row">
                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <br><br><br>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <div class="alert alert-info">Want your Coin Listed here? join us on
                    <a href="https://join.slack.com/t/masternodespro/shared_invite/MjI5Mjc4MDY3ODc3LTE1MDMyNTk5ODQtMTYzMmM2ODcwYQ" target="_blank"><i class="fa fa-slack" aria-hidden="true"></i>SLACK</a>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="text-align: center;">
                    <div class="btn-toolbar btn-group" role="toolbar">
                        <a href="/?sort=roi&view={!! $clview !!}" type="button" class="btn btn-primary @if ($clselect === 'roi') active @endif">ROI %</a>
                        <a href="/?sort=marketCap&view={!! $clview !!}" type="button" class="btn btn-primary @if ($clselect === 'marketCap') active @endif">Market Cap</a>
                        <a href="/?sort=coinSupply&view={!! $clview !!}" type="button" class="btn btn-primary @if ($clselect === 'coinSupply') active @endif">Coin Supply</a>
                        <a href="/?sort=totalMasterNodes&view={!! $clview !!}" type="button" class="btn btn-primary @if ($clselect === 'totalMasterNodes') active @endif">Total MasterNodes</a>
                        <a href="/?sort=coinsLocked&view={!! $clview !!}" type="button" class="btn btn-primary @if ($clselect === 'coinsLocked') active @endif">Coins Locked</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align: center;">
                    <div class="btn-toolbar btn-group" role="toolbar">
                        <a href="/?sort=dailyRev&view={!! $clview !!}" type="button" class="btn btn-primary @if ($clselect === 'dailyRev') active @endif">Daily</a>
                        <a href="/?sort=weeklyRev&view={!! $clview !!}" type="button" class="btn btn-primary @if ($clselect === 'weeklyRev') active @endif">Weekly</a>
                        <a href="/?sort=monthlyRev&view={!! $clview !!}" type="button" class="btn btn-primary @if ($clselect === 'monthlyRev') active @endif">Monthly</a>
                        <a href="/?sort=yearlyRev&view={!! $clview !!}" type="button" class="btn btn-primary @if ($clselect === 'yearlyRev') active @endif">Yearly</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align: center;">
                    <div class="btn-toolbar btn-group" role="toolbar">
                        <a href="/?sort={!! $clselect !!}&view=grid" type="button" class="btn btn-primary @if ($clview === 'grid') active @endif"><i class="fa fa-th" aria-hidden="true"></i></a>
                        {{--<a href="/?sort={!! $clselect !!}&view=list" type="button" class="btn btn-primary @if ($clview === 'list') active @endif"><i class="fa fa-bars" aria-hidden="true"></i></a>--}}
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                @foreach ($coinList as $key => $one)
                    @if ($clview === 'grid')
                        @include('main.layout.activeGrid')
                    @elseif($clview === 'list')
                        @include('main.layout.activeList')
                    @endif
                @endforeach
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <br><br><br>
            </div>
            {{--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">--}}
                {{--<div class="alert alert-info">Old CodeBase.</div>--}}
            {{--</div>--}}
            {{--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">--}}
                {{--@foreach ($coinListOld as $key => $one)--}}
                    {{--@if ($clview === 'grid')--}}
                        {{--@include('main.layout.activeGrid')--}}
                    {{--@elseif($clview === 'list')--}}
                        {{--@include('main.layout.activeList')--}}
                    {{--@endif--}}
                {{--@endforeach--}}
            {{--</div>--}}
            {{--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">--}}
                {{--<br><br><br>--}}
            {{--</div>--}}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <div class="alert alert-info">Coming Soon.</div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                @foreach ($ComingSoonCoinList as $key => $one)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 align-left" style="margin-top: 20px;">
                        <div style="border:2px solid #E4E6EB;border-radius: 10px;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;min-width:285px;">
                            <div>
                                <div style="float:right;width:67%;border: 0px solid #000;text-align:center;padding:5px 0px;line-height:30px;">
                                    <div>
                                        <span style="font-size: 18px;">
                                            <a href="{!! $one['url'] !!}" target="_blank" style="text-decoration: none; color: rgb(66, 139, 202);">{!! $one['name'] !!} ({!! strtoupper($key) !!})</a>
                                        </span>
                                    </div>
                                </div>
                                <div style="text-align:center;padding:5px 0px;width:33%;"><a href="{!! $one['url'] !!}" target="_blank"><img src="{!! $one['logo'] !!}" width="50vw"></a></div>
                            </div>
                            <div style="border-top: 1px solid #E4E6EB;text-align:center;clear:both;font-size:10px;font-style:italic;padding:5px 0;">
                                {!! $one['notes'] !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <br><br><br>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <div class="alert alert-info">Help Fund Masternode Detail Site for 1 Year.</div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                @if (is_array($donateCoinList))
                    @foreach ($donateCoinList as $key => $one)
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 align-left" style="margin-top: 20px; height:260px">
                            <div style="border:2px solid #E4E6EB;border-radius: 10px;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;min-width:285px;">
                                <div>
                                    <div style="float:right;width:67%;border: 0px solid #000;text-align:center;padding:5px 0px;line-height:30px;">
                                        <div>
                                        <span style="font-size: 18px;">
                                            <a href="{!! $one['url'] !!}" target="_blank" style="text-decoration: none; color: rgb(66, 139, 202);">{!! $one['name'] !!} ({!! strtoupper($one['coin']) !!})</a>
                                        </span>
                                        </div>
                                        <div><span style="font-size: 16px;">Need ${!! number_format($one['balance'],'2','.',',') !!} USD</span></div>
                                    </div>
                                    <div style="text-align:center;padding:5px 0px;width:33%;"><a href="{!! $one['url'] !!}" target="_blank"><img src="{!! $one['logo'] !!}" width="50vmin"></a></div>
                                </div>
                                <div style="border-top: 1px solid #E4E6EB;clear:both;">
                                    <div style="text-align:center;float:left;width:50%;font-size:12px;padding:12px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Required <br><br> <span style="font-size: 17px; ">${!! number_format($one['need'],'2','.',',') !!}</span></div>
                                    <div style="text-align:center;float:left;width:50%;font-size:12px;padding:12px 0 16px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Balance <br><br> <span
                                                style="font-size: 14px; ">${!! number_format($one['current'],'2','.',',') !!}</span></div>
                                </div>
                                @foreach ($one['donate'] as $donateKey => $donateOne)
                                    <div style="border-top: 1px solid #E4E6EB;text-align:center;clear:both;font-size:10px;font-style:italic;padding:5px 0;">
                                        {!! strtoupper($donateKey) !!} <br><br> <span style="font-size: 14px; ">
                                    <a href="{!! strtoupper($donateKey) !!}:{!! $donateOne !!}" target="_blank"
                                       data-toggle="popover" data-trigger="hover" title="{!! strtoupper($donateKey) !!} address"
                                       data-html="true" data-content="<img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={!! $donateOne !!}' width='150'>">
                                        {!! $donateOne !!}
                                    </a></span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <br><br><br>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="text-align: center;">
                    <script data-cfasync=false src="//s.ato.mx/p.js#id=2194065&size=728x90"></script>
                </div>
                <div class="col-lg-4 col-md-4 hidden-sm hidden-xs" style="text-align: center;">
                    <div class="col-lg-12 col-md-12 col-sm-9 col-xs-9" style="text-align: center;">
                        <a class="twitter-timeline" data-height="250" data-theme="dark" data-link-color="#000000" href="https://twitter.com/MasterNodesPro">Tweets by MasterNodesPro</a>
                        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs" style="text-align: center;"><a href="https://www.vultr.com/?ref=6877914" target="_blank"><span style="font-size: 16px">Best VPS Hosting<br>for Masternodes</span><br><img src="https://www.vultr.com/media/banner_4.png" width="160"
                                                                                                                                                                                                                                     height="600"></a></div>
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
