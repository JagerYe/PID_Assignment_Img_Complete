<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment_Img_Complete/models/employee/Employee.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment_Img_Complete/models/employee/EmployeeService.php";
$dao = (new EmployeeService())->getDao();
$dao->insertEmployee("emp2", "123456");
