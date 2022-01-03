<?php 

$table = "pricelist";

$primaryKey = "price_id";

$columns = array(
    array('db' => 'price_title', 'dt' => 0),
    array('db' => 'price_desc', 'dt' => 1),
    array('db' => 'price_content', 'dt' => 2),
    array('db' => 'price_minOrder', 'dt' => 3),
    array('db' => 'price_unitPrice', 'dt' => 4),
    array(
        'db'        => 'price_id',
        'dt'        => 5,
        'formatter' => function ($d, $row) {
            return "<a href='newItem.php?id=" . $d . "'><i class='fa fa-edit' style='font-size:20px;color:black'></i></a>";
        }
    ),
    array(
        'db' => 'price_id',
        'dt' => 6,
        'formatter' => function ($d, $row) {
            return "<a onClick='delete_price(" . $d . ")'> <i class='fa fa-trash' style='font-size:20px;color:black'></i> </a>";
        }
    )
);

  $sql_details = array(
      'user' => 'rfyalmhi_data',
      'pass' => 'aDK!n@qy+0Cr',
      'db'   => 'rfyalmhi_crm',
      'host' => '5.2.87.161'
);

// $sql_details = array(
//    'user' => 'root',
//    'pass' => '',
//    'db'   => 'crm',
//    'host' => 'localhost'
// );

require('ssp.class.php');

$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback'])  ? $_GET['callback'] : false;

if ( $jsonp ) {
	echo $jsonp.'('.json_encode(
		SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
	).');';
}
