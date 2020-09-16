<?php
$test1 = DB::table('notificationtraits')
    ->select(DB::raw('detail'))
    ->get();
//echo $test1*/
//return array_merge($test1->toArray(), $test2->toArray());
foreach($test1 as $c){
    $c->detail;
}
?>
