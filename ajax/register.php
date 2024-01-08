<?php
error_reporting(0);
session_start();
header('Content-type: application/json; charset=utf-8');

require_once(__DIR__ . '/../include/Config.php');
require_once(__DIR__ . '/../include/PDOQuery.php');

$obj = (object)[];
function CreateJsonResponse() {
    global $obj;
    $obj->timestamp = time();
    die(json_encode($obj, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty(rtrim($_POST['username'])) && !empty(rtrim($_POST['password'])) && !empty(rtrim($_POST['password_confirm'])) && !empty(rtrim($_POST['email']))) {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $pwcn = $_POST['password_confirm'];
        $email = $_POST['email'];
        
        if (!empty($_SESSION['username'])) {
            $obj->status = 'error';
            $obj->info = 'คุณเข้าสู่ระบบอยู่แล้ว!';
            CreateJsonResponse();
        }
        
        if(!preg_match('/^[a-zA-Z0-9_-]+$/', $user)) {
            $obj->status = 'error';
            $obj->info = 'รูปแบบ Username ไม่ถูกต้อง!';
            CreateJsonResponse();
        }else{
            $q = Query('SELECT password FROM clients where username = :user', array(':user'=>$user));
            if ($q->rowCount() == 1) {
                $hash = $q->fetch()[0];
                if(password_verify($pass, $hash)) {
                    $_SESSION['username'] = $user;
                    $obj->status = 'success';
                    $obj->info = 'เข้าสู่ระบบสำเร็จ!';
                    CreateJsonResponse();
                }else{
                    $obj->status = 'error';
                    $obj->info = 'มีชื่อผู้ใช้นี้อยู่ในระบบแล้ว!';
                    CreateJsonResponse();
                }
            }else{
                if ($pass === $pwcn) {
                    $hash = password_hash($pass, PASSWORD_DEFAULT);
                    $q = Query('INSERT INTO clients (username, password, email, ip) VALUES (:user, :pass, :email, :ip)', array(':user'=>$user, ':pass'=>$hash, ':email'=>$email, ':ip'=>$_SERVER['REMOTE_ADDR']));
                    $q = Query('SELECT username FROM clients where username = :user', array(':user'=>$user));
                    if ($q->rowCount() == 0) {
                        $obj->status = 'error';
                        $obj->info = 'เกิดข้อผิดพลาดภายในระบบฐานข้อมูล';
                        CreateJsonResponse();
                    }else{
                        $_SESSION['username'] = $user;
                        $obj->status = 'success';
                        $obj->info = 'สมัครสมาชิกสำเร็จ!';
                        CreateJsonResponse();
                    }
                }else{
                    $obj->status = 'error';
                    $obj->info = 'รหัสผ่านไม่ตรงกัน โปรดตรวจสอบอีกครั้ง';
                    CreateJsonResponse();
                }
            }
        }
    }else{
        $obj->status = 'error';
        $obj->info = 'โปรดกรอกข้อมูลให้ถูกต้องและครบถ้วน!';
        CreateJsonResponse();
    }
}
?>