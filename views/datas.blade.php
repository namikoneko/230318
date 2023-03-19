@extends("layout")

@section("content")

<!-- ins -->
    <form class="ins-form mt-2" action="dataInsExe" method="post">

<div class="row">

    <div class="col-3">
            <label for="title" class="form-label">時間帯</label>
            <input type="text" class="form-control" name='title' id="title">
    </div>

    <div class="col-3">
            <label for="time" class="form-label">時間</label>
            <input type="text" class="form-control" name='time' id="time">
    </div>

    <div class="col-4">
            <label for="text" class="form-label">作業</label>
            <textarea class="form-control" name='text' id="text"></textarea>
    </div>

    <div class="col-2 d-flex">
            <input class="btn btn-light mt-2 align-self-center" type='submit' value='insert'>
    </div>

</div>

    </form>

<!-- find -->
    <form class="ins-form mt-2 mb-3" action="find" method="get">

        <div class="row">

            <div class="col-2">
                <label for="word" class="form-label">検索（作業）</label>
            </div>

            <div class="col-4">
                <input type="text" class="inputText form-control" name="word" id="word">
            </div>

            <div class="col-1">
                <input class="btn btn-light" type='submit' value='insert'>
            </div>

        </div>

    </form>

    <div class="row border-bottom pb-2">

            <div class="col-1">
                id
            </div>

            <div class="col-2">
                日付
            </div>

            <div class="col-2">
                時間帯
            </div>

            <div class="col-2">
                時間
            </div>

            <div class="col-4">
                作業
            </div>

            <div class="col-1">
                update
            </div>

    </div>


  @foreach($rows as $row)

    <div class="row mt-2">


        <div class="col-1">
            <span class="text-black-50">{{$row["id"]}}</span>
        </div>

        <div class="col-2">
            <span class="text-black-50">{{$row["date"]}}</span>
        </div>

        <div class="col-2">
            <span class="text-black-50">{{$row["title"]}}</span>
        </div>

        <div class="col-2">
            <span class="text-black-50">{{$row["time"]}}</span>
        </div>

        <div class="col-4">
            <span class="text-black-50">
                    {!!$row["text"]!!}
            </span>
        </div>

        <div class="col-1">
            <a class="d-inline text-decoration-none py-1" href='dataUpd?id={{$row["id"]}}'>update</a>
        </div>

    </div><!--row-->

<!--

-->

  @endforeach

<div class="mb-2">
    合計：{{$sum}}
</div>


@endsection
