<?php
header('Content-Type: application/json');
$result = [];
if(!empty($_POST['productName']) && !empty($_POST['quantityInStock']) && !empty($_POST['price']) && !empty($_POST['dateTime']))
{
    $file = 'product.json';

    if(file_exists($file))
    {
        $current_data = file_get_contents($file);
        $array_data = json_decode($current_data, true);
        $productArray = [
            "productName"           => $_POST['productName'],
            "quantityInStock"       => $_POST['quantityInStock'],
            "price"                 => $_POST['price']."$",
            "dateTime"              => $_POST['dateTime'],
            "TotalValueNumber"    => $_POST['price'] * $_POST['quantityInStock']."$",

        ];

        $array_data[] = $productArray;
        foreach ($array_data as $key => $row)
        {
            $date[$key]  = $row['dateTime'];
        }
        array_multisort($date, SORT_DESC, $array_data);
        $final_data = json_encode($array_data);
        if(file_put_contents($file, $final_data))
        {
            $result['code'] = 200;
            $result['data'] = json_decode(file_get_contents($file), true);
        }
    }else
    {
        $result['code'] = 500;
    }
}
echo json_encode($result);
