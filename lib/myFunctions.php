<?php
function is_empty_or_null($variable){
    return !isset($variable) || empty($variable);
}
?>