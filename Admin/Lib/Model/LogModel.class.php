<?php

class LogModel extends Model {

    function addlog($con){
        $data = array(
                "a_id" => $_SESSION[C('USER_AUTH_KEY')],
                "l_content" => "管理员[" . $_SESSION['username'] . "]于[" . date("Y-m-d H:i:s") . "]".$con."--后台管理系统！"
            );
        $this->add($data);
    }

}

?>
