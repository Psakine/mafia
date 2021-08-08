@include('header')
<form action="{{route('games.update', ['id' => $game->id])}}" method="post">
    @csrf
    <div class="form-row mb-4">
        <div class="col">
            @error('game.name')
            @foreach($errors->get('game.name') as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
            @enderror
            <label for="inputEmail4">Название игры</label>
            <input type="text" name="game[name]" class="form-control" placeholder="Название игры" required value="{{$game->name}}">
        </div>
    </div>

    @foreach ($players as $player)
        <div class="form-row mb-4">
            @error("game.players.{$player->player_id}.id")
            @foreach($errors->get("game.players.{$player->player_id}.id") as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
            @enderror
            @error("game.players.{$player->player_id}.role")
            @foreach($errors->get("game.players.{$player->player_id}.role") as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
            @enderror
            @error("game.players.{$player->player_id}.place")
            @foreach($errors->get("game.players.{$player->player_id}.place") as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
            @enderror
            @error("game.players.{$player->player_id}.status")
            @foreach($errors->get("game.players.{$player->player_id}.status") as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
            @enderror
        </div>
        <div class="form-row mb-4">
            <div class="form-group col-md-3">
                <label for="inputNick{{$player->player_id}}">Ник</label>
                <select name="game[players][{{$player->player_id}}][id]" class="form-control" id="inputNick{{$player->player_id}}" required>
                    <option value="{{$player->player_id}}" selected>{{$player->player->nickname}}</option>
                    @foreach ($allPlayers as $playerFromAll)
                        @if($player->player_id !== $playerFromAll->id)
                        <option value="{{$playerFromAll->id}}">{{$playerFromAll->nickname}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label id="game[players][{{$player->player_id}}][role]">Роль</label>
                <select name="game[players][{{$player->player_id}}][role]" class="form-control" id="inputRole{{$player->player_id}}" required>
                    <option value="{{$player->role}}" selected>{{$roles[$player->role]}}</option>
                    @foreach ($roles as $roleKey => $role)
                        @if($roles[$player->role] !== $role)
                            <option value="{{$roleKey}}">{{$role}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputPlace{{$player->player_id}}">Место</label>
                <select name="game[players][{{$player->player_id}}][place]" class="form-control" id="inputPlace{{$player->player_id}}" required>
                    <option value="{{$player->place}}" selected>{{$player->place}}</option>
                    @for ($i = 1; $i <= 10; $i++)
                        @if($i !== $player->place)
                            <option value="{{$i}}">{{$i}}</option>
                        @endif
                    @endfor
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputStatus{{$player->player_id}}">Статус</label>
                <select name="game[players][{{$player->player_id}}][status]" class="form-control" id="inputStatus{{$player->player_id}}" required>
                    <option value="{{$player->status}}" selected>{{$statuses[$player->status]}}</option>
                    @foreach ($statuses as $statusKey => $status)
                        @if($status !== $player->status)
                            <option value="{{$statusKey}}">{{$status}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    @endforeach

    <button type="submit" class="btn btn-primary my-1">Сохранить</button>
</form>
<script>
  document.addEventListener('DOMContentLoaded', function(){
    document.title = "{{$game->name}}";
  });
</script>
@include('footer')