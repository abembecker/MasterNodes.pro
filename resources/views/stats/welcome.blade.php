@include('stats.layout.header')
<body>
@include('stats.layout.sidebar')
<div class="container-fluid">
    @include('stats.layout.logo')
    @include('stats.layout.statsbar')
    <div class="row middle">
        <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" class="pull-right">
                <canvas id="lineChart"></canvas>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" class="pull-left">
                <div id="map"></div>
            </div>
        </div>
        <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
    </div>
    <div class="row" style="margin-top: 50px;">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="text-align: center;">
            <div class="mybar row">
                <div class="col-md-5 col-sm-12 col-xs-12" style="text-align: center;">
                    <div class="Labels col-md-12">BLOCK DETAILS</div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 pull-left blockdetails">
                                <div class="row">
                                    <div class="hidden-lg hidden-md col-sm-3 col-xs-3 text-right orange"></div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 text-right orange">{!! $stats['blocksToday'] !!}</div>
                                    <div class="col-md-10 col-sm-7 col-xs-7 text-left">Blocks Today</div>
                                </div>
                                <div class="row">
                                    <div class="hidden-lg hidden-md col-sm-3 col-xs-3 text-right orange"></div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 text-right purple">{!! number_format($stats['last24Hours']['blockTimes'],'1','.','') !!}</div>
                                    <div class="col-md-10 col-sm-7 col-xs-7 text-left">Avg Block Time</div>
                                </div>
                                <div class="row">
                                    <div class="hidden-lg hidden-md col-sm-3 col-xs-3 text-right orange"></div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 text-right babyBlue">{!! $stats['rewardData']['masterNodeReward'] !!}</div>
                                    <div class="col-md-10 col-sm-7 col-xs-7 text-left">Block Award</div>
                                </div>
                                <div class="row">
                                    <div class="hidden-lg hidden-md col-sm-3 col-xs-3 text-right orange"></div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 text-right purple">{!! $stats['rewardData']['timeTillDrop']['num'] !!}</div>
                                    <div class="col-md-10 col-sm-7 col-xs-7 text-left">{!! $stats['rewardData']['timeTillDrop']['name'] !!} to Drop</div>
                                </div>
                                <div class="row">
                                    <div class="hidden-lg hidden-md col-sm-3 col-xs-3 text-right orange"></div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 text-right babyBlue">{!! $stats['rewardData']['nextreward'] !!}</div>
                                    <div class="col-md-10 col-sm-7 col-xs-7 text-left">Next Block Award</div>
                                </div>
                                <div class="row">
                                    <div class="hidden-lg hidden-md col-sm-3 col-xs-3 text-right orange"></div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 text-right purple">{!! number_format($stats['last24Hours']['rewardFreq'],'2','.',',') !!}</div>
                                    <div class="col-md-10 col-sm-7 col-xs-7 text-left">Reward Freq</div>
                                </div>
                                <div class="row">
                                    <div class="hidden-lg hidden-md col-sm-3 col-xs-3 text-right orange"></div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 text-right babyBlue">{!! number_format($stats['last24Hours']['perNode']['rewards'],'2','.',',') !!}</div>
                                    <div class="col-md-10 col-sm-7 col-xs-7 text-left">Avg Block Awards</div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 pull-left no-padding">
                                <canvas id="barChart"></canvas>
                                <br>
                                Blocks vs. Spec last 6 days
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 hidden-sm hidden-xs" style="text-align: center;">
                    <div class="vr2" style="display: inline-block;">&nbsp;</div>
                </div>
                <div class="col-md-5 col-sm-12 col-xs-12" style="text-align: center;">
                    <div class="Labels col-md-12">NODES BY COUNTRY</div>
                    <div class="col-md-12" style="padding-left: 0; padding-right: 0;">
                        <div class="row">
							<?php $i = 1; ?>
                            @foreach ($stats['masterNodeListCountry']['sortlist'] as $key => $value)
                                @if ($i <= 4)
                                    <div class="col-md-3 col-sm-6 col-xs-6" style="padding-left: 2%; padding-right: 2%;">
                                        <div>
                                            <canvas id="do{!! $i !!}Chart" width="400" height="400"></canvas>
                                            <br>
                                            @if($value['country_name'] !== null) {!! $value['country_name'] !!} @endif
                                            @if($value['country_name'] === '') TOR @endif
                                        </div>
                                    </div>
                                @endif
								<?php $i++; ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
    </div>
    @include('stats.layout.footer')
    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    </div>
</div>
{{--@include('mlgData',['type' => '30day'])--}}
@include('stats.layout.doughnutchart')
@include('stats.layout.barchart')
@include('stats.layout.map')
@include('stats.layout.analytics')
</body>
</html>
