<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ads-top-list-blade">
    <div class="row text-center">

        <div class="col-sm-3 col-xs-3 mstr-coin-icon mstr-top-quad"><a href="https://{!! strtoupper($one['coin']) !!}.masternodes.pro"
                                                         target="_blank"><img src="{!! $one['logo'] !!}"
                                                                              width="50vw"></a></div>

        <div class="col-sm-6 col-xs-6">

            <div class="col-sm-12 col-xs-12">
                <a class="mstr-coin-name text-right" href="https://{!! strtoupper($one['coin']) !!}.masternodes.pro"
                   target="_blank">{!! $one['name'] !!} ({!! strtoupper($one['coin']) !!})</a>
            </div>

            <div class="col-sm-12 hidden-xs">
                <span class="mstr-coin-current-value text-right">${!! number_format($one['currentUSDPrice'],2,'.','') !!}
                    USD</span>

                <span class="mstr-coin-pct-chg text-right" style=" color: @if($one['cmc']['percent_change_24h'] > 0) #009933 @else #D44836 @endif">({!! number_format($one['cmc']['percent_change_24h'],2,'.','') !!}%)</span>
            </div>
            <div class="col-sm-12 col-xs-12">
                <a class="mstr-website-link" href="{!! $one['url'] !!}" target="_blank">{!! $one['name'] !!} Website</a>
            </div>
        </div>
        <div class="col-sm-3 col-xs-3 mstr-top-quad" style="padding-top: 2em;">
                <div class="mstr-coin-roi">{!!  number_format($one['roi'],2,'.','') !!}%</div>
                <label>ROI</label>
        </div>

    </div>

    <div class="row mstr-coin-stats">
        <div class="col-sm-4">
            <div class="text-center">
                <div class="mstr-coin-market-cap">${!! number_format($one['cmc']['market_cap_usd'],0,'.',',') !!}</div>
                <label>Market Cap (USD)</label>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="text-center">
                <div class="mstr-coin-supply">{!! number_format($one['coin_supply'],0,'.',',') !!}</div>
                <label>Coin Supply</label>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="text-center">
                <div class="mstr-coin-coins-locked">
                    {!! number_format($one['totalMasterNodes'] * $one['masterNodeCoinsRequired'],'0','',',') !!}
                </div>
                <label>Coins Locked ({!! number_format(((($one['totalMasterNodes'] * $one['masterNodeCoinsRequired']) /  $one['coin_supply'] ) * 100),'2','.',',') !!}%)</label>
            </div>
        </div>
    </div>

    <div class="row mstr-node-stats">
        <div class="col-sm-4">
            <div class="text-center">
                <div class="mstr-coin-total-master">{!! number_format($one['totalMasterNodes'],0,'.',',') !!}</div>
                <label>Total Master Nodes</label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="text-center">
                <div class="mstr-coin-required">{!! number_format($one['masterNodeCoinsRequired'],0,'.',',') !!}</div>
                <label>Required Coins</label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="text-center">
                <div class="mstr-coin-node-worth">${!! number_format($one['currentUSDPrice'] * $one['masterNodeCoinsRequired'],0,'.',',') !!}</div>
                <label>Node Worth</label>
            </div>
        </div>
    </div>


    <div class="row mstr-coin-returns">
        <div class="col-sm-3 col-xs-3 text-center mstr-coin-table">
            <div class="mstr-coin-daily-return">${!! number_format($one['income']['daily'],2,'.','') !!}</div>
            <label>Daily</label>
        </div>
        <div class="col-sm-3 col-xs-3 text-center mstr-coin-table">
            <div class="mstr-coin-weekly-return">${!! number_format($one['income']['weekly'],2,'.','') !!}</div>
            <label>Weekly</label>
        </div>
        <div class="col-sm-3 col-xs-3 text-center mstr-coin-table">
            <div class="mstr-coin-monthly-return">${!! number_format($one['income']['monthly'],2,'.','') !!}</div>
            <label>Monthly</label>
        </div>
        <div class="col-sm-3 col-xs-3 text-center mstr-coin-table">
            <div class="mstr-coin-yearly-return">${!! number_format($one['income']['yearly'],2,'.','') !!}</div>
            <label>Yearly</label>
        </div>
    </div>
    <div class="row mstr-coin-spon">
        <div class="col-sm-4 col-xs-4 text-center">
            <span class="mstr-coin-spon">Sponsored Coin</span>
        </div>
        <div class="col-sm-4 col-xs-4 text-center">
            <span class="mstr-coin-spon">Sponsored Coin</span>
        </div>
        <div class="col-sm-4 col-xs-4 text-center">
            <span class="mstr-coin-spon">Sponsored Coin</span>
        </div>
    </div>
    <div class="row mstr-updated">
        <div class="col-sm-12 text-center">
            <br/>
            <label>Last Updated: {!! $one['lastUpdated'] !!}</label>
        </div>
    </div>
</div>