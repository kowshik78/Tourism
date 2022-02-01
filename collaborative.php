<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ghuraghuri";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM package_rating";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $array[] = $row;
}

function rating($uid, $item_name, $zeroAllowed)
{
    $rating = 0;
    $query = "select rating from package_rating where userid='$uid' and postid='$item_name'";
    global $conn;
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $rating = $row['rating'];     //$array[][] is a two-dimensional array
    }
    if (!$zeroAllowed && $rating == 0) {
        return avg_rating($item_name);
    }
    return $rating;
}

function avg_rating($item_name)
{
    $avg_rating = 0;
    $counter = 0;
    $query = "select rating from package_rating where postid='$item_name'";
    global $conn;
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $avg_rating += $row['rating'];
        $counter++;
    }
    if ($counter == 0) {
        $avg_rating = 2.5;
    } else {
        $avg_rating = $avg_rating / $counter;
    }
    return $avg_rating;

}

function get_items()
{
    $items_id = array();
    $query = "select postid from package_rating group by postid";
    global $conn;
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $items_id[] = $row["postid"];
    }
    return $items_id;
}

function get_user_id_from_rating_table()
{
    $items_id = array();
    $query = "select userid from package_rating group by userid";
    global $conn;
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $items_id[] = $row["userid"];
    }
    return $items_id;
}

function similarity($item_x, $item_y)
{
    $second_denominator1 = 0;
    $second_denominator2 = 0;
    $denominator = 0;
    $items_id = get_items();
    $users_id = get_user_id_from_rating_table();
    foreach ($items_id as $key => $item) {
        foreach ($users_id as $k => $id) {
            if (!strcmp($item, $item_x)) {
                $rat = rating($id, $item, false);
                if ($rat != 0) {
                    $second_denominator1 += $rat * $rat;
                }
            }
            if (!strcmp($item, $item_y)) {
                $rat = rating($id, $item, false);
                if ($rat != 0) {
                    $second_denominator2 += $rat * $rat;
                }
            }
        }
    }
    $denominator = sqrt($second_denominator1) * sqrt($second_denominator2);

    $nominator = 0;
    foreach ($users_id as $k => $id) {
        $product_item_rating_each_user = 1;
        //if(strcmp($id,$user_id))
        {
            foreach ($items_id as $key => $item) {
                if (!strcmp($item, $item_x) || !strcmp($item, $item_y)) {
                    $rat = rating($id, $item, false);
                    $product_item_rating_each_user = $product_item_rating_each_user * $rat;
                }
            }
            $nominator += $product_item_rating_each_user;
        }
    }
    return $nominator / $denominator;
}
//echo "<br>";echo "<br>";
//similarity("Item_1", "Item_2");
//similarity("Item_2", "Item_3");
//similarity("Item_1", "Item_3");

function predictMissingRating($user_id, $item_id)
{
    $denominator = 0.0000001;
    $numerator = 0;
    $items_id = get_items();
    $users_id = get_user_id_from_rating_table();
    $temporaryItems = array();
    foreach ($items_id as $key => $item) {
        $temporaryItems[] = $item;
    }

    foreach ($users_id as $k => $id) {
        if ($id == $user_id) {
            $temporarySimilarityPair = 0;
            for ($i = 0; $i < count($temporaryItems); $i++) {


                {
                    if ($i < count($temporaryItems) - 1) {
                        $temporarySimilarityPair = similarity($temporaryItems[$i], $temporaryItems[$i + 1]);
                        //echo $temporaryItems[$i];//echo $temporaryItems[$i + 1];
                        $denominator += $temporarySimilarityPair;
                    }
                    if( strcmp($temporaryItems[$i] , $item_id) )
                    $numerator += rating($id, $temporaryItems[$i], false) * $temporarySimilarityPair;
                }
            }
        }
    }
    //echo "n=".$numerator;echo "<br>"; echo "d=".$denominator; echo "<br><br>";
    return($numerator/$denominator);
}

//echo predictMissingRating(1, "Item_2")."<br>";
//echo predictMissingRating(1, "Item_3")."<br>";
//echo predictMissingRating(1, "Item_1")."<br>";
//echo predictMissingRating(2, "Item_3")."<br>";

function getUntriedItems($user_id){
    $items_id = array();
    $query = "SELECT postid FROM package_rating WHERE postid NOT IN 
   (SELECT postid FROM package_rating WHERE userid='$user_id' GROUP BY postid) GROUP BY postid";
    global $conn;
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $items_id[] = $row["postid"];
    }
    return $items_id;

}
function predictUntrieditems($user_id){
    $untrieditems= getUntriedItems($user_id);

    $predictions=array();

    for($i=0;$i<count($untrieditems);$i++){
        $predictions["_".$untrieditems[$i].""]= predictMissingRating($user_id, $untrieditems[$i] );
    }

    array_multisort($predictions , SORT_DESC);
    //var_dump($predictions);
    echo "<br>";


    return $predictions;
}

function giveTopThreePred($user_id){
    $all= predictUntrieditems($user_id);

    $recom=array();
    $ids=array_keys($all);
   // print_r( array_keys($all) );

    for ($i=0; $i<count($ids)&&$i<4;$i++){
        $recom[]=str_replace('_', '', $ids[$i]);
    }

    var_dump($recom);
   return $recom;

}
//giveTopThreePred("ami@gmail.com");
//predictUntrieditems("2");echo "<br>";
//predictUntrieditems("3");echo "<br>";
//predictUntrieditems("4");echo "<br>";
//echo "<br>";echo "<br>";echo "<br>";

function isRatable($userid,$destinationId)
{
    $query = "select * from packagebookings where userid='$userid' and booking_id='$destinationId'";
    global $conn;
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        return true;
    }
    return false;

}