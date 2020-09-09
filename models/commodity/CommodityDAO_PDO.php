<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment_Img_Complete/models/commodity/CommodityDAO_Interface.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment_Img_Complete/models/config.php";
class CommodityDAO_PDO implements CommodityDAO
{

    private $_strInsert = "INSERT INTO `commoditys`(`commodityName`, `commodityPrice`, `commodityQuantity`, `commodityStatus`, `commodityText`) VALUES (:commodityName,:commodityPrice,:commodityQuantity,:commodityStatus,:commodityText);";
    private $_strUpdate = "UPDATE `Commoditys` SET `commodityName`=:commodityName,`commodityPrice`=:commodityPrice,`commodityQuantity`=:commodityQuantity,`commodityStatus`=:commodityStatus,`commodityText`=:commodityText WHERE `commodityID`=:commodityID;";
    private $_strDelete = "DELETE FROM `commoditys` WHERE `commodityID`=:commodityID;";
    private $_strCheckCommodityExist = "SELECT COUNT(*) FROM `commoditys` WHERE `commodityID`=:commodityID;";
    private $_strGetAll = "SELECT `commodityID`, `commodityName`, `commodityPrice`, `commodityQuantity`, `commodityStatus`, `commodityText` FROM `commoditys`;";
    private $_strGetOne = "SELECT `commodityID`, `commodityName`, `commodityPrice`, `commodityQuantity`, `commodityStatus`, `commodityText` FROM `commoditys` WHERE `commodityID`=:commodityID;";
    private $_strCheckAndTotal = "SELECT COUNT(*), SUM(`commodityPrice`*:commodityQuantity) FROM `Commoditys` WHERE `commodityID`=:commodityID AND `commodityPrice`>0 AND `commodityStatus`='open' AND `commodityQuantity`>=:commodityQuantity;";
    //BLOB之後測試
    private $_strGetImg = "SELECT `commodityImage` FROM `commoditys` WHERE `commodityID`=:commodityID;";
    private $_strUpdateImg = "UPDATE `commoditys` SET `commodityImage`=LOAD_FILE(:commodityImage) WHERE `commodityID`=:commodityID";

    public function updateCommodityImg($id, $img)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strUpdateImg);
            $sth->bindParam("commodityImage", $img, PDO::PARAM_LOB);
            $sth->bindParam("commodityID", $id);
            $sth->execute();
            $dbh->commit();
            $sth = null;
        } catch (Exception $err) {
            $dbh->rollBack();
            $dbh = null;
            return false;
        }
        $dbh = null;
        return true;
    }

    public function getOneCommodityImgByID($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->prepare($this->_strGetImg);
            $sth->bindParam("commodityID", $id);
            $sth->execute();
            $sth->bindColumn(1, $commodityImage, PDO::PARAM_LOB);
            $sth->fetch(PDO::FETCH_BOUND);
            $sth = null;
        } catch (PDOException $err) {
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $commodityImage;
    }

    //新增會員
    public function insertCommodity($name, $price, $quantity, $status, $text)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strInsert);
            $sth->bindParam("commodityName", $name);
            $sth->bindParam("commodityPrice", $price);
            $sth->bindParam("commodityQuantity", $quantity);
            $sth->bindParam("commodityStatus", $status);
            $sth->bindParam("commodityText", $text);
            $sth->execute();
            $id = $dbh->lastInsertId();
            $dbh->commit();
            $sth = null;
        } catch (PDOException $err) {
            $dbh->rollBack();
            return false;
        }
        $dbh = null;
        return $id;
    }

    //新增會員 用物件
    public function insertCommodityByObj($commodity)
    {
        return $this->insertCommodity(
            $commodity->getCommodityName(),
            $commodity->getCommodityPrice(),
            $commodity->getCommodityQuantity(),
            $commodity->getCommodityStatus(),
            $commodity->getCommodityText()
        );
    }

    //更新會員
    public function updateCommodity($commodity)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strUpdate);
            $sth->bindParam("commodityName", $commodity->getCommodityName());
            $sth->bindParam("commodityPrice", $commodity->getCommodityPrice());
            $sth->bindParam("commodityQuantity", $commodity->getCommodityQuantity());
            $sth->bindParam("commodityStatus", $commodity->getCommodityStatus());
            $sth->bindParam("commodityText", $commodity->getCommodityText());
            $sth->bindParam("commodityID", $commodity->getCommodityID());
            $sth->execute();
            $dbh->commit();
            $sth = null;
        } catch (PDOException $err) {
            $dbh->rollBack();
            return false;
        }
        $dbh = null;
        return true;
    }

    //之後需增加檢查是否有訂單
    public function deleteCommodityByID($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strCheckCommodityExist);
            $sth->bindParam("commodityID", $id);
            $sth->execute();
            $request = $sth->fetch(PDO::FETCH_NUM);
            if ($request['0'] <= 0) {
                throw new Exception("找不到");
            }
            $sth = $dbh->prepare($this->_strDelete);
            $sth->bindParam("commodityID", $id);
            $sth->execute();
            $dbh->commit();
            $sth = null;
        } catch (Exception $err) {
            $dbh->rollBack();
            return false;
        }
        $dbh = null;
        return true;
    }

    public function getAllCommoditys()
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->query($this->_strGetAll);
            $request = $sth->fetchAll(PDO::FETCH_ASSOC);
            foreach ($request as $item) {
                $commoditys[] = new Commodity(
                    $item['commodityID'],
                    $item['commodityName'],
                    $item['commodityPrice'],
                    $item['commodityQuantity'],
                    $item['commodityStatus'],
                    $item['commodityText']
                );
            }
            $sth = null;
        } catch (PDOException $err) {
            $dbh->rollBack();
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $commoditys;
    }
    public function getOneCommodityByID($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->prepare($this->_strGetOne);
            $sth->bindParam("commodityID", $id);
            $sth->execute();
            $request = $sth->fetch(PDO::FETCH_ASSOC);

            $commoditys = new Commodity(
                $request['commodityID'],
                $request['commodityName'],
                $request['commodityPrice'],
                $request['commodityQuantity'],
                $request['commodityStatus'],
                $request['commodityText']
            );

            $sth = null;
        } catch (PDOException $err) {
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $commoditys;
    }

    public function getCheckAndTotal($id, $quantity)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->prepare($this->_strCheckAndTotal);
            $sth->bindParam("commodityID", $id);
            $sth->bindParam("commodityQuantity", $quantity);
            $sth->execute();
            $request = $sth->fetch(PDO::FETCH_NUM);
            $sth = null;
        } catch (PDOException $err) {
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $request;
    }
}
