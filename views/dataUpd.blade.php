@extends("layout")

@section("content")

    <form class="ins-form" action='./dataUpdExe' method='post'>

        <input type='hidden' name='id' value="{{$row['id']}}">

        <label for="ins-date">日付</label>
        <input type="date" class="inputText form-control" name="date" id="ins-date" value="{{$row['date']}}">

        <label for="ins-title">時間帯</label>
        <input type="text" class="inputText form-control" name="title" id="ins-title" value="{{$row['title']}}">

        <label for="ins-time">時間</label>
        <input type="text" class="inputText form-control" name="time" id="ins-time" value="{{$row['time']}}">

        <label for="ins-task">作業</label>
        <textarea class="myTextarea form-control vh-50 mt-3" name='text' id="ins-task">{{$row["text"]}}</textarea>

        <input class="btn btn-light mt-2" type='submit' value='send'>

    </form>

<div class="mt-4 mb-2 d-flex justify-content-end">
        <a class="d-inline text-decoration-none px-2 py-1" href='dataDel?id={{$row["id"]}}'>delete</a>
</div>


@endsection
