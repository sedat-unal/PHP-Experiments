<?php 
include("connection.php");
function say($tablo, $sutun = false, $deger = false ,$iz = '='){
    global $conn;
    $sql = "SELECT * FROM $tablo";
    
    if($sutun || $deger){
        
        $sql .= " WHERE $sutun $iz :$sutun";
        $query = $conn->prepare($sql);
        $query->execute([":$sutun" => $deger]);
        return $query->rowCount();
        
    }else{
        
        $query = $conn->prepare($sql);
        $query->execute();
        return $query->rowCount();
    }
    
}



?>