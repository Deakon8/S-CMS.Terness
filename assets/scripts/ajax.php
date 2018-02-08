<?php
if (isset($_POST['name'])) {
    $link = mysqli_connect(
        'localhost',
        'alexpafs_ucp',
        'Deakonlight123',
        'alexpafs_ucp');
 
    if (!$link) {
        printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
        exit;
    }
 
    $newValue = $_POST['value']; 
	$column = $_POST['name'];	
    $id = $_POST['pk'];
	
    $sql = " UPDATE `products` SET $column = '$newValue' WHERE pID = $id ";
    mysqli_query($link, $sql);
}
?>