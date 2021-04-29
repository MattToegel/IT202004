<?php

require("nav.php");
require(__DIR__ . "/../lib/db.php");

$weekly = getScores($db, -1, "weekly");
$monthly = getScores($db, -1, "monthly");
$lifetime = getScores($db, -1, "life");
?>
<div>
<div>
<h3>Weekly Scores</h3>
<?php if($weekly && count($weekly) >0):?>
<table>
    <thead>
        <th>Username</th>
        <th>Score</th>
        <th>Date</th>
    </thead>
    <tbody>
        <?php foreach($weekly as $score):?>
            <tr>
            <td>
                <a href="profile.php?id=<?php safe($score['id']);?>"><?php safe($score['username']);?></a>
            </td>
            <td><?php safe($score['score']);?></td>
            <td><?php safe($score['created']);?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php else:?>
<p>No Weekly scores</p>
<?php endif;?>
</div>

<div>
<h3>Monthly Scores</h3>
<?php if($monthly && count($weekly) >0):?>
<table>
    <thead>
        <th>Username</th>
        <th>Score</th>
        <th>Date</th>
    </thead>
    <tbody>
        <?php foreach($monthly as $score):?>
            <tr>
            <td>
                <a href="profile.php?id=<?php safe($score['id']);?>"><?php safe($score['username']);?></a>
            </td>
            <td><?php safe($score['score']);?></td>
            <td><?php safe($score['created']);?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php else:?>
<p>No Monthly scores</p>
<?php endif;?>
</div>

<div>
<h3>Lifetime Scores</h3>
<?php if($lifetime && count($lifetime) >0):?>
<table>
    <thead>
        <th>Username</th>
        <th>Score</th>
        <th>Date</th>
    </thead>
    <tbody>
        <?php foreach($lifetime as $score):?>
            <tr>
            <td>
                <a href="profile.php?id=<?php safe($score['id']);?>"><?php safe($score['username']);?></a>
            </td>
            <td><?php safe($score['score']);?></td>
            <td><?php safe($score['created']);?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php else:?>
<p>No Lifetime scores</p>
<?php endif;?>
</div>
</div>