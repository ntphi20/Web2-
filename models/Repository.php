<?php
require_once "UserModel.php";
require_once "BankModel.php";
class Repository {
  public function createUser($user){
    $userModel = new UserModel();
    $bankModel = new BankModel();

    $userModel->insertUser($user);//tạo mới user
    $id = $userModel->getID()[0]['id'];//lấy id vừa mới tạo
    $bank = array(
        'user_id' => $id,
        'cost' => 500//tặng 500 vào user vừa tạo
    );
    $bankModel->insertBank($bank);
}
    /*
        Xóa user và bank tương ứng
    */
  //   public function deleteUser($id){
  //     $userModel = new UserModel();
  //     $bankModel = new BankModel();

  //     $userModel->deleteUserById($id);
  //     $bankModel->deleteBankByUserId($id);
  // }
}