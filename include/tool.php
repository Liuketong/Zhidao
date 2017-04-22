<?php
//Javascript弹窗提示返回
function alert($info){
    echo "<script>alert('$info');history.back();</script>";
    exit();
}

//Javascript弹窗提示跳转
function location($info,$url){
    echo "<script>alert('$info');location.href='$url'</script>";
    exit();
}
