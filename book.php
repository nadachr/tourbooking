<?php 

include 'condb.php';

if(isset($_POST['submit'])){
    $tourid = $_POST['tourid'];
    $email = $_POST['email'];
    $adult = $_POST['adult'];
    $child = $_POST['child'];
    $total = $_POST['total'];
    $price = $_POST['priceTotal'];

    $sql = "INSERT INTO tbbookingdetail(bkid, ref_planno, noofAdult, noofChild, noofTotal, email) 
            VALUE(NULL, $tourid, $adult, $child, $price, '$email')";
    $sql2 = "UPDATE tbplanning SET numBooking = numBooking + $total WHERE ref_pktourid = $tourid";
    $insert = mysqli_query($con, $sql);
    $insert2 = mysqli_query($con, $sql2);
    
    if($insert){
        Header("Location: cart-list.php");
    }else {
        echo "INSERT INTO tbbookingdetail(bkid, ref_planno, noofAdult, noofChild, noofTotal, email) 
        VALUE(NULL, $tourid, $adult, $child, $price, '$email')";
    } 
}
?>