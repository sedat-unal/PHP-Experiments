<?php 

$table = "proforms";

$primaryKey = "proform_id";

$columns = array(
    array(
        'db' => 'proform_client',
        'dt' => 0,
        'formatter' => function ($d, $row){
            include "../inc/connection.php";
            $getFirm = $conn->prepare("SELECT * FROM proforms INNER JOIN clients ON proforms.proform_client = clients.client_id where proform_client = :id");
            $getFirm->execute([':id' => $d]);
            $firmRow = $getFirm->fetch(PDO::FETCH_ASSOC);
            $firm = $firmRow['client_firm'];
            return $firm;
        }
    ),
    array('db' => 'proform_subject', 'dt' => 1),
    array('db' => 'proform_date', 'dt' => 2),
    array(
        'db' => 'proform_client',
        'dt' => 3,
        'formatter' => function ($d, $row) {
            include "../inc/connection.php";
            $phone = $conn->prepare("SELECT * FROM proforms INNER JOIN clients ON proforms.proform_client = clients.client_id where proform_client = :id");
            $phone->execute([':id' => $d]);
            $phoneRow = $phone->fetch(PDO::FETCH_ASSOC);
            $tel = $phoneRow['client_phone'];
            return "<a href='https://wa.me/90" . $tel . "' target='_blank'>&emsp; <i class='fa fa-whatsapp' style='font-size:15px;color:green'></i></a>";
        }   
    ),
    array(
        'db' => 'proform_status',
        'dt' => 4,
        'formatter' => function ($d, $row){
            if($d == 2)
            {
                return '<span class="badge badge-success">Kabul Edildi</span>';
            }
            else if ($d == 1)
            {
                return '<span class="badge badge-danger">Reddedildi</span>';
            }
            else
            {
                return '<span class="badge badge-warning">Onay Bekliyor</span>';
            }
        }
    ),
    array(
        'db' => 'proform_status',
        'dt' => 5,
        'formatter' => function ($d, $row){
            if ($d != 0)
            {
                return "<p>Gönderildi</p>";
            }
            else
            {
                return "<a  onClick='form_gonder(" . $d . ")'   >  &emsp;<i class='fa fa-paper-plane' style='font-size:20px;color:black'></i></a>";
            }
        }
    ),
    array(
        'db' => 'proform_id',
        'dt' => 6,
        'formatter' => function ($d, $row){
            return "<a href='view_proform.php?id=" . $d . "'><i class='fa fa-eye' style='font-size:20px;color:green'></i></a>";
        }
    ),
    array(
        'db' => 'proform_id',
        'dt' => 7,
        'formatter' => function ($d, $row){
            return "<a onClick='printExternal(&#34;view_proform.php?id=" . $d . "&#34;)'  >  &emsp;<i class='fa fa-print' style='font-size:20px;color:black'></i> </a>";
        }
    ),
    array(
        'db' => 'proform_id',
        'dt' => 8,
        'formatter' => function ($d, $row) {
            return "<a onClick='delete_proform(" . $d . ")'> <i class='fa fa-trash' style='font-size:20px;color:black'></i> </a>";
        }
    )
);

$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'crm',
    'host' => 'localhost'
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

