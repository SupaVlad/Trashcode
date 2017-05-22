<?php
include ('components/Db.php');

$pdb = Db::getConnection();

$manufacturer = $_POST['manufacturer'];
$sort_price = $_POST['sort'];
$min_price = $_POST['min_price'];
$max_price = $_POST['max_price'];

$products = [];
if($manufacturer == 'All'){
    $query = "SELECT * FROM `product` WHERE `price` BETWEEN {$min_price} AND {$max_price} ORDER BY `price` {$sort_price}";
    //var_dump($query);
    $prods = $pdb->query($query);
    //var_dump($prods);
}else{
    $prods = $pdb->query("SELECT * FROM `product` WHERE `brand`='{$manufacturer}' AND `price` BETWEEN {$min_price} AND {$max_price} ORDER BY `price` {$sort_price}");
}


while($row = $prods->fetch(PDO::FETCH_ASSOC)) {
    $products[] = $row;
}
echo json_encode($products);