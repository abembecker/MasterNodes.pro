<?php
$ag = 1;
$total = count($donateCoinList);
$amount = $total / 3;?>
@foreach ($ComingSoonCoinList as $key => $one)
    @if ($ag === 1)
        <div class="row">
            @endif
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 align-left">
                <div class="mstr-coming-soon-wrapper">
                    <div class="text-center">

                                    <span class="mstr-coin-name">
                                        <a href="{!! $one['url'] !!}" target="_blank">{!! $one['name'] !!} ({!! strtoupper($key) !!})</a>
                                    </span>

                        <div>
                            <a href="{!! $one['url'] !!}" target="_blank"><img src="{!! $one['logo'] !!}" width="50vw"></a>
                        </div>

                        <div class="mstr-coming-soon-notes">
                            {!! $one['notes'] !!}
                        </div>
                    </div>
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