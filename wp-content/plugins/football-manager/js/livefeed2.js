var liveFeed = {
    getFeed: function($){
        $.ajax({
            type: 'GET',
            url:   base_url + '/LiveFeed.html',
            //url: 'http://mybongda.com/mbd/?t=football',
            cache: false,
            success: function(data) {
                if (data) {
                    var $container = $('#listEvents');
                    $container.html(data);

                    $container.find("a").each(function () {

                        liveFeed.hideLinkInConfig($(this));

                        $(this).attr('href', $(this).attr('href').replace('/mbd-detail/?match_id', '/xem-truc-tiep?game'));
                        $(this).attr('target', $(this).attr('target').replace('_blank', ''));
                    });
                    $container.find(".time_kickoff").each(function () {
                        $(this).parent().append('<img src="'+base_url+'/images/live.gif">');
                    });
                }
            }
        });
    },
    getFeedJson: function($){
        $.ajax({
            type: 'GET',
            url:   base_url + '/LiveFeed2.json',
            cache: false,
            success: function(data) {
                if (data) {
                    var $container = $('#listEvents');
                    $container.html(data.d);
                }
            }
        });
    },
    _init: function($){
        this.listEvents = $('#listEvents');
        if (this.listEvents.length) {
            try {
                liveFeed.getFeed($);
                setInterval( function() { liveFeed.getFeedJson($) }, 30000);
            } catch (e) {
                console.log(e);
            }
        }
    },
    hideLinkInConfig: function($anchor){
        var url = $anchor.attr('href');
        var captured = /match_id=([^&]+)/.exec(url)[1];
        var matchId = captured ? captured : 'myDefaultValue';

        var datahideIds = php_vars.hide_linklive;
        if (datahideIds) {
            var ids = datahideIds.split(",");
            ids.forEach (function(id) {
                if (matchId == id) {
                    $anchor.parent('.row').hide();
                }
            });
        }
    }
};