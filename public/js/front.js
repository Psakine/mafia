$(document).ready(function () {
    var panel = $('.panel');
    var placeOut = [];
    var renderCount = 0;

    $(window).resize(function () {
        $('.player-card').each(function (i, e) {
            if ($(e).hasClass('out')) {
                $(e).height($(e).width() / 1.248);
            } else {
                $(e).height($(e).width() / 0.624);
            }
        })
    });

    function getPlayers() {
        $.ajax({
            'url': '/api/games/last-players',
            'method': 'get',
            'dataType': 'json'
        }).done(function (result) {
            if (renderCount === 0) {
                panel.html('');
            }
            for (item in result) {
                let card = result[item];
                let out = '';
                let killed = '';
                let voted = '';

                if (card.out == 'killed') {
                    out = ' out';
                    killed = 'killed'
                }
                if (card.out == 'voted') {
                    out = ' out';
                    voted = 'voted';
                }

                let role = card.role ? card.role : '';
                if (role == 'citizen') {
                    role = '';
                }
                let nick = card.player.nickname;
                let place = card.place;
                let red = card.role == 'citizen' ? '' : '';
                let photo = './img/cat' + place + '.jpg';

                if (card.player.photo_src !== null) {
                    photo = card.player.photo_src;
                }
                if (renderCount === 0) {
                    panel.append(
                        '<div class="player-card' + out + red + '" style="background-image: url(' + photo + ')" id="place-' + place + '">' +
                        // '<div class="player-card'+out+red+'" style="background-color: white">\n' +
                        '        <div class="player-card__header"><span class="' + role + '"></span><span class="' + killed + voted + '"></div>' +
                        '        <div class="player-card__footer">' + '<span class="number">' + place + '</span>' +
                        '        <span class="nickname">' + nick + '</span>' +
                        '     </div>\n' +
                        '    </div>');
                }
                let player = $('#place-' + place);
                if (out.length > 0 && typeof placeOut[place] == 'undefined') {
                    placeOut[place] = place;
                    $($('#place-' + place + ' span').get(1)).addClass(killed+voted)
                    player.addClass('out');
                    player.height('120px');
                }
            }

            renderCount++
        })
    }

    // function getGame(){
    //   $.ajax({
    //     'url'      : '/api/games/last-game',
    //     'method'   : 'get',
    //     'dataType' : 'json'
    //   }).done(function(result) {
    //     $('.game-name').html(result.name);
    //   })
    // }
    // getGame();
    getPlayers();
    setInterval(function () {
        getPlayers();
    }, 10000);
});
