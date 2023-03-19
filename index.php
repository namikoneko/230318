<?php
ini_set('display_errors', 1);

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

    $sql = "select sum(time) from data where date = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($date));

    $rowsSum = makeRows($stmt);

    $sum = $rowsSum[0][0];

    //echo $sum;

    $blade = Flight::get('blade');//

    echo $blade->run("datas",array("rows"=>$rows,"sum"=>$sum)); //
});

Flight::route('/datas', function(){//##################################################

    $db = new PDO('sqlite:./data.db');

    $sql = "select * from data order by date desc";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $rows = makeRows($stmt);

    $rows = markdownParse($rows);

    $blade = Flight::get('blade');//

    echo $blade->run("datas",array("rows"=>$rows)); //


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
    $title = Flight::request()->data->title;//
    $time = Flight::request()->data->time;//
    $text = Flight::request()->data->text;


    $db = new PDO('sqlite:data.db');
    $stmt = $db->prepare("update data set date = ?,title = ?,time = ?,text = ? where id = ?");
    $array = array($date, $title, $time, $text, $id);
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

    $db = new PDO('sqlite:data.db');

    $stmt = $db->prepare("select * from data where text like ? order by date desc, id desc");
    $array = array("%{$word}%");
    $stmt->execute($array);

    $rows = makeRows($stmt);
    $rows = markdownParse($rows);

  $blade = Flight::get('blade');//

  echo $blade->run("datas",array("rows"=>$rows)); //

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
