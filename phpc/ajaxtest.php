<?php

if($_GET['date_value']=='10/08/2017'){
    $array =  array(1=>'12:00');
    echo json_encode($array);
} else {
    $array =  array(1=>'09:00', 2=>'10:00');
    echo json_encode($array);
}
