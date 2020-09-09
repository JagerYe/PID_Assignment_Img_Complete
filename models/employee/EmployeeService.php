<?php

require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment_Img_Complete/models/employee/EmployeeDAO_PDO.php";
class EmployeeService
{
    private $_dao;
    function __construct()
    {
        $this->_dao = new EmployeeDAO_PDO();
    }
    public function getDAO()
    {
        return $this->_dao;
    }
}
