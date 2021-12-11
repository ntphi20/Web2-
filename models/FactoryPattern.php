<?php
require_once 'UserModel.php';
require_once 'BankModel.php';
//require_once 'Repository.php';
class FactoryPattern {

    public function make($model) {
        if ($model == 'user') {
            return new UserModel();
        } else if ($model == 'bank') {
            return new BankModel();
        }else if($model == 'repository'){
            return new Repository();
        }
    }

}