<?php

class Controller
{
    public function model($model)
    {
        require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment_Img_Complete/models/$model/$model.php";
    }
}
