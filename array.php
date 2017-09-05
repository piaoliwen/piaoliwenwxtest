<?php
/**
 * Created by PhpStorm.
 * User: kevinpark
 * Date: 2017/9/5
 * Time: 15:27
 */
$office = array('world','excel','outlook');
$arrlength=count($office);
for ($x=0;$x<$arrlength;$x++){
    echo $office[$x];
    echo "<br>";
}
$age=array("张三"=>"25","李四"=>"24");
foreach ($age as $key=>$value){
    echo $key.$value;
    echo "<br>";
}