<?php

http_response_code(404);
header('HTTP/1.1 404 Not Found');
header('Content-Type: application/json; charset=UTF-8');
echo json_encode(['success'=>false, 'code'=>404, 'data'=>'Not Found']);

?>