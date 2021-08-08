$(document).ready(function() {
  var panel = $('.panel');

  $(window).resize(function() {
    $('.player-card').each(function(i, e) {
      if ($(e).hasClass('out')) {
        $(e).height($(e).width() / 1.248);
      } else {
        $(e).height($(e).width() / 0.624);
      }
    })
  });
  function getPlayers(){
    $.ajax({
      'url'      : '/api/games/last-players',
      'method'   : 'get',
      'dataType' : 'json'
    }).done(function(result) {
      panel.html('');
      for (item in result) {
        let card = result[item];
        let out = '';
        let killed = '';
        let voted = '';

        if(card.out == 'killed'){
          out = ' out';
          killed = 'killed'
        }
        if(card.out == 'voted'){
          out = ' out';
          voted = 'voted';
        }

        let role = card.role ? card.role : '';
        let nick = card.player.nickname;
        let place = card.place;
        let red = card.role == 'citizen' ? ' card-citizen' : '';
        let photo =  './img/cat'+place+'.jpg';

        if(card.player.photo_src !== null){
          photo = card.player.photo_src;
        }

        panel.append(
          '<div class="player-card'+out+red+'" style="background-image: url('+photo+')">\n' +
          '        <div class="player-card__header"><span class="number">'+place+'</span><span class="'+killed+voted+'"></div>\n' +
          '        <div class="player-card__footer">' +
          '        <span class="nickname">'+nick+'</span>' +
          '        <span class="'+role+'"></span>' +
          '     </div>\n' +
          '    </div>');
      }
    })
  }
  function getGame(){
    $.ajax({
      'url'      : '/api/games/last-game',
      'method'   : 'get',
      'dataType' : 'json'
    }).done(function(result) {
      $('.game-name').html(result.name);
    })
  }
  getGame();
  getPlayers();
  setInterval(function() {
    getPlayers();
  }, 10000);
});