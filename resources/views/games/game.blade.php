@include('header')
@csrf
<div class="form-row mb-4">
    <div class="col">
        <label for="inputEmail4">Название игры</label>
        <input type="text" class="form-control" value="{{$game->name}}" readonly>
    </div>
</div>
<div class="form-row mb-4">
    <div class="form-group col-md-2">
        <a href="{{route('games.edit', ['id' =>$game->id])}}" class="btn btn-primary my-1">Редактировать</a>
    </div>
    <div class="form-group col-md-2">
        <a href="{{route('games.delete', ['id' =>$game->id])}}" class="btn btn-primary my-1">Удалить</a>
    </div>
</div>

@foreach ($players as $player)
    <div class="form-row mb-4">
        <div class="form-group col-md-3">
            <label>Ник</label>
            <input class="form-control" readonly value="{{$player->player->nickname}}">
        </div>
        <div class="form-group col-md-3">
            <label>Роль</label>
            <input type="text" class="form-control" readonly value="{{$roles[$player->role]}}">
        </div>
        <div class="form-group col-md-3">
            <label>Место</label>
            <input type="text" class="form-control" readonly value="{{$player->place}}">
        </div>
        <div class="form-group col-md-3">
            <label>Статус</label>
            <input type="text" class="form-control" readonly value="{{$statuses[$player->status]}}">
        </div>
    </div>
@endforeach
@include('footer')