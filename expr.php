<?php
/**
 * Created by PhpStorm.
 * User: kevinpark
 * Date: 2017/9/5
 * Time: 14:06
 */
$x=10;
$y=6;
echo ($x+$y);
echo "<br>";
echo ($x%$y);
echo "<br>";
var_dump($x>$y);

$max=($x>=$y)?$x:$y;
echo  $max;