<?php require(__DIR__."/nav.php");?>
<script>
function randomCatFact(){
    $.get("https://cat-fact.herokuapp.com/facts/random?animal_type=cat&amount=1", (data, status)=>{
        let fact = (data);
        console.log(fact);
        console.log(fact.text);
        $("#fact").html(fact.text);
    });

    $.get("https://cat-fact.herokuapp.com/facts/random?animal_type=cat&amount=25", (data, status)=>{
        let $ul = $("#facts");
        data.forEach(d=>{
            console.log("single fact", d);
            let $li = $("<li></li>");
            $li.text(d.text);
            $ul.append($li);
        });
    });
    
}
$(document).ready(()=>{
        randomCatFact();
    });
</script>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://cat-fact.herokuapp.com/facts/random?animal_type=cat&amount=25",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"content-type: application/x-www-form-urlencoded",
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);*/

/*$facts = [];
if($response){
    $facts = json_encode($response);
    var_export($facts);
}*/
?>


<div>
<marquee id="fact">test</marquee>
<ul id="facts">
</ul>
</div>