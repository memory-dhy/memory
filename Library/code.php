<?php
 include "code.class.php";
 session_start();
 $code = new ValidateCode();
 $code->doimg();
 $_SESSION['code'] = $code->getCode();
?>