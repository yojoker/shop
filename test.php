<?php
function bubble_sort(&$arr){
	$len=count($arr);
	for ($i=0; $i <$len ; $i++) { 
		for ($j=1; $j < $len-$i; $j++) { 
			if( $arr[$j-1] > $arr[$j] ){
				$temp=$arr[$j-1];
				$arr[$j-1]=$arr[$j];
				$arr[$j]=$temp;
			}
		}
	}
}
$arr=array(10,2,30,14,10,25,44,66);
bubble_sort($arr);
echo "<pre>";
print_r($arr);