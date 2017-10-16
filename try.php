<?php
/**
 * @category ${NAME}
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/8/31 11:52
 * @since
 */

try{
    $success[] = 1;
    $error[] = 2;
    throw new Exception();
}catch(Exception $exception){
    $success[] = 2;
}finally{
    echo "err";
    print_r($error);
}

print_r($success);
