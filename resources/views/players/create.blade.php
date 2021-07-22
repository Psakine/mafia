@include('header')
<div class="row">
    <div class="col-sm text-center">
        Идентификатор
    </div>
    <div class="col-sm text-center">
        Фото
    </div>
    <div class="col-sm text-center">
        Клуб
    </div>
    <div class="col-sm text-center">
        Ник
    </div>
</div>
@foreach($players as $player)
    <div class="row">
        <div class="col-sm text-center">
            <a href="{{route('game', ['id' => $player->id])}}">{{$player->id}}</a>
        </div>
        <div class="col-sm text-center">
            <img src="{{$player->photo_src}}" alt="">
        </div>
        <div class="col-sm text-center">
            <a href="{{route('game', ['id' => $player->id])}}">{{$player->club}}</a>
        </div>
        <div class="col-sm text-center">
            <a href="{{route('game', ['id' => $player->id])}}">{{$player->nickname}}</a>
        </div>
    </div>
@endforeach
@include('footer')