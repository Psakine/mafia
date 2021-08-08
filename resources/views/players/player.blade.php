@include('header')
<div class="row mb-4">
    <div class="form-group col-md-2">
        <a href="{{route('players.edit', ['id' =>$player->id])}}" class="btn btn-primary my-1">Редактировать</a>
    </div>
    <div class="form-group col-md-2">
        <a href="{{route('players.delete', ['id' =>$player->id])}}" class="btn btn-primary my-1">Удалить</a>
    </div>
</div>
<div class="row mb-4">
    <div class="col-sm text-center">
        Ник
    </div>
    <div class="col-sm text-center">
        Фото
    </div>

</div>
<div class="row">
    <div class="col-sm text-center">
        <input type="text" readonly class="form-control" value="{{$player->nickname}}">
    </div>
    <div class="col-sm text-center">
        <img class="w-50" src="{{$player->photo_src}}" alt="">
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function(){
    document.title = "{{$player->nickname}}";
  });
</script>
@include('footer')