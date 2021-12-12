<?php

require_once 'BaseModel.php';

class UserModel extends BaseModel {

    public function findUserById($id) {
        if(is_int($id) && $id != null && $id > 0 && !is_object($id)){
             $sql = 'SELECT * FROM users WHERE id = '.$id;
            $user = $this->select($sql);
            return $user;
        }else{
            return false;
        }
       
    }

    public function findUser($keyword) {
        
        $sql = 'SELECT * FROM users WHERE user_name LIKE %'.$keyword.'%'. ' OR user_email LIKE %'.$keyword.'%';
        $user = $this->select($sql);

        return $user;
    }

    /**
     * Authentication user
     * @param $userName
     * @param $password
     * @return array
     */
    public function auth($userName, $password) {
        $md5Password = md5($password);
        $sql = 'SELECT * FROM users WHERE name = "' . $userName . '" AND password = "'.$md5Password.'"';

        $user = $this->select($sql);
        return $user;
    }

    /**
     * Delete user by id
     * @param $id
     * @return mixed
     */
    public function deleteUserById($id) {
        if(!is_null($id) && $id > 0 &&
            !is_array($id) && !is_bool($id) && !is_string($id)){
            $sql = 'DELETE FROM users WHERE id = '.$id;
            return $this->delete($sql);
        }else{
            return false;
        }

    }


    /**
     * Update user
     * @param $input
     * @return mixed
     */
    public function updateUser($input) {
        $sql = 'UPDATE users SET 
                 name = "' . mysqli_real_escape_string(self::$_connection, $input['name']) .'", 
                 password="'. md5($input['password']) .'"
                WHERE id = ' . $input['id'];

        $user = $this->update($sql);

        return $user;
    }

    /**
     * Insert user
     * @param $input
     * @return mixed
     */
    public function insertUser($input) {
        if(!is_null($input["name"]) &&
        !is_int($input["name"]) &&
        !is_bool($input["name"]) &&
        !is_array($input["name"]) &&
        !is_object($input["name"])){       
            $sql = "INSERT INTO `app_web1`.`users` (`name`, `fullname`, `email`, `type`, `password`) VALUES (" .
                    "'" . $input['name'] . "', '".$input['fullname']."', '".$input['email']."', '".$input['type']."', '".$input['password']."')";

            $user = $this->insert($sql);

            return $user;
        }else{
            return false;
        }
    }

    /**
     * Search users
     * @param array $params
     * @return array
     */
    public function getUsers($params = []) {
        //Keyword
        if (!empty($params['keyword'])) {
            $sql = 'SELECT * FROM users WHERE name LIKE "%' . $params['keyword'] .'%"';

            //Keep this line to use Sql Injection
            //Don't change
            //Example keyword: abcef%";TRUNCATE banks;##
            $users = self::$_connection->multi_query($sql);
        } else {
            $sql = 'SELECT * FROM users';
            $users = $this->select($sql);
        }

        return $users;
    }

   

    public function sumb($a, $b)
    {
        return $a + $b;
    }
}