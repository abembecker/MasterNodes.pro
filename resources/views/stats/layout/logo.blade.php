<div class="row" style="text-align: center;">
    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <script data-cfasync=false src="//s.ato.mx/p.js#id=2194065&size=468x60"></script>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div style="display: inline-block;">
            <a href="/"><img src="{!!$stats['coinData']['logo'] !!}" class="img-responsive logo"></a><br>
            <a href="https://masternodes.pro" target="_blank">MasterNodes.pro</a>
        </div>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
        <div style="display: inline-block;">
            <div class="bardatatitle">{!! strtoupper($stats['coinData']['coin']) !!} Locked in MasterNodes</div>
            <div class="bardatadata"><span class="green">{!! number_format($stats['coinLocked']['total'],'0','',',') !!}
                    @if(isset($coinInfo['moneysupply'])) ({!! number_format(((($stats['coinLocked']['total']) /  $coinInfo['moneysupply'] ) * 100),'2','.',',') !!}%) @endif
                    @if(isset($coinInfo['total_amount'])) ({!! number_format(((($stats['coinLocked']['total']) /  $coinInfo['total_amount'] ) * 100),'2','.',',') !!}%) @endif
                </span></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div style="display: inline-block;">
            <div class="bardatatitle">{!! strtoupper($stats['coinData']['coin']) !!}->BTC Price</div>
            <div class="bardatadata"><span class="green">{!! number_format($stats['price']['price_btc'],'8','.',',') !!}</span></div>
        </div>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
        <div style="display: inline-block;">
            <div class="bardatatitle">{!! strtoupper($stats['coinData']['coin']) !!}->USD Price</div>
            <div class="bardatadata"><span class="green">{!! number_format($stats['price']['price_usd'],'2','.',',') !!}</span></div>
        </div>
    </div>
    {{--<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">--}}
        {{--<div style="display: inline-block;">--}}
            {{--<div class="bardatatitle">{!! strtoupper($stats['coinData']['coin']) !!}->GBP Price</div>--}}
            {{--<div class="bardatadata"><span class="green">{!! number_format($stats['price']['price_gbp'],'2','.',',') !!}</span></div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">--}}
        {{--<div style="display: inline-block;">--}}
            {{--<div class="bardatatitle">{!! strtoupper($stats['coinData']['coin']) !!}->AUD Price</div>--}}
            {{--<div class="bardatadata"><span class="green">{!! number_format($stats['price']['price_aud'],'2','.',',') !!}</span></div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">--}}
        {{--<div style="display: inline-block;">--}}
            {{--<div class="bardatatitle">{!! strtoupper($stats['coinData']['coin']) !!}->CNY Price</div>--}}
            {{--<div class="bardatadata"><span class="green">{!! number_format($stats['price']['price_cny'],'2','.',',') !!}</span></div>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>