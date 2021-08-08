@include('header')
@php $session = request()->session() @endphp
<form action="{{route('players.store')}}" method="post" enctype="multipart/form-data">
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
    <div class="row">
        <div class="col-sm text-center">
            <label for="inputNick">Ник</label>
            <input name="nickname" class="form-control" id="inputNick" required value="{{$session->getOldInput("nickname")}}">
        </div>
        <div class="col-sm text-center" id="photo-area">
            <label for="inputPhoto">Фото</label>
            <input id="inputPhoto" class="form-control mb-4" name="photo" required value="{{$session->getOldInput("photo")}}" type="file">
            <img id="photo" src="" alt="" class="w-50">
        </div>
    </div>
    <button type="submit" class="btn btn-primary my-1 mr-4">Сохранить</button>
</form>

<script>
  document.addEventListener('DOMContentLoaded', function(){
    document.title = "Создать игрока";
  });
</script>
@include('footer')