@include('header')
@php $session = request()->session() @endphp
<form action="{{route('players.update', ['id' => $player->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">
        @error("nickname")
        @foreach($errors->get("nickname") as $error)
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        @endforeach
        @enderror
        @error("photo")
        @foreach($errors->get("photo") as $error)
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        @endforeach
        @enderror
    </div>
    <div class="form-row mb-4">
        <div class="form-group col-md-6">
            <label for="inputNick">Ник</label>
            <input name="nickname" class="form-control" id="inputNick" required value="{{$session->getOldInput("nickname")??$player->nickname}}">
        </div>
        <div class="form-group col-md-6" id="photo-area">
            <label for="inputPhoto">Фото</label>
            <input id="inputPhoto" class="form-control mb-4" name="photo" @if(!$player->photo_src) required @endif value="{{$session->getOldInput("photo")}}" type="file">
            <input id="photo_src" name="photo_src" @if(!$player->photo_src) required @endif value="{{$player->photo_src}}" type="hidden">

            <img id="photo" src="{{$player->photo_src}}" alt="" class="w-50">
        </div>
    </div>
    <button type="submit" class="btn btn-primary my-1 mr-4">Сохранить</button>
    <button class="btn btn-primary my-1" id="delete-photo" type="button">Удалить фото</button>
</form>
<script>
  document.addEventListener('DOMContentLoaded', function(){
    document.title = "Редактировать игрока {{$player->nickname}}";
  });
</script>
@include('footer')