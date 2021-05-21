<?php
// sesstion
session_start();
if (!isset($_SESSION['tname'])){
 
    header("location: index.php");
}

$page = $_SERVER['PHP_SELF'];
$sec = "30";

include 'connection_DB.php';

// check what is question ?
function question_num($q) {
    $query = mysqli_query($GLOBALS['connection'], "select * from qanda where question_num='$q'");
    $result = mysqli_fetch_array($query);
    return array($result['question_num'] ,$result['answer']) ;

}
foreach(array_keys($_POST) as $ques)
    {
      if (!empty($_POST[$ques]&& $_SERVER['REQUEST_METHOD'] == 'POST')) {
        $next_state=$ques+1;
        $res=question_num($ques) ;
        $ques = mysqli_real_escape_string($connection, $_POST[$ques]);
        // echo $res[1];
        if ($ques == $res[1])
        {
          $tname=$_SESSION['tname'];
          $query1 = mysqli_query($GLOBALS['connection'], "UPDATE teams set scores=scores+1 WHERE tname='$tname'");
          $query2=  mysqli_query($GLOBALS['connection'], " UPDATE state set state_num=$next_state");
        }

      }

        
      }
    

?>

<html>
<head>
<title> فعاليات العيد </title>
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
<link rel="stylesheet" href="question_style.css">
</head>

<body>
<div>
<?php

    $query = mysqli_query($connection, "select * from state ");
    $result = mysqli_fetch_array($query);
    $current_state= $result['state_num'];
    $out="";

// state 1 :
switch ($current_state) {
    case 1:
      $q1=question_num(1);
      $out.='<div id="fq1"> 
      <label for="fq1"> المرحله الاولى  </lable>
      <p> اللون الاصفر والبنفسجي يظهران بي <br/>
      رغم انني محاط بالرمادي ومع ذلك لست سوى <br/>
      حصان او شخص في أوهامكم ! 
      </p>
      <form method="post" >
      <input type="text" id="q1" name="1"><br><br>
      <input type="submit" value="ارسل">
      </form>

      </div>';
      break;
    case 2:
      $q1=question_num(2);
      $out.='<div id="fq2"> 
      <label for="fq2"> المرحله الثانية  </lable>
      <p> ربما لم تقم بالطيران من قبل ولكن  <br/>
      لابد وان جعلتك تشعر بذلك يوما.
      </p>
      <form method="post" >
      <input type="text" id="q2" name="2"><br><br>
      <input type="submit" value="ارسل">
      </form>
      </div>';
    break;
    
    case 3:
      $q1=question_num(3);
      $out.='<div id="fq3"> 
      <label for="fq3"> المرحله الثالثة  </lable>
      <p> ساضل رفيقة لسيدتي رغما لمحاولتها في التخلي عني سنة 2009  <br/>
      </p>
      <form method="post" >
      <input type="text" id="q3" name="3"><br><br>
      <input type="submit" value="ارسل">
      </form>

      </div>';
    break;

    
    case 4:
      $q1=question_num(4);
      $out.='<div id="fq4"> 
      <label for="fq4"> المرحله الرابعة  </lable>
      <p> قم بارسال سالفة "راسي بالجفره" الوارده بين امي لطيفه وهياء   <br/>
لمعد المسابقة على الواتس ثم تقيم من قبل الوالد القائد او الوالده لاكثر سرد مطابق للقصة <br/>
يكسب الفريق الفائز كود الانتقال للمرحلة التالية .
      </p>
      <form method="post" >
      <input type="text" id="q4" name="4"><br><br>
      <input type="submit" value="ارسل">
      </form>

      </div>';
    break;

    
    case 5:
      $q1=question_num(5);
      $out.='<div id="fq5"> 
      <label for="fq5"> المرحله الخامسة  </lable>
      <p> بعض مابي هو أرث وهو محرم عليكم مالم يأتي شخص غريب .  <br/>
      </p>
      <form method="post" >
      <input type="text" id="q5" name="5"><br><br>
      <input type="submit" value="ارسل">
      </form>

      </div>';
    break;

    
    case 6:
      $q1=question_num(6);
      $out.='<div id="fq6"> 
      <label for="fq6"> المرحله السادسة  </lable>
      <p>انا الوسيط مابين سطحين <br/>
      </p>
      <form method="post" >
      <input type="text" id="q6" name="6"><br><br>
      <input type="submit" value="ارسل">
      </form>

      </div>';
    break;

    
    case 7:
      $q1=question_num(7);
      $out.='<div id="fq7"> 
      <label for="fq7"> المرحله الاخيره  </lable>
      <p> "أسماء عائلتكم  "  <br/>
      من هولاء ؟ 
      </p>
      <form method="post" >
      <input type="text" id="7" name="7"><br><br>
      <input type="submit" value="ارسل">
      </form>

      </div>';
    break;
    case 8:
      echo '<div id="final"> <label for="final">مبروك لقد توصلتم للنهاية ! </lable>';
       
      $sql = "SELECT * from teams ORDER BY `teams`.`scores` DESC";
      $result = $conn->query($sql);
      echo "<br/> <br/><table id='winner'> <tr> <td> اسم الفريق </td> <td> نقاطه </td></tr>";

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr><td> " . $row["tname"]. " </td><td> " . $row["scores"]. " </td></tr>" ;
        }
      }
      echo "</table>";
      $conn->close();
      echo "</table > ";
      

      echo'</div>';
    break;


  }
  echo $out ;

?>
</div>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

</body>
</html>
