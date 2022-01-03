<?php

session_start();



// SQL server connection information

  $sql_details = array(

     'user' => 'rfyalmhi_data',

     'pass' => 'aDK!n@qy+0Cr',

     'db'   => 'rfyalmhi_crm',

     'host' => '5.2.87.161'

);

// $sql_details = array(

//   'user' => 'root',

//   'pass' => '',

//   'db'   => 'crm',

//   'host' => 'localhost'

// );



/*

 * DataTables example server-side processing script.

 *

 * Please note that this script is intentionally extremely simple to show how

 * server-side processing can be implemented, and probably shouldn't be used as

 * the basis for a large complex system. It is suitable for simple use cases as

 * for learning.

 *

 * See http://datatables.net/usage/server-side for full details on the server-

 * side processing requirements of DataTables.

 *

 * @license MIT - http://datatables.net/license_mit

 */



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

 * Easy set variables

 */



// DB table to use

$table = 'clients';



// Table's primary key

$primaryKey = 'client_id';



// Array of database columns which should be read and sent back to DataTables.

// The `db` parameter represents the column name in the database, while the `dt`

// parameter represents the DataTables column identifier. In this case simple

// indexes

$columns = array(

    array('db' => 'client_firm',  'dt' => 0),

    array('db' => 'client_person', 'dt' => 1),

    array('db' => 'client_email', 'dt' => 2),

    array(

        'db' => 'client_id', 'dt' => 3,

        'formatter' => function ($d, $row) {

            include "../inc/connection.php";

            $phone = $conn->prepare("SELECT * FROM clients where client_id = :id");

            $phone->execute([':id' => $d]);

            $phoneRow = $phone->fetch(PDO::FETCH_ASSOC);

            $tel = $phoneRow['client_phone'];

            return "<a href='https://wa.me/90" . $tel . "' target='_blank'>&emsp; <i class='fa fa-whatsapp' style='font-size:15px;color:green'></i></a>";

        }

    ),

    array(

        'db'        => 'client_status',

        'dt'        => 4,

        'formatter' => function ($d, $row) {

            if ($d == 1) {

                return '<span class="badge badge-success">Aktif</span>';

            } else {

                return '<span class="badge badge-danger">Pasif</span>';

            }

        }

    ),

    array('db' => 'client_groups', 'dt' => 5),

    array(

        'db'        => 'client_date',

        'dt'        => 6,

        'formatter' => function ($d, $row) {

            return date('jS M y', strtotime($d));

        }

    ),

    array('db' => 'client_sektor', 'dt' => 7),

    array('db' => 'client_city', 'dt' => 8),

    array('db' => 'client_adres', 'dt' => 9),

    array('db' => 'client_postCode', 'dt' => 10),

    array('db' => 'client_vkn', 'dt' => 11),

    array(

        'db'        => 'client_id',

        'dt'        => 12,

        'formatter' => function ($d, $row) {

            return "<a href='bilgiGuncelle.php?id=" . $d . "'><i class='fa fa-edit' style='font-size:20px;color:black'></i></a>";

        }

    ),

    array(

        'db' => 'client_id',

        'dt' => 13,

        'formatter' => function ($d, $row) {

            return "<a onClick='printExternal(&#34;print.php?id=" . $d . "&#34;)'  >  &emsp;<i class='fa fa-print' style='font-size:20px;color:black'></i> </a>";

        }

    ),

    array(

        'db' => 'client_id',

        'dt' => 14,

        'formatter' => function ($d, $row) {

            return "<a  onClick='delete_person(".$d.")'> <i class='fa fa-trash' style='font-size:20px;color:black'></i> </a>";

        }

    )

);





/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

 * If you just want to use the basic configuration for DataTables with PHP

 * server-side, there is no need to edit below this line.

 */



require('ssp.class.php');



$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ?

	$_GET['callback'] :

	false;



if ( $jsonp ) {

	echo $jsonp.'('.json_encode(

		SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )

	).');';

}



// echo json_encode(

// 	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )

// );

