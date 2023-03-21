<!doctype html>
<html>
<head>
  <link rel="icon" href="/libs/221211icon.svg" type="image/svg+xml">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/libs/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/230318/views/style.css">


</head>
<body class="bg-lime-100">

    <div class="container" id="app">

    <div class="d-flex justify-content-between bg-light mt-2">

        <h3 class="m-0"><a class="text-decoration-none ps-2" href="/230318/today">230318アプリ</a></h3>

        <nav class="">
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="/230318/cat">cat</a></li>

                <li class="nav-item"><a class="nav-link" href="/230318/today">today</a></li>
                <li class="nav-item"><a class="nav-link" href="/230318/datas">data</a></li>
                <li class="nav-item"><a class="nav-link" href="/230318/sql-form">sql</a></li>
            </ul>

        </nav>

    </div>

        @yield("content")

        <p>
            footer
        </p>


    </div>

  <script src="/libs/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>

<!--


-->

</body>
</html>
