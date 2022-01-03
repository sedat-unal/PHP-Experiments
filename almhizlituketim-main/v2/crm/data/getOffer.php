<?php

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

$table = 'offers';



// Table's primary key

$primaryKey = 'offer_id';



// Array of database columns which should be read and sent back to DataTables.

// The `db` parameter represents the column name in the database, while the `dt`

// parameter represents the DataTables column identifier. In this case simple

// indexes

$columns = array(

    array(

        'db' => 'offer_client',

        'dt' => 0,

        'formatter' => function ($d, $row) {

            include "../inc/connection.php";

            $get = $conn->prepare("SELECT * FROM clients INNER JOIN offers ON clients.client_id = offers.offer_client WHERE client_id = :id");

            $get->execute([':id' => $d]);

            $getRow = $get->fetch(PDO::FETCH_ASSOC);

            $firm = $getRow['client_firm'];

            return $firm;

        }

    ),

    array('db' => 'offer_subject', 'dt' => 1),

    array('db' => 'offer_lastDate', 'dt' => 2),

    array(

        'db' => 'offer_client', 'dt' => 3,

        'formatter' => function ($d, $row) {

            include "../inc/connection.php";

            $phone = $conn->prepare("SELECT * FROM offers INNER JOIN clients ON offers.offer_client = clients.client_id where offer_client = :id");

            $phone->execute([':id' => $d]);

            $phoneRow = $phone->fetch(PDO::FETCH_ASSOC);

            $tel = $phoneRow['client_phone'];

            return "<a href='https://wa.me/90" . $tel . "' target='_blank'>&emsp; <i class='fa fa-whatsapp' style='font-size:15px;color:green'></i></a>";

        }

    ),

    array(

        'db'        => 'offer_status',

        'dt'        => 4,

        'formatter' => function ($d, $row) {

            if ($d == 2) {

                return '<span class="badge badge-success">Kabul Edildi</span>';

            } else if ($d == 1) {

                return '<span class="badge badge-danger">Reddedildi</span>';

            } else {

                return '<span class="badge badge-warning">Onay Bekliyor</span>';

            }

        }

    ),


    array(

        'db' => 'offer_id', 'dt' => 5,

        'formatter' => function ($d, $row) {

            include "../inc/connection.php";

            $get_status = $conn->prepare("SELECT * FROM offers WHERE offer_id = :id");

            $get_status->execute(array(

                "id" => $d

            ));

            $row = $get_status->fetch(PDO::FETCH_ASSOC);

            $status = $row['offer_status'];

            if ($status != 0) {

                return "<p>Gönderildi</p>";

            } else {

                return "<a  onClick='form_gonder(" . $d . ")'   >  &emsp;<i class='fa fa-paper-plane' style='font-size:20px;color:black'></i></a>";

            }

        }

    ),

    array(

        'db'        => 'offer_id',

        'dt'        => 6,

        'formatter' => function ($d, $row) {

            return "<a href='view_offer.php?id=" . $d . "'><i class='fa fa-eye' style='font-size:20px;color:green'></i></a>";

        }

    ),

    array(

        'db' => 'offer_id',

        'dt' => 7,

        'formatter' => function ($d, $row) {

            return "<a onClick='printExternal(&#34;view_offer.php?id=" . $d . "&#34;)'  >  &emsp;<i class='fa fa-print' style='font-size:20px;color:black'></i> </a>";

        }

    ),

    array(

        'db' => 'offer_id',

        'dt' => 8,

        'formatter' => function ($d, $row) {

            return "<a onClick='delete_person(" . $d . ")'> <i class='fa fa-trash' style='font-size:20px;color:black'></i> </a>";

        }

    )
);



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



