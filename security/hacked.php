<?php
$malicious = "<script>alert('The cookie monster has your cookies!' + document.cookie);</script>";
//echo $malicious;
echo htmlentities($malicious, ENT_QUOTES, "utf-8");
?>