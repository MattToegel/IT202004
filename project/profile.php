<?php require(__DIR__ . "/nav.php"); ?>

<?php
$user_id = get_user_id();
if (isset($_GET["id"])) {
    $user_id = $_GET["id"];
}
$isMe = $user_id == get_user_id();
require(__DIR__ . "/../lib/db.php");
$user_id = mysqli_real_escape_string($db, $user_id);
$query = "SELECT email, username, created, visibility FROM mt_users where id = $user_id";
if (!$isMe) {
    $query .= " AND visibility > 0";
}

$retVal = mysqli_query($db, $query);
$result = [];
if ($retVal) {
    $result = mysqli_fetch_array($retVal, MYSQLI_ASSOC);
}
?>
<h3>Profile</h3>
<?php if($result):?>
<form method="POST" onsubmit="return false">
    <?php if($isMe):?>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php safe($result['email']);?>" readonly/>
    </div>
    <?php endif;?>
    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?php safe($result['username']);?>" readonly/>
    </div>
    <div>
        <label for="created">Joined</label>
        <input type="text" id="created" value="<?php safe($result['created']);?>" readonly/>
    </div>
    <?php if($isMe):?>
    <div>
        <label for="vis">Visibility</label>
        <select name="vis" id="vis" readonly>
            <option <?php echo ($result['visibility'] == 0?'selected="selected"':'');?> value="0">Private</option>
            <option <?php echo ($result['visibility'] == 1?'selected="selected"':'');?> value="1">Public</option>
        </select>
    </div>
    <?php endif;?>
</form>
<h5>Scores</h5>
<?php 
$results = getScores($db, $user_id);
?>
<?php if($results && count($results) > 0):?>
    <?php foreach($results as $score):?>
        <div><?php safe($score["score"]);?> - <?php safe($score["created"]);?></div>
    <?php endforeach;?>
<?php else: ?>
    <d>This user has no scores</div>
<?php endif;?>
<?php else:?>
<p>This profile is private</p>
<?php endif;?>
