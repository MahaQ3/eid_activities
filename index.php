<?php 
session_start();?>
<?php 
include 'connection_DB.php';
$tnameErr="";$dataerr="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["tname"])) {

        $Tname = mysqli_real_escape_string($GLOBALS['connection'], $_POST["tname"]);
        $query = mysqli_query($GLOBALS['connection'], "select tname from teams where tname='$Tname'")
        or die("failed to query database " . mysqli_error($GLOBALS['connection']));
        if (mysqli_num_rows($query) >0){
            $_SESSION['tname']= $Tname;
            header("location:question_page.php");
        }
        else {
            $add_team= mysqli_query($GLOBALS['connection'], "INSERT INTO teams (tname) VALUES ('$Tname')")
            or die("failed to query database " . mysqli_error($GLOBALS['connection']));
            $_SESSION['tname']= $Tname;
            header("location:question_page.php");
        }
        
    }
    else {
        $tnameErr = "هذه الخانه مطلوبه";
    }

}
?>


<!DOCTYPE html>
<html>
<head> 
<title> فعاليات العيد  </title>
<link rel="stylesheet" href="welcome.css">

</head>
<body>
<div id='content'>
<p> أكتشاف حل الألغاز ليس بالأمر الصعب ,<br>ولكن هل أنت على استعداد لمواجهة المخاطر؟
</p>
<form method='post' action=''>
<span class="error"> <?php echo $tnameErr;?></span>
<br>
<label for="tname">اسم الفريق </label>
<input type="text" id="tname" name="tname"><br><br>
<input type='submit' value="أبدا">
</form>

</div>
</body>
</html>