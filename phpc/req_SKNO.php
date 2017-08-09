<?php


$content .= '<head>
<meta charset="UTF-8">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="../js/datetimepicker/jquery.datetimepicker.js"></script>
<link type="text/css" href="../js/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" />
</head>';

$content .= '
<label for="unp">УНП</label><input type="number" name="unp" id="unp" placeholder="123456789" value="123456789"><br>
<label for="company">Наименование</label><input type="text" name="company" id="company" placeholder="ИП Рога и копыта" value="ИП Рога и копыта"><br>

<label for="date">Выберите желаемую дату</label>

<input id="date" type="text" value="" />


<label for="time">и время</label>
<input id="time" type="text" value="" />

<script type="text/javascript">
jQuery(\'#date\').change(function() {

if(jQuery(\'#date\').val()!=""){

    $.ajax({
        type: "GET",
        url: "/example.loc/phpc/ajaxtest.php",
        data: getDateJson(),
        success: onAjaxSuccess,
        async: true,
    });

} else {
    jQuery(\'#time\').datetimepicker({
  timepicker:false,
});
}
    
});

jQuery(function(){
    
jQuery(\'#date\').datetimepicker({
  lang:\'ru\',
  timepicker:false,
  format:\'d.m.Y\',
  minDate:0,
  closeOnDateSelect:true,
  value: getDateToday(),
});

jQuery(\'#time\').datetimepicker({
  datepicker:false,
  format:\'H:i\',
  timepicker:false,
});
});



function onAjaxSuccess(data)
{
    var parsed = JSON.parse(data);
    var arr = [];
    for(var x in parsed){
        arr.push(parsed[x]);
    }
    
  jQuery(\'#time\').datetimepicker({
  datepicker:false,
  format:\'H:i\',
  timepicker:true,
  allowTimes: arr
});
}

function getDateJson() {
    var json = {date_value:jQuery(\'#date\').val()}
    return json
}

function getDateToday() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        
        var yyyy = today.getFullYear();
        if(dd<10){
            dd=\'0\'+dd;
        } 
        if(mm<10){
            mm=\'0\'+mm;
        } 
        today = dd+\'.\'+mm+\'.\'+yyyy;
        return today;
        
}


// ]]></script>

';

$content .= '

';

echo $content;