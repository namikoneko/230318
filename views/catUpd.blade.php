@extends("layout")

@section("content")

    <form class="ins-form" action='./catUpdExe' method='post'>

        <input type='hidden' name='id' value="{{$row['catId']}}">

        <label for="ins-clno">clno</label>
        <input type="clno" class="inputText form-control" name="clno" id="ins-clno" value="{{$row['clno']}}">

        <label for="ins-namae">名前</label>
        <input type="namae" class="inputText form-control" name="namae" id="ins-namae" value="{{$row['namae']}}">

        <label for="ins-sort">sort</label>
        <input type="sort" class="inputText form-control" name="sort" id="ins-sort" value="{{$row['sort']}}">

        <input class="btn btn-light mt-2" type='submit' value='send'>

    </form>

<div class="mt-4 mb-2 d-flex justify-content-end">
        <a class="d-inline text-decoration-none px-2 py-1" href='catDel?id={{$row["catId"]}}'>delete</a>
</div>


@endsection
