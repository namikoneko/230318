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

            <div class="col-3">
                <input type="text" class="inputText form-control" name="word" id="word">
            </div>

            <div class="col-2">
                <label for="clno" class="form-label">clno</label>
            </div>

            <div class="col-3">
                <input type="text" class="inputText form-control" name="clno" id="clno">
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
                見積時間帯
            </div>

            <div class="col-2">
                見積時間
            </div>

            <div class="col-4">
                作業
            </div>

            <div class="col-1">
                update
            </div>



            <div class="col-2  offset-3">
                実績時間帯
            </div>

            <div class="col-2">
                実績時間
            </div>

            <div class="col-2">
                clno
            </div>

            <div class="col-3">
                名前
            </div>



    </div>


  @foreach($rows as $row)

    <div class="row mt-2 border-bottom pb-2">


        <div class="col-1">
            <span class="">{{$row["id"]}}</span>
        </div>

        <div class="col-2">
            <span class="">{{$row["date"]}}</span>
        </div>

        <div class="col-2">
            <span class="">{{$row["title"]}}</span>
        </div>

        <div class="col-2">
            <span class="">{{$row["time"]}}</span>
        </div>

        <div class="col-4">
            <span class="">
                    {!!$row["text"]!!}
            </span>
        </div>

        <div class="col-1">
            <a class="d-inline text-decoration-none py-1" href='dataUpd?id={{$row["id"]}}'>update</a>
        </div>



        <div class="col-2 offset-3">
            <span class="">{{$row["title2"]}}</span>
        </div>

        <div class="col-2">
            <span class="">{{$row["time2"]}}</span>
        </div>

        <div class="col-2">
            <span class="">
                    {{$row["clno"]}}
            </span>
        </div>

        <div class="col-3">
            <span class="">{{$row["namae"]}}</span>
        </div>

    </div><!--row-->

<!--

-->

  @endforeach

@if($page == null)

<div class="my-2">
<ul class="list-unstyled">
    <li>見積合計：{{$sum[0]}}</li>
    <li>実績合計：{{$sum[1]}}</li>
</ul>
</div>

@endif


@if($page != null)

<div class="my-2">
  <a class="btn btn-light" href='./datas?page={{$page - 1}}'>前へ</a>
  <a class="btn btn-light" href='./datas?page={{$page + 1}}'>次へ</a>
</div>

@endif

@endsection
