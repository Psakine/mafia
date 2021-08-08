@include('header')
@php $session = request()->session() @endphp
<form action="{{route('games.store')}}" method="post">
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
            <input type="text" name="game[name]" class="form-control" placeholder="Название игры" required value="{{$session->getOldInput('game.name')}}">
        </div>
    </div>

    @for ($i = 1; $i <= 10; $i++)
        <div class="form-row mb-4">
            @error("game.players.{$i}.id")
            @foreach($errors->get("game.players.{$i}.id") as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
            @enderror
            @error("game.players.{$i}.role")
            @foreach($errors->get("game.players.{$i}.role") as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
            @enderror
            @error("game.players.{$i}.place")
            @foreach($errors->get("game.players.{$i}.place") as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
            @enderror
            @error("game.players.{$i}.status")
            @foreach($errors->get("game.players.{$i}.status") as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
            @enderror
        </div>
        <div class="form-row mb-4">
            <div class="form-group col-md-3">
                <label for="inputNick{{$i}}">Ник</label>
                <select name="game[players][{{$i}}][id]" class="form-control" id="inputNick{{$i}}" required>
                    @foreach ($players as $player)
                        <option value="{{$player->id}}"
                                @if($session->getOldInput("game.players.{$i}.id") == $player->id) selected="selected"@endif>{{$player->nickname}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputRole{{$i}}">Роль</label>
                <select id="inputRole{{$i}}" class="form-control" name="game[players][{{$i}}][role]" required>
                    @foreach ($roles as $roleKey => $role)
                        <option value="{{$role}}" @if($session->getOldInput("game.players.{$i}.role") == $role) selected="selected"@endif>{{$roleKey}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputPlace{{$i}}">Место</label>
                <select id="inputPlace{{$i}}" class="form-control" name="game[players][{{$i}}][place]" required>
                    @for ($k = 1; $k <= 10; $k++)
                        <option value="{{$k}}" @if($k == $i) selected="selected"@endif>{{$k}}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputPlace{{$i}}">Статус</label>
                <select id="inputPlace{{$i}}" class="form-control" name="game[players][{{$i}}][status]" required>
                    <option value="table">За столом</option>
                    @foreach ($statuses as $statusKey => $status)
                        <option value="{{$status}}"
                                @if($session->getOldInput("game.players.{$i}.status") == $status) selected="selected"@endif>{{$statusKey}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endfor

    <button type="submit" class="btn btn-primary my-1">Сохранить</button>
</form><script>
  document.addEventListener('DOMContentLoaded', function(){
    document.title = "Создать игру";
  });
</script>

@include('footer')