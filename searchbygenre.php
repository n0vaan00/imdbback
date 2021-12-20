<?php
require_once('headers.php');
require_once('functions.php');

$input = json_decode(file_get_contents('php://input'));

$uri = parse_url(filter_input(INPUT_SERVER, 'PATH_INFO'),PHP_URL_PATH);

$parameters = explode('/', $uri);
$genre = $parameters[1];
try {
    $db = openDB();
    
    $sql = "SELECT DISTINCT primary_title, genre FROM title_genres INNER JOIN titles   
    ON title_genres.title_id = titles.title_id 
    WHERE genre LIKE '%$genre%'
    LIMIT 10";
    selectAsJson($db, $sql);
   
}
catch (PDOException $pdoex) {
    returnError($pdoex);
}
