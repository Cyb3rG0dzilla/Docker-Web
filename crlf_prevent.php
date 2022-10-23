<?php
$cr = '/\%0d/';
$lf = '/\%0a/';

$response = // whatever your response is generated in;
$cr_check = preg_match($cr , $response);
$lf_check = preg_match($lf , $response);

if (($cr_check > 0) || ($lf_check > 0)){
    throw new \Exception('CRLF detected');
}
