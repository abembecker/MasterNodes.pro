<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 align-left" style="margin-top: 20px;">
    <div style="border:2px solid #E4E6EB;border-radius: 10px;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;min-width:285px;">
        <div>
            <div style="float:right;width:67%;border: 0px solid #000;text-align:center;padding:5px 0px;line-height:30px;">
                <div>
                    <span style="font-size: 18px;">
                        <a href="https://masternodes.pro/stats/{!! strtolower($one['coin']) !!}" style="text-decoration: none; color: rgb(66, 139, 202);">{!! $one['name'] !!} ({!! strtoupper($one['coin']) !!})</a>
                    </span>
                </div>
                <div>
                    <span style="font-size: 16px;">$@if ($one['cmc']['price_usd'] < 0.01) {!! $one['cmc']['price_usd'] !!} @else {!!  number_format($one['cmc']['price_usd'],2,'.','') !!} @endif USD</span>
                    <span style="font-size: 16px; font-weight: bold; color: @if($one['cmc']['percent_change_24h'] > 0) #009933 @else #D44836 @endif">({!! number_format($one['cmc']['percent_change_24h'],2,'.','') !!}%)</span>
                </div>
            </div>
            <div style="text-align:center;padding:5px 0px;width:33%;"><a href="https://masternodes.pro/stats/{!! strtolower($one['coin']) !!}"><img src="{!! $one['logo'] !!}" width="50vw"></a></div>
        </div>
        <div style="border-top: 1px solid #E4E6EB;text-align:center;clear:both;font-size:10px;font-style:italic;padding:5px 0; color: #ffffff">
            Notes: @if(isset($one['notes'])) <span style="color:red;">{!! $one['notes'] !!}</span> @else <br> @endif
        </div>
        <div style="border-top: 1px solid #E4E6EB;text-align:center;clear:both;font-size:10px;font-style:italic;padding:5px 0;">
            Coin Supply: {!! number_format($one['coin_supply'],0,'.',',') !!}
        </div>
        <div style="border-top: 1px solid #E4E6EB;text-align:center;clear:both;font-size:10px;font-style:italic;padding:5px 0;">
            MarketCap: ${!! number_format($one['cmc']['market_cap_usd'],2,'.',',') !!} USD
        </div>
        <div style="border-top: 1px solid #E4E6EB;clear:both;">
            <div style="text-align:center;float:left;width:50%;font-size:12px;padding:12px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Total Master Nodes <br><br> <span style="font-size: 17px; ">{!! $one['totalMasterNodes'] !!}</span></div>
            <div style="text-align:center;float:left;width:50%;font-size:12px;padding:12px 0 16px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Coins Locked <br><br> <span
                        style="font-size: 14px; ">{!! number_format($one['totalMasterNodes'] * $one['masterNodeCoinsRequired'],'0','',',') !!} @if ($one['coin_supply'] > 0)({!! number_format(((($one['totalMasterNodes'] * $one['masterNodeCoinsRequired']) / $one['coin_supply'] ) * 100),'2','.',',') !!}%)@endif<Br></span></div>
        </div>
        <div style="border-top: 1px solid #E4E6EB;clear:both;">
            <div style="text-align:center;float:left;width:33%;font-size:12px;padding:12px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Required Coin's <br><br> <span style="font-size: 17px; ">{!! $one['masterNodeCoinsRequired'] !!}</span></div>
            <div style="text-align:center;float:left;width:34%;font-size:12px;padding:12px 0 16px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Node Worth <br><br> <span
                        style="font-size: 14px; ">${!! number_format($one['cmc']['price_usd'] * $one['masterNodeCoinsRequired'],2,'.','') !!}</span></div>
            <div style="text-align:center;float:left;width:33%;font-size:12px;padding:12px 0 16px 0;border-right:1px solid #E4E6EB;line-height:1.25em;">
                ROI % <Br><br><span style="font-size: 20px; color: #FCB043">{!!  number_format($one['realRoi'],2,'.','') !!}%</span>
            </div>
        </div>
        <div style="border-top: 1px solid #E4E6EB;clear:both;">
            <div style="text-align:center;float:left;width:25%;font-size:12px;padding:12px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Daily <br><br> <span style="font-size: 17px; ">${!! number_format($one['income']['daily'],2,'.','') !!}</span></div>
            <div style="text-align:center;float:left;width:25%;font-size:12px;padding:12px 0 16px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Weekly <br><br> <span style="font-size: 14px; ">${!! number_format($one['income']['weekly'],2,'.','') !!}</span></div>
            <div style="text-align:center;float:left;width:25%;font-size:12px;padding:12px 0 16px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Monthly <br><br> <span style="font-size: 14px; ">${!! number_format($one['income']['monthly'],2,'.','') !!}</span></div>
            <div style="text-align:center;float:left;width:25%;font-size:12px;padding:12px 0 16px 0;line-height:1.25em;"> Yearly <br><br> <span style="font-size: 14px; ">${!! number_format($one['income']['yearly'],2,'.','') !!}</span></div>
        </div>
        <div style="border-top: 1px solid #E4E6EB;text-align:center;clear:both;font-size:10px;font-style:italic;padding:5px 0;">
            Last Updated <br>{!! $one['lastUpdated'] !!}
        </div>
    </div>
</div>