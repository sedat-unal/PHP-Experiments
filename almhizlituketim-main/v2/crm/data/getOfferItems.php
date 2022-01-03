<?php

  $sql_details = array(

     'user' => 'rfyalmhi_data',

     'pass' => 'aDK!n@qy+0Cr',

     'db'   => 'rfyalmhi_crm',

     'host' => '5.2.87.161'

);

// $sql_details = array(

//     'user' => 'root',
  
//     'pass' => '',
  
//     'db'   => 'crm',
  
//     'host' => 'localhost'
  
// );

$table = 'offeritems';

$primaryKey = 'id';

$columns = array(
    array('db' => 'item_name', 'dt' => 0),
    array(
        'db' => 'id',
        'dt' => 1,
        'formatter' => function ($d, $row){
            return "<a href='newOfferItems.php?id=" . $d . "'><i class='fa fa-edit' style='font-size:20px;color:black'></i></a>";
        }   
    ),
    array(
        'db' => 'id',
        'dt' => 2,
        'formatter' => function ($d, $row){
            return "<a  onClick='urunSil(".$d.")'> <i class='fa fa-trash' style='font-size:20px;color:black'></i> </a>";
        }
    ),
);

require('ssp.class.php');



$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ?

	$_GET['callback'] :

	false;



if ( $jsonp ) {

	echo $jsonp.'('.json_encode(

		SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )

	).');';

}