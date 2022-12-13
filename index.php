<?php 
    header("Content-Type:application/json");
    require_once 'connect.php'; 
    require_once 'function_get.php';
    require_once 'function_responce.php';

    $actionMethod = $_SERVER['REQUEST_METHOD'];
    
    $paramUrl = explode("/", $_GET['q']);
    $typeUrl = $paramUrl[0];
    $typeId = $paramUrl[1];
    $property = $paramUrl[2];
            //GET
    switch ($actionMethod) {
        case 'GET':
            // test-api.easy4.ru/users
                switch ($typeUrl) {
                    case 'users':
                        viewallusers($connect);
                       break;
                    case 'cruise': 
                        viewallcruise($connect);
                        break;
                    case 'portmalo': 
                        viewcruisemalo($connect);
                        break;
                    case 'money': 
                        verymoney($connect);
                        break;
                    case 'date':
                        viewalldate($connect);
                       break;
                    case 'port':
                        GetPortInfo($connect);
                       break;
                    case 'few':
                        GetCruiseInfo($connect);
                       break;
                    case 'shipVery':
                        GetParkingInfo($connect, $typeId);
                       break;
                    case 'user':
                        GetUserInfo($connect, $typeId);
                        break;
                    }
                    break;
        case 'POST':
                switch($typeUrl){
                    case 'create-user':
                        // var_dump($_POST);
                        $dataUser = file_get_contents('php://input');
                        $dataUser = json_decode($dataUser, true);
                        // var_dump($dataUser); 
                        #КОНЕЦ
                        addUser($connect, $dataUser);
                        break;

                        case 'create-ship':
                            // var_dump($_POST);
                            $dataUser = file_get_contents('php://input');
                            $dataUser = json_decode($dataUser, true);
                            // var_dump($dataUser); 
                            #КОНЕЦ
                            addShip($connect, $dataUser);
                            break;

                        case 'create-cruise':
                                // var_dump($_POST);
                            $dataUser = file_get_contents('php://input');
                            $dataUser = json_decode($dataUser, true);
                                // var_dump($dataUser); 
                                #КОНЕЦ
                            addCruise($connect, $dataUser);
                            break;
                            case 'create-parking':
                                // var_dump($_POST);
                            $dataUser = file_get_contents('php://input');
                            $dataUser = json_decode($dataUser, true);
                                // var_dump($dataUser); 
                                #КОНЕЦ
                            addParking($connect, $dataUser);
                            break;
                        default:
                            http_response_code(418);
                            echo "Данные не были отправлены.";
                            break;
                }
        break;
        default:
        
            break;
    
}
?>