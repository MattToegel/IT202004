<?php
$response = [
    "status"=>200,
    "data"=>[
        "paddleHeight"=>100,
        "paddleWidth" => 50,
        "ballSize"=>10,
        "ballSpeed"=>2,
        "paddleSpeed"=>3
    ]
    ];
echo json_encode($response);
?>
