@extends("layout")

@section("content")

<!-- ins -->
    <form class="ins-form mt-2" action="catInsExe" method="post">

<div class="row">

    <div class="col-3">
            <label for="clno" class="form-label">clno</label>
            <input type="text" class="form-control" name='clno' id="clno">
    </div>

    <div class="col-3">
            <label for="namae" class="form-label">名前</label>
            <input type="text" class="form-control" name='namae' id="namae">
    </div>

    <div class="col-3">
            <label for="sort" class="form-label">sort</label>
            <input type="text" class="form-control" name='sort' id="sort">
    </div>

    <div class="col-2 d-flex">
            <input class="btn btn-light mt-2 align-self-bottom" type='submit' value='insert'>
    </div>

</div>

    </form>

    <div class="row mt-2 border-bottom pb-2">

        <div class="col-1">
            <span class="">id</span>
        </div>

        <div class="col-3">
            <span class="">clno</span>
        </div>

        <div class="col-3">
            <span class="">名前</span>
        </div>

        <div class="col-3">
            <span class="">sort</span>
        </div>

        <div class="col-2">
            update
        </div>

    </div><!--row-->


  @foreach($rows as $row)

    <div class="row mt-2 border-bottom pb-2">

        <div class="col-1">
            <span class="">{{$row["catId"]}}</span>
        </div>

        <div class="col-3">
            <span class="">{{$row["clno"]}}</span>
        </div>

        <div class="col-3">
            <span class="">{{$row["namae"]}}</span>
        </div>

        <div class="col-3">
            <span class="">{{$row["sort"]}}</span>
        </div>

        <div class="col-2">
            <a class="d-inline text-decoration-none py-1" href='catUpd?id={{$row["catId"]}}'>update</a>
        </div>

    </div><!--row-->

  @endforeach

@endsection
