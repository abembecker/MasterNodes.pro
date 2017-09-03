<div class="row bar">
    <div class="col-lg-12 col-md-12" style="text-align: center;">
        <div class="row">
            <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="display: inline-block;">
                <div class="row">
                    <div class="col-md-4 hidden-sm hidden-xs"></div>
                    <div class="col-md-2 col-sm-6 col-xs-6 bardata">
                        <div class="bardatatitle">Network Total Masternodes</div>
                        <div class="bardatadata"><span class="orange">{!! $stats['masterNodeCount']['enabled'] !!}</span></div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 bardata">
                        <div class="bardatatitle">Network Daily {!! strtoupper($stats['coinData']['coin']) !!} Earned</div>
                        <div class="bardatadata"><span class="blue">{!! number_format($stats['last24Hours']['rewards'],'2','.','') !!}</span></div>
                    </div>
                    <div class="col-md-4 hidden-sm hidden-xs"></div>
                </div>
            </div>
            <div class="col-md-1 hidden-md hidden-sm hidden-xs"></div>
        </div>
        <div class="row">
            <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="display: inline-block;">
                <div class="row">
                    <div class="col-md-2 hidden-sm hidden-xs"></div>
                    <div class="col-md-2 col-sm-6 col-xs-6  bardata">
                        <div class="bardatatitle">Network Daily Income</div>
                        <div class="bardatadata">$<span class="green">{!! number_format($stats['last24Hours']['values']['price_usd']['daily'],'2','.',',') !!}</span></div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6  bardata">
                        <div class="bardatatitle">Network Weekly Income</div>
                        <div class="bardatadata">$<span class="green">{!!  number_format($stats['last24Hours']['values']['price_usd']['weekly'],'2','.',',') !!}</span></div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6  bardata">
                        <div class="bardatatitle">Network Monthly Income</div>
                        <div class="bardatadata">$<span class="green">{!!  number_format($stats['last24Hours']['values']['price_usd']['monthly'],'2','.',',') !!}</span></div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6  bardata">
                        <div class="bardatatitle">Network Yearly Income</div>
                        <div class="bardatadata">$<span class="green">{!! number_format($stats['last24Hours']['values']['price_usd']['yearly'],'2','.',',') !!}</span></div>
                    </div>
                    <div class="col-md-2 hidden-sm hidden-xs"></div>
                </div>
            </div>
            <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
        </div>
        <div class="row">
            <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="display: inline-block;">
                <div class="row">
                    <div class="col-md-1  hidden-sm hidden-xs">
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 bardata">
                        <div class="bardatatitle">24hr Block Count</div>
                        <div class="bardatadata"><span class="orange">{!! $stats['last24Hours']['blocks'] !!}</span></div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 bardata">
                        <div class="bardatatitle">Avg. Block Time</div>
                        <div class="bardatadata"><span class="darkGreen">{!! number_format($stats['last24Hours']['blockTimes'],'1','.','') !!}</span></div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 bardata">
                        <div class="bardatatitle">Masternode Block Award</div>
                        <div class="bardatadata"><span class="blue">{!! $stats['rewardData']['masterNodeReward'] !!}</span></div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 bardata">
                        <div class="bardatatitle">{!! $stats['rewardData']['timeTillDrop']['name'] !!} to Award Drop</div>
                        <div class="bardatadata"><span class="darkGreen">{!! $stats['rewardData']['timeTillDrop']['num'] !!}</span></div>
                    </div>
                    <div class="col-sm-3 col-xs-3  hidden-lg hidden-md">
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 bardata">
                        <div class="bardatatitle">Next MN Block Award</div>
                        <div class="bardatadata"><span class="blue">{!! $stats['rewardData']['masterNodeRewardNextReward'] !!}</span></div>
                    </div>
                    <div class="col-sm-3 col-xs-3  hidden-lg hidden-md">
                    </div>
                    <div class="col-md-1  hidden-sm hidden-xs"></div>
                </div>
            </div>
            <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
        </div>
        <div class="row">
            <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="display: inline-block;">
                <div class="row">
                    <div class="col-md-2 col-sm-6 col-xs-6 bardata">
                        <div class="bardatatitle">Avg. Daily Awards</div>
                        <div class="bardatadata"><span class="blue">{!! number_format($stats['last24Hours']['perNode']['values']['price_usd']['daily'],'2','.',',') !!}</span></div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 bardata">
                        <div class="bardatatitle">Avg. Award Freqency</div>
                        <div class="bardatadata"><span class="darkGreen">{!! number_format($stats['last24Hours']['rewardFreq'],'2','.',',') !!} <span style="font-size:69%;">hrs</span></span></div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 bardata">
                        <div class="bardatatitle">Avg. Daily Income</div>
                        <div class="bardatadata">$<span class="green">{!! number_format($stats['last24Hours']['perNode']['values']['price_usd']['daily'],'2','.',',') !!}</span></div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 bardata">
                        <div class="bardatatitle">Avg. Weekly Income</div>
                        <div class="bardatadata">$<span class="green">{!! number_format($stats['last24Hours']['perNode']['values']['price_usd']['daily'],'2','.',',') !!}</span></div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 bardata">
                        <div class="bardatatitle">Avg. Monthly Income</div>
                        <div class="bardatadata">$<span class="green">{!! number_format($stats['last24Hours']['perNode']['values']['price_usd']['daily'],'2','.',',') !!}</span></div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 bardata">
                        <div class="bardatatitle">Masternode worth</div>
                        <div class="bardatadata">$<span class="green">{!! $stats['coinData']['masterNodeCoinRequired'] * $stats['price']['price_usd']  !!}</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
        </div>
    </div>
</div>