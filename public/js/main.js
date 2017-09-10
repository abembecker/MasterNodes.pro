$( document ).ready(function() {

    var gridSorterOptions = [
        {
            "name": "roi",
            "label": "ROI%",
            "url": "?sort=roi&view=grid"
        },
        {
            "name": "marketCap",
            "label": "Market Cap",
            "url": "?sort=marketCap&view=grid"
        },
        {
            "name": "coinSupply",
            "label": "Coin Supply",
            "url": "?sort=coinSupply&view=grid"
        },
        {
            "name": "totalMasterNodes",
            "label": "Total Master Nodes",
            "url": "?sort=totalMasterNodes&view=grid"
        },
        {
            "name": "coinsLocked",
            "label": "Coins Locked",
            "url": "?sort=coinsLocked&view=grid"
        },
        {
            "name": "dailyRev",
            "label": "Daily",
            "url": "?sort=dailyRev&view=grid"
        },
        {
            "name": "weeklyRev",
            "label": "Weekly",
            "url": "?sort=weeklyRev&view=grid"
        },
        {
            "name": "monthlyRev",
            "label": "Monthly",
            "url": "?sort=monthlyRev&view=grid"
        },
        {
            "name": "yearlyRev",
            "label": "Yearly",
            "url": "?sort=yearlyRev&view=grid"
        }
    ];


    if ($(".active-grid-blade").text()){
        var gs = $("#gridSorter");
        var getUrl = window.location;
        var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

        for (var i = 0; i < gridSorterOptions.length; i++) {
            var option = $('<option data-rel-url="' + gridSorterOptions[i].url + '" value="' + gridSorterOptions[i].name + '">' + gridSorterOptions[i].label + '</option>');
            gs.append(option);
        }

        gs.change(function(){
            console.log('test');
            $('.activeCoinList').load("/sortActiveView/" + $(':selected').attr('data-rel-url'));
            // window.location.href = baseUrl + $(':selected').attr('data-rel-url');
        });
    }


    if ($(".mstr-tagit-blade").text()){

        function gotoNextStep(data, node){
            if (data.hasOwnProperty('coinAddress') && $(node).find('.mstr-tag-coin-addr').find(".form-control").val){

                data.coinAddress = $(node).find('.mstr-tag-coin-addr').find(".form-control").val;
                $('.mstr-tag-coin-addr').toggle();
                $('.mstr-tag-coin-cmd').toggle();

            } else if (data.hasOwnProperty('shownCmd') && data.shownCmd !== null){

                data.shownCmd = true;
                $('.mstr-tag-coin-cmd').toggle();
                $('.mstr-tag-coin-hash').toggle();

            } else if (data.hasOwnProperty('signMsgHash') && data.signMsgHash !== null){

                data.signMsgHash = $(node).find('.mstr-tag-coin-hash').find(".form-control").val;
                $('.mstr-tag-coin-hash').toggle();

            } else if (data.hasOwnProperty('tagName') && data.tagName !== null){

                data.tagName = $(node).find('.mstr-tag-coin-tagname').find(".form-control").val;
                $('.mstr-tag-coin-tagname').toggle();
                $(".mstr-tag-next").toggle();
                $('.mstr-tag-submit').toggle();

            } else {
                $('.mstr-tag-coin-addr').toggle();
                $(".mstr-tag-next").toggle();
            }
        }

        // set event handler for clicks on all next buttons, and set up data structure
        $(".mstr-tagit-list-item").each(function(){

            var nodeTagData = {
                "coinAddress": null,
                "shownCmd": null,
                "signMsgHash": null,
                "tagName": null
            };

            $(this).find(".mstr-tag-next").on('click', function(event){
                gotoNextStep(nodeTagData, this);
            });


        });
    }


});