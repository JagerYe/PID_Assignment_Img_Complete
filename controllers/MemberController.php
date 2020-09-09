<?php
class MemberController extends Controller
{
    private $_dao;
    public function __construct()
    {
        require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment_Img_Complete/controllers/EmployeeController.php";
        require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment_Img_Complete/models/member/MemberService.php";
        $this->_dao = (new MemberService())->getDAO();
        $this->model("member");
    }

    private function jsonToModel($str)
    {
        $obj = json_decode($str);
        try {
            $member = new Member(
                $obj->_userID,
                $obj->_userName,
                $obj->_userEmail,
                $obj->_userPhone,
                $obj->_userStatus,
                $obj->_userPassword
            );
        } catch (Exception $err) {
            return false;
        }

        return $member;
    }

    public function insertByObj($str)
    {
        $jsonObj = json_decode($str);

        if (!($member = Member::jsonObjToModel($jsonObj))) {
            return false;
        }
        $password = $member->getUserPassword();
        if (!preg_match("/\w{6,30}/", $password)) {
            return false;
        }

        if ($this->_dao->insertMemberByObj($member)) {
            return true;
        }

        return false;
    }

    public function update($str)
    {
        if (!(EmployeeController::getSessionEmpID() || $this->getSessionUserName())) {
            return false;
        }
        $jsonObj = json_decode($str);
        if (!($member = Member::jsonObjToModel($jsonObj))) {
            return false;
        }

        if ($this->_dao->updateMember($member)) {
            return true;
        }
        return false;
    }

    public function getAll()
    {
        if (!(EmployeeController::getSessionEmpID() || $this->getSessionUserName())) {
            return false;
        }
        if ($members = $this->_dao->getAllMember()) {
            return json_encode($members);
        }
        return false;
    }

    public function getOne($id)
    {
        if (!(EmployeeController::getSessionEmpID() || $this->getSessionUserName())) {
            return false;
        }
        if ($member = $this->_dao->getOneMemberByID($id)) {
            $a = json_encode($member);
            return $a;
        }
        return false;
    }

    public function login($id, $password)
    {
        // $request = ;
        if ($this->_dao->doLogin($id, $password)) {
            $member = $this->_dao->getOneMemberByID($id);

            $_SESSION["userID"] = $member->getUserID();
            $_SESSION["userName"] = $member->getUserName();

            return true;
        }
        return false;
    }

    public function getSessionUserName()
    {
        if (isset($_SESSION['userName'])) {
            return $_SESSION['userName'];
        }
        return false;
    }

    public function getSessionUserID()
    {
        if (isset($_SESSION["userID"])) {
            return $_SESSION["userID"];
        }
        return false;
    }

    public function logout()
    {
        unset($_SESSION['userID']);
        unset($_SESSION['userName']);
    }

    public function checkMemberExist($id)
    {
        return ($this->_dao->checkMemberExist($id)) > 0;
    }

    public function checkPassword($password)
    {
        return $this->_dao->doLogin($_SESSION["userID"], $password);
    }
}
