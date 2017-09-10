<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 active-grid-blade">
    <div class="mstr-coin-wrapper">
        <div class="row text-center">
            <div class="col-sm-3 col-xs-3 mstr-coin-icon mstr-top-quad">
                <a href="https://masternodes.pro/stats/{!! strtolower($one['coin']) !!}"><img src="{!! $one['logo'] !!}" width="50vw"></a>
            </div>
            <div class="col-sm-6 col-xs-6">
                <div class="col-sm-12 col-xs-12">
                    <a href="https://masternodes.pro/stats/{!! strtolower($one['coin']) !!}" style="text-decoration: none; color: rgb(66, 139, 202);">{!! $one['name'] !!} ({!! strtoupper($one['coin']) !!})</a>
                </div>
                <div class="col-sm-12">
                    <span class="mstr-coin-current-value text-right">$@if ($one['cmc']['price_usd'] < 0.01) {!! $one['cmc']['price_usd'] !!} @else {!!  number_format($one['cmc']['price_usd'],2,'.','') !!} @endif USD</span>
                    <span class="mstr-coin-pct-chg text-right" style=" color: @if($one['cmc']['percent_change_24h'] > 0) #009933 @else #D44836 @endif">({!! number_format($one['cmc']['percent_change_24h'],2,'.','') !!}%)</span>
                </div>
            </div>
            <div class="col-sm-3 col-xs-3 mstr-top-quad" style="padding-top: 2em;">
                <div class="mstr-coin-roi">{!!  number_format($one['realRoi'],2,'.','') !!}%</div>
                <label>{!! strtoupper(__('main.roi')) !!}</label>
            </div>
        </div>
        <div class="row mstr-coin-stats">
            <div class="col-sm-4">
                <div class="text-center">
                    <div class="mstr-coin-market-cap">${!! number_format($one['cmc']['market_cap_usd'],0,'.',',') !!}</div>
                    <label>{!! ucwords(__('main.marketCap')) !!} (USD)</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="text-center">
                    <div class="mstr-coin-supply">{!! number_format($one['coin_supply'],0,'.',',') !!}</div>
                    <label>{!! ucwords(__('main.coinSupply')) !!}</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="text-center">
                    <div class="mstr-coin-coins-locked">
                        {!! number_format($one['totalMasterNodes'] * $one['masterNodeCoinsRequired'],'0','',',') !!}
                    </div>
                    <label>{!! ucwords(__('main.coinsLocked')) !!} {!! number_format($one['totalMasterNodes'] * $one['masterNodeCoinsRequired'],'0','',',') !!} @if ($one['coin_supply'] > 0)({!! number_format(((($one['totalMasterNodes'] * $one['masterNodeCoinsRequired']) / $one['coin_supply'] ) * 100),'2','.',',') !!}%)@endif</label>
                </div>
            </div>
        </div>

        <div class="row mstr-node-stats">
            <div class="col-sm-4">
                <div class="text-center">
                    <div class="mstr-coin-total-master">{!! number_format($one['totalMasterNodes'],'0','',',') !!}</div>
                    <label>{!! ucwords(__('main.totalMasterNodes')) !!}</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="text-center">
                    <div class="mstr-coin-required">{!! number_format($one['masterNodeCoinsRequired'],'0','',',') !!}</div>
                    <label>{!! ucwords(__('main.requiredCoins')) !!}</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="text-center">
                    <div class="mstr-coin-node-worth">${!! number_format($one['cmc']['price_usd'] * $one['masterNodeCoinsRequired'],2,'.','') !!}</div>
                    <label>{!! ucwords(__('main.nodeWorth')) !!}</label>
                </div>
            </div>
        </div>


        <div class="row mstr-coin-returns">
            <div class="col-sm-3 col-xs-3 text-center mstr-coin-table">
                <div class="mstr-coin-daily-return">${!! number_format($one['income']['daily'],2,'.','') !!}</div>
                <label>{!! ucwords(__('main.daily')) !!}</label>
            </div>
            <div class="col-sm-3 col-xs-3 text-center mstr-coin-table">
                <div class="mstr-coin-weekly-return">${!! number_format($one['income']['weekly'],2,'.','') !!}</div>
                <label>{!! ucwords(__('main.weekly')) !!}</label>
            </div>
            <div class="col-sm-3 col-xs-3 text-center mstr-coin-table">
                <div class="mstr-coin-monthly-return">${!! number_format($one['income']['monthly'],2,'.','') !!}</div>
                <label>{!! ucwords(__('main.monthly')) !!}</label>
            </div>
            <div class="col-sm-3 col-xs-3 text-center mstr-coin-table">
                <div class="mstr-coin-yearly-return">${!! number_format($one['income']['yearly'],2,'.','') !!}</div>
                <label>{!! ucwords(__('main.yearly')) !!}</label>
            </div>
        </div>
        <div class="row mstr-updated">
            <div class="col-sm-12 text-center">
                <br/>
                <label>{!! ucwords(__('main.lastUpdated')) !!}: {!! $one['lastUpdated'] !!}</label>
            </div>
            {{--<div class="col-sm-12 text-center">--}}
                {{--@if ($one['tagable']['active'] === true)--}}
                    {{--<label>Notes: {!! $one['notes'] !!} </label>--}}
                {{--@endif--}}
            {{--</div>--}}
        </div>
    </div>
</div>
