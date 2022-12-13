<?php 
    require_once "function_responce.php";

    ///Добавление нового пользователя

    function addUser($connect, $dataUser){
        $getRole = $dataUser['roleName'];
        $getLogin = $dataUser['login'];
        $getPassword = $dataUser['password'];

        $row = mysqli_query($connect, "SELECT * FROM `role` WHERE `name`='$getRole'");
        
        $sameLogin = mysqli_query($connect, "SELECT * FROM `user` WHERE login='$getLogin'");
         
        $formatRow = mysqli_fetch_assoc($row);
        $formatRowLogin = mysqli_fetch_assoc($sameLogin);

        if($formatRowLogin == 0){
            if(strlen($getPassword) < 6) echo "Не могу добавить! Не допустимая длина пароля!";
            else mysqli_query($connect, "INSERT INTO `user`(`id`, `login`, `password`, `role_id`) VALUES (NULL,'".$dataUser['login']."','".$dataUser['password']."',".$formatRow['id'].")");
        }
        else{
            http_response_code(418);
            $responce = [
                "status" => false,
                "description" => "Пользователь с таким логином существует."
            ];

            echo json_encode($responce);
        }
    }


    ///Добавление нового судна
    
    function addShip($connect, $dataUser){
        $getShip = $dataUser['nameShip'];
        $getType = $dataUser['typeShip'];
        $getCount = $dataUser['countPlace'];
        
        mysqli_query($connect, "SELECT * FROM `ship` WHERE nameShip='$getShip', typeShip='$getType', countPlace='$getCount'");
        mysqli_query($connect, "INSERT INTO `ship`(`id`, `nameShip`, `TypeShip`, `countPlace`) VALUES (NULL,'".$dataUser['nameShip']."','".$dataUser['typeShip']."', '".$dataUser['countPlace']."')");
    }
    
    function addParking($connect, $dataUser){
        $getPort = $dataUser['Port'];
        $getArrival = $dataUser['ArrivalTime'];
        $getParking = $dataUser['ParkingTime'];
        
        mysqli_query($connect, "SELECT * FROM `parking` WHERE port='$getPort', arrivalTime='$getArrival', parkingTime='$getParking'");
        mysqli_query($connect, "INSERT INTO `parking`(`id`, `port`, `arrivalTime`, `parkingTime`) VALUES (NULL,'".$dataUser['port']."','".$dataUser['arrivalTime']."', '".$dataUser['parkingTime']."')");
    }   

    function addCruise($connect, $dataUser){
        ///Данные для порта
        $getPort = $dataUser['Port'];
        $getArrival = $dataUser['ArrivalTime'];
        $getParking = $dataUser['ParkingTime'];        
        $parking = mysqli_query($connect, "SELECT * FROM `parking` WHERE port='$getPort', arrivalTime='$getArrival', parkingTime='$getParking'");

        ///Данные для корабля
        $getShip = $dataUser['nameShip'];
        $getType = $dataUser['typeShip'];
        $getCount = $dataUser['countPlace'];
        $ship = mysqli_query($connect, "SELECT * FROM `ship` WHERE nameShip='$getShip', typeShip='$getType', countPlace='$getCount'");
        ///Данные для Круиза
        $getName = $dataUser['Name'];
        $getDate = $dataUser['Date'];
        $getShip = $dataUser['Ship'];
        $getPark = $dataUser['Parking'];
        $getSailing = $dataUser['SailingTime'];
        $getPrice = $dataUser['Price'];
        $getOccupied = $dataUser['Occupied'];
        $formatShip = mysqli_fetch_assoc($ship);
        $formatParking=mysqli_fetch_assoc($parking);
        mysqli_query($connect, "SELECT * FROM `cruise` WHERE name='$getName', date='$getDate', ship_id='$getShip', parking_id='$getPark', sailingTime='$getSailing', price='$getPrice', occupiedSeats='$getOccupied'");
        
        mysqli_query($connect, "INSERT INTO `cruise`(`id`, `name`, `date`, `ship_id`,`parking_id`,`sailingTime`,`price`,`occupiedSeats`) VALUES (NULL,'".$dataUser['Name']."','".$dataUser['Date']."', '".$dataUser['Ship']."','".$dataUser['Parking']."','".$dataUser['SailingTime']."','".$dataUser['Price']."','".$dataUser['Occupied']."')");
 }
?>