<?php
require_once('headers.php');
require_once('functions.php');

$input = json_decode(file_get_contents('php://input'));

$uri = parse_url(filter_input(INPUT_SERVER, 'PATH_INFO'),PHP_URL_PATH);

$parameters = explode('/', $uri);
$role = $parameters[1];
try {
    $db = openDB();
    
    $sql = "SELECT DISTINCT role_, name_ FROM had_role INNER JOIN names_   
    ON had_role.name_id = names_.name_id
    WHERE name_ LIKE '%$role%'
    LIMIT 10";
    selectAsJson($db, $sql);
   
}
catch (PDOException $pdoex) {
    returnError($pdoex);
}
