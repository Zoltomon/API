<?php 
    require_once "function_responce.php";
    
    /// Вывести всех пользователей

    function viewallusers($connect){
        $users = mysqli_query($connect, "SELECT `user`.`login` AS login, `user`.`password` AS `password`, `role`.`name` AS roleName FROM `user` INNER JOIN `role` ON `user`.`role_id` = `role`.`id`");
        if(mysqli_num_rows($users) == 0){
            http_response_code(404);
            $responce = [
                "status" => false,
                "description" => "Таблица пуста."
            ];

            echo json_encode($responce);
        }
        else{
            
            $userList = array();
            while($user = mysqli_fetch_assoc($users)){
                $userList[] = $user;
            }

            echo json_encode($userList);
        }
    }

    ///Вывод всех круизов

    function viewallcruise($connect){
        $cruise = mysqli_query($connect, "SELECT * FROM `cruise`");
        if(mysqli_num_rows($cruise) == 0){
            http_response_code(404);
            $responce = [
                "status" => false,
                "description" => "Таблица пуста."
            ];

            echo json_encode($responce);
        }
        else{
            
            $userList = array();
            while($user = mysqli_fetch_assoc($cruise)){
                $userList[] = $user;
            }

            echo json_encode($userList);
        }
    }

    ///Вывод самого незагруженного рейса

    function viewcruisemalo($connect){
        $portmalo = mysqli_query($connect, "SELECT MIN(occupiedSeats) As Min, name AS Name FROM `cruise`");
        if(mysqli_num_rows($portmalo) == 0){
            http_response_code(404);
            $responce = [
                "status" => false,
                "description" => "Таблица пуста."
            ];

            echo json_encode($responce);
        }
        else{
            
            $userList = array();
            while($user = mysqli_fetch_assoc($portmalo)){
                $userList[] = $user;
            }

            echo json_encode($userList);
        }
    }

    ///Вывод круизов по датам

    function viewalldate($connect){
        $date = mysqli_query($connect, "SELECT date, name FROM `cruise` ORDER BY date ASC");
        if(mysqli_num_rows($date) == 0){
            http_response_code(404);
            $responce = [
                "status" => false,
                "description" => "Таблица пуста."
            ];

            echo json_encode($responce);
        }
        else{
            
            $userList = array();
            while($user = mysqli_fetch_assoc($date)){
                $userList[] = $user;
            }

            echo json_encode($userList);
        }
    }

    ///Вывод рейса с максимальным количеством судов

    function viewship($connect){
        $ship = mysqli_query($connect, "SELECT nam FROM `cruise` ORDER BY date ASC");
        if(mysqli_num_rows($ship) == 0){
            http_response_code(404);
            $responce = [
                "status" => false,
                "description" => "Таблица пуста."
            ];

            echo json_encode($responce);
        }
        else{
            
            $userList = array();
            while($user = mysqli_fetch_assoc($ship)){
                $userList[] = $user;
            }

            echo json_encode($userList);
        }
    }

    

    ///Самая длительная стоянка у порта

    function GetPortInfo($connect){
        $port = mysqli_query($connect, "SELECT
        `port` AS `Port`,
        MAX(`parkingTime`) AS `PortTime`
    FROM `parking`");
        // var_dump($port);
        if(mysqli_num_rows($port) == 0){
            http_response_code(404);
            $responce = [
                "status" => false,
                "description" => "Таблица c пользователями пуста или отсутствует."
            ];

            echo json_encode($responce);
        }
        else
        {
            $userList = array();
            while($rowUser = mysqli_fetch_assoc($port)){
                $userList[] = $rowUser;
            }

            echo json_encode($userList);    
        }
    }

    ///Вывод юзера по id

    function GetUserInfo($connect, $id){
        $user = mysqli_query($connect, "SELECT
        `user`.`id` AS `IdUser`,
        `user`.`login` AS `LoginUser`,
        `role`.`name` AS `RoleUser`
    FROM
        `user`
    INNER JOIN `role`
    ON `user`.`role_id` = `role`.`id`
    WHERE `user`.`id`=$id");
         //var_dump($user);
        if(mysqli_num_rows($user) == 0){
            http_response_code(404);
            $responce = [
                "status" => false,
                "description" => "Таблица c пользователями пуста или отсутствует."
            ];

            echo json_encode($responce);
        }
        else
        {
            $userList = array();
            while($rowUser = mysqli_fetch_assoc($user)){
                $userList[] = $rowUser;
            }

            echo json_encode($userList);    
        }            
    }

    ///Вывод самого дорогого билета

    function verymoney($connect){
        $money = mysqli_query($connect, "SELECT
        `name` AS `Name`,
        MAX(`price`) AS `Price`
    FROM `cruise`");
        // var_dump($port);
        if(mysqli_num_rows($money) == 0){
            http_response_code(404);
            $responce = [
                "status" => false,
                "description" => "Таблица c пользователями пуста или отсутствует."
            ];

            echo json_encode($responce);
        }
        else
        {
            $userList = array();
            while($rowUser = mysqli_fetch_assoc($money)){
                $userList[] = $rowUser;
            }

            echo json_encode($userList);    
        }
    }

    ///Вывод самого не загруженного рейса

    function GetCruiseInfo($connect){
        $few = mysqli_query($connect, "SELECT
        date As Date,
        MIN(occupiedSeats) As SeatsFew,
        name As Name
    FROM `cruise`");
        // var_dump($few);
        if(mysqli_num_rows($few) == 0){
            http_response_code(404);
            $responce = [
                "status" => false,
                "description" => "Таблица c пользователями пуста или отсутствует."
            ];

            echo json_encode($responce);
        }
        else
        {
            $userList = array();
            while($rowUser = mysqli_fetch_assoc($few)){
                $userList[] = $rowUser;
            }

            echo json_encode($userList);    
        }
    }

    ///Вывод рейса с посещаемыми портами и времени стоянки
    
    function GetParkingInfo($connect, $id){
        $shipVery = mysqli_query($connect, "SELECT `cruise`.`name` As Polska, `parking`.`port` As Port, `parking`.`parkingTime` As TimeParking FROM `cruise` INNER JOIN `parking` ON `cruise`.`parking_id` = `parking`.`id` WHERE `cruise`.`id`=$id");
         //var_dump($shipVery);
        if(mysqli_num_rows($shipVery) == 0){
            http_response_code(404);
            $responce = [
                "status" => false,
                "description" => "Таблица c пользователями пуста или отсутствует."
            ];

            echo json_encode($responce);
        }
        else
        {
            $userList = array();
            while($rowUser = mysqli_fetch_assoc($shipVery)){
                $userList[] = $rowUser;
            }

            echo json_encode($userList);    
        }            
    }
  
