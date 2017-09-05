<?php
/**
 * Created by PhpStorm.
 * User: kevinpark
 * Date: 2017/9/5
 * Time: 14:12
 */

$t=date.time("H");
if ($t<"18"){
    echo "白天";
}
if ($t<"18"){
    echo "白天！";
}else{
    echo "晚上！";
}
if($t<"12"){
    echo "白天！";
}elseif ($t<"16"){
    echo "下午";
}else{
    echo "晚上！";
}