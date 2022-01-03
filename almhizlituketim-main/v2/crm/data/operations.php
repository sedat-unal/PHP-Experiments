<?php



extract($_POST);



switch($islem){

    case 1:

        delete_person($id);

    break;

    case 2:

        delete_offer($id);

    break;

    case 3:

        delete_all($id);

    break;

    case 4:
        delete_price($id);

    break;

    case 5:
        delete_offerItems($id);
    break;
}



var_dump($_POST);



function delete_person($id){

	include('../inc/connection.php');	

    $del = $conn->prepare("DELETE from clients where client_id ='$id'");

    $del->execute();

}



function delete_offer($id){

	include('../inc/connection.php');	

    $del = $conn->prepare("DELETE from offers where offer_id ='$id'");

    $del->execute();

}



function delete_all($id){

    include('../inc/connection.php');

    $del = $conn->prepare("DELETE FROM clients WHERE client_id = '$id'");

    $del->execute();



    $del_offer = $conn->prepare("DELETE FROM offers WHERE offer_client = '$id'");

    $del_offer->execute();

}

function delete_price($id){
    include('../inc/connection.php');
    $del = $conn->prepare("DELETE FROM pricelist WHERE price_id = '$id'");
    $del->execute();
}

function delete_offerItems($id){
    include('../inc/connection.php');
    $del = $conn->prepare("DELETE FROM offeritems WHERE id = '$id'");
    $del->execute();
}


?>