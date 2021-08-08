@include('header')

<div class="row">
    <div class="col-sm text-center">
        Идентификатор
    </div>
    <div class="col-sm text-center">
        Название игры
    </div>
    <div class="col-sm text-center">
        Дата создания
    </div>
</div>
@foreach($games as $game)
    <div class="row">
        <div class="col-sm text-center">
            <a href="{{route('games.game', ['id' => $game->id])}}">{{$game->id}}</a>
        </div>
        <div class="col-sm text-center">
            <a href="{{route('games.game', ['id' => $game->id])}}">{{$game->name}}</a>
        </div>
        <div class="col-sm text-center">
            {{$game->created_at}}
        </div>
    </div>
@endforeach
<script>
  document.addEventListener('DOMContentLoaded', function(){
    document.title = "Список игр";
  });
</script>
@include('footer')