<?php
$ag = 1;
$total = count($donateCoinList);
$amount = $total / 3;?>
@foreach ($donateCoinList as $key => $one)
    @if ($ag === 1)
        <div class="row">
            @endif
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 align-left">
                <div class="mstr-coin-wrapper">
                    <div class="row">
                        <div class="col-sm-8 text-left">
                            <div class="mstr-coin-name mstr-help-fund">
                                <a href="{!! $one['url'] !!}" target="_blank">{!! $one['name'] !!}
                                    ({!! strtoupper($one['coin']) !!})</a>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <a href="{!! $one['url'] !!}" target="_blank"><img src="{!! $one['logo'] !!}"
                                                                               width="50vmin"></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <h4 class="mstr-help-fund-need">
                                <i>Need: ${!! number_format($one['balance'],'2','.',',') !!} USD</i>
                            </h4>
                        </div>
                    </div>

                    <div class="row mstr-help-fund-row">
                        <div class="col-sm-6">
                            <div class="text-center">
                                <div>${!! number_format($one['need'],'2','.',',') !!}</div>
                                <label>Required</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-center">
                                <div>${!! number_format($one['current'],'2','.',',') !!}</div>
                                <label>Balance</label>
                            </div>
                        </div>
                    </div>


                    @foreach ($one['donate'] as $donateKey => $donateOne)
                        <div class="row text-right mstr-help-fund-row">
                            <div class="col-sm-12">
                                <a class="btn btn-success btn-sm"
                                   data-toggle="popover"
                                   data-trigger="click"
                                   title="bitcoin QR Code"
                                   data-html="true"
                                   data-placement="bottom"
                                   data-content="<p><span class='mstr-coin-donate-bitcoin-address'>{!! $donateOne !!}</span></p><img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={!! $donateOne !!}' width='150'>">
                                    QR Code
                                    <span class="fa-stack fa-lg">
                                                          <i class="fa fa-circle-thin fa-stack-2x"></i>
                                                          <i class="fa fa-btc fa-stack-1x"></i>
                                                    </span>
                                </a>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
            @if($ag === 3)
				<?php $ag = 0;?>
        </div>
        @endif
		<?php $ag++; ?>
        @endforeach
        @if (!is_int($amount))
        </div>
    @endif