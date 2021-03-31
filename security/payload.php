<form method="POST">
<input name="user" value="<script>window.location.href='hacked.php';</script>"/>
<input type="submit"/>
</form>
<?php

if(isset($_POST["user"])){
    echo $_POST["user"];
}
?>