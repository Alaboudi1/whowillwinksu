<?php
require __DIR__ . '/../vendor/autoload.php';
use Auth0\SDK\Auth0;
include 'userOperations.php';

//if the URL has auth, then force the user to login.
// retrieve user information from auth0 object and saved it if the information existed and return it.
// the information only existed if the user loged in.
function auth(){
$auth = $_GET['auth'];
$auth0 = new Auth0(array(
    'domain'        => 'whowillwin.auth0.com',
    'client_id'     => 'KboeNyt4_yis5dVEQ5CSR4VYqEKRh_n5',
    'client_secret' => 'yxWWHrY4-5bAc99EEoioGpnkKOYdrOLM-ChM6kjFLW3wMRXgM3hzKJGyifgvn3hS',
    'redirect_uri'  => 'http://localhost',
    'audience' => 'urn:test:api',
    'persist_id_token' => true,
    'persist_access_token' => true,
    'persist_refresh_token' => true
));
if(isset($_GET['auth'])){
 echo ('<script>lock.show();</script>');
}
$userInfo = $auth0->getUser();
if($userInfo){
    saveUser($userInfo['user_id']);
}
  return $userInfo;
 }

?>