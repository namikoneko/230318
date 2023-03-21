<?php
ini_set('display_errors', 1);
ini_set('date.timezone', 'Asia/Tokyo');

require_once '../libs/flight/Flight.php';
require_once '../libs/Parsedown.php';

require_once ("../libs/blade/BladeOne.php");
use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';

$blade = new BladeOne($views,$cache,BladeOne::MODE_DEBUG);
Flight::set('blade', $blade);


Flight::route('/today', function(){//##################################################

    $date = date('Y-m-d');

    $db = new PDO('sqlite:./data.db');

    $sql = "select * from data where date = ? order by title desc, id desc";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($date));

    $rows = makeRows($stmt);
    $rows = markdownParse($rows);

    $sql = "select sum(time),sum(time2) from data where date = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($date));

    $rowsSum = makeRows($stmt);
    $sum = $rowsSum[0];

    //echo $sum;

//print_r($sum);

    $blade = Flight::get('blade');//
    echo $blade->run("datas",array("rows"=>$rows,"sum"=>$sum, "page"=>null)); //
});

Flight::route('/datas', function(){//##################################################

//ページング

    $page = Flight::request()->query->page;

    $records = 50;//1ページあたりのレコード数

    if($page == null){//$pageに数値がなければ1
            $page = 1;
    }

    $offsetNum = ($page - 1) * $records;

    $db = new PDO('sqlite:./data.db');

    $sql = "select * from data left outer join cat using (clno) order by date desc limit ? offset ?";

//    $sql = "select * from data order by date desc limit ? offset ?";
//    $sql = "select * from data order by date desc";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($records, $offsetNum));
//    $stmt->execute();

    $rows = makeRows($stmt);
    $rows = markdownParse($rows);

    $blade = Flight::get('blade');//

    echo $blade->run("datas",array("rows"=>$rows, "page"=>$page)); //


//print_r($rows);

//echo "datas!";

});

Flight::route('/dataInsExe', function(){//################################################## dataIns

    $title = Flight::request()->data->title;
    //$date = date('Y-m-d');
    $text = Flight::request()->data->text;

    $db = new PDO('sqlite:./data.db');
    $stmt = $db->prepare("insert into data (date,title,text) values (?,?,?)");
    $array = array(date('Y-m-d'),$title,$text);

    $stmt->execute($array);

    Flight::redirect('/today');

    //Flight::redirect('/datas');

});

//dataUpd
Flight::route('/dataUpd', function(){//################################################## catUpd

    $id = Flight::request()->query->id;

    $db = new PDO('sqlite:./data.db');
    $stmt = $db->prepare("select * from data where id = ?");
    $array = array($id);
    $stmt->execute($array);

    $rows = makeRows($stmt);
    $row = $rows[0];

  $baseUrl = Flight::get('baseUrl');//
  $blade = Flight::get('blade');//
  echo $blade->run("dataUpd",array("row"=>$row,"baseUrl"=>$baseUrl)); //
});

Flight::route('/dataUpdExe', function(){//################################################## dataUpdExe

    $id = Flight::request()->data->id;

    $date = Flight::request()->data->date;//

    $clno = Flight::request()->data->clno;//

    $title = Flight::request()->data->title;//
    $time = Flight::request()->data->time;//

    $title2 = Flight::request()->data->title2;//
    $time2 = Flight::request()->data->time2;//

    $text = Flight::request()->data->text;


    $db = new PDO('sqlite:data.db');
    $stmt = $db->prepare("update data set date = ?,clno  = ?,title = ?,time = ?,title2 = ?,time2 = ?,text = ? where id = ?");
    $array = array($date, $clno, $title, $time, $title2, $time2, $text, $id);
    $stmt->execute($array);

    Flight::redirect('/today');

    //Flight::redirect('/datas');

});

//dataDel
Flight::route('/dataDel', function(){//################################################## dataDel

    $id = Flight::request()->query->id;

    $db = new PDO('sqlite:data.db');
    $stmt = $db->prepare("delete from data where id = ?");
    $array = array($id);
    $stmt->execute($array);

    Flight::redirect('/today');

//    Flight::redirect('/datas');
});

Flight::route('/find', function(){//################################################## dataUpdExe

//    $titleOrText = Flight::request()->query->titleOrText;
    $word = Flight::request()->query->word;
    $clno = Flight::request()->query->clno;

if($word != null){

    $db = new PDO('sqlite:data.db');

    $stmt = $db->prepare("select * from data where text like ? order by date desc, id desc");
    $array = array("%{$word}%");
    $stmt->execute($array);

    $rows = makeRows($stmt);
    $rows = markdownParse($rows);

    $sql = "select sum(time),sum(time2) from data where text like ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array("%{$word}%"));

    $rowsSum = makeRows($stmt);
    $sum = $rowsSum[0];

//print_r($sum);

  $blade = Flight::get('blade');//
  echo $blade->run("datas",array("rows"=>$rows,"sum"=>$sum)); //

}else if($clno != null){

    $db = new PDO('sqlite:data.db');

    $stmt = $db->prepare("select * from data where clno like ? order by date desc, id desc");
    $array = array("%{$clno}%");
    $stmt->execute($array);

    $rows = makeRows($stmt);
    $rows = markdownParse($rows);

    $sql = "select sum(time),sum(time2) from data where clno like ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($clno));

    $rowsSum = makeRows($stmt);
    $sum = $rowsSum[0];

  $blade = Flight::get('blade');//

  echo $blade->run("datas",array("rows"=>$rows,"sum"=>$sum)); //

    //echo "else!";
}

});

Flight::route('/sql-form', function(){//##################################################

  $blade = Flight::get('blade');//
  echo $blade->run("sql"); //

//echo "test!";

});

Flight::route('/sqlExe', function(){//##################################################

    $text = Flight::request()->data->text;
    $sql = $text;

//echo $sql;

    $db = new PDO('sqlite:data.db');

    $stmt = $db->prepare($sql);
    $array = array();
    $stmt->execute();

    Flight::redirect('/today');
/*

*/

    //$rows = makeRows($stmt);
    //$rows = markdownParse($rows);

  //$blade = Flight::get('blade');//

  //echo $blade->run("datas",array("rows"=>$rows)); //


});


Flight::route('/test', function(){//##################################################

echo "test!";

});

function makeRows($stmt){
    $i = 0;
    $rows = [];
    while($row = $stmt->fetch()){
        $row["i"] = $i;
        $rows[$i] = $row;
        $i++;
    }
    return $rows;
}

function markdownParse($rows){
  $parse = new Parsedown();
  $parse->setBreaksEnabled(true);
  $parse->setMarkupEscaped(false);
  $i = 0;
   foreach($rows as $row){
     $rows[$i]["text"] = $parse->text($row["text"]);
     $rows[$i]["rawText"] = $row["text"];//元のテキスト
     $i++;
   }
  return $rows;
}

function markdownParseOne($row){
  $parse = new Parsedown();
  $parse->setBreaksEnabled(true);
  $parse->setMarkupEscaped(false);
  $row["text"] = $parse->text($row["text"]);
  $row["rawText"] = $row["text"];//元のテキスト
  return $row;
}


Flight::start();
