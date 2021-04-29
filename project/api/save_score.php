<?php

$response = ["status"=>400, "message"=>"Invalid request"];
if(isset($_POST["score"])){
    session_start();
    require(__DIR__ . "/../../lib/myFunctions.php");
    $user = get_user_id();
    $score = $_POST["score"];
    //TODO save in DB
    require(__DIR__ . "/../../lib/db.php");//<-- gives us $db
    $sql = "INSERT INTO mt_scores (user_id, score) VALUES (?,?)";
    //init a statement "object"
    $stmt = mysqli_stmt_init($db);
    //prepare the sql
    mysqli_stmt_prepare($stmt, $sql);
    //bind the values to pass in (sanitizes)
    mysqli_stmt_bind_param($stmt, "ss", $user, $score);
    //executes everything
    $retVal = mysqli_stmt_execute($stmt);

    //$retVal = mysqli_query($db, $sql);
    if($retVal){
        $response["status"]= 200;
        $response["message"] = "Recorded score of $score for user $user";
    }
    else{
        //echo mysql_error_info($db);
        $response["message"] = var_export(mysql_error_info($db), true);
    }
    
}
echo json_encode($response);
?>