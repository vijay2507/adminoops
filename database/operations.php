<?php

include_once('./database/db.php');

session_start();
class operations extends database
{




    public function __construct()
    {
        $this->connect();
    }

    public function insertData($user_table, $cols, $data, $static)
    {

        $allfield = array_merge($data, $static);

        foreach ($allfield as $key => $val) {
            if (!in_array($key, $cols)) {
                $fieldArr[] = $key;
                $valueArr[] = $val;
            }
        }

        $field = implode(",", $fieldArr);
        $value = implode("','", $valueArr);
        $value = "'" . $value . "'";
        $sql = "insert into $user_table($field) values($value) ";
        $result = $this->connect()->query($sql);
        if ($result) {

            return $result;
        } else {
            echo 'failed' . mysqli_error($this->connect());

            // echo 'failed' . $this->connect()->error;
        }
    }


    //$user_table = table name 
    //$mode = row  | result , row= when need to use single user data , result = when we need full user data 
    //$where = where is a array for get id 

    public function select($user_table, $mode, $where = [], $order_by = null, $limit = null)
    {
        $array = array();
        $arr_length = 0;
        $query = "SELECT * FROM " . $user_table . ' ';

        if (isset($where) && (sizeof($where) > 0)) {
            foreach ($where as $key => $value) {
                if ($arr_length === 0) {
                    $query .= ' WHERE ' . $key . "=" . $value;
                } else if ($arr_length >= 1) {
                    $query .= ' AND ' . $key . "=" . $value;
                }
                $arr_length++;
            }
        }
        // echo '----------------------------' . $query;
        $result = mysqli_query($this->connect(), $query);
        if (mysqli_num_rows($result) > 0) {
            if ($mode == 'row') {
                return $rows = mysqli_fetch_assoc($result);
            }
            if ($mode == 'result') {

                return  $result;
            }
        } else {
            return 0;
        }
    }

    public function delete($user_table, $where_condition)
    {
        $condition = '';
        foreach ($where_condition as $key => $value) {
            $condition .= $key . "=" . $value;
        }
        echo '------------------' .   $query = "DELETE FROM " . $user_table . " WHERE " . $condition . "";
        // echo $query = "UPDATE user_table set name='hellotekkst' where id='11'";
        $result = mysqli_query($this->connect(), $query);
        // echo "affected rows=" . mysqli_affected_rows($this->connect());
        if ($result) {
            return true;
        }
    }











    public function update($user_table, $fields, $where)
    {
        print_r($fields);
        $arr_length = 0;
        $col_length = 0;
        $query = "UPDATE " . $user_table . ' SET ';

        if (isset($fields) && (sizeof($fields) > 0)) {
            foreach ($fields as $key => $value) {
                if ($col_length === 0) {
                    $query .= $key . "=" .  "'" . $value . "'";
                } else if ($col_length >= 1) {
                    $query .= ' , ' . $key . "=" . "'" . $value . "'";
                }
                $col_length++;
            }
        }

        if (isset($where) && (sizeof($where) > 0)) {
            foreach ($where as $key => $value) {
                if ($arr_length === 0) {
                    $query .= ' WHERE ' . $key . "=" . $value;
                } else if ($arr_length >= 1) {
                    $query .= ' AND ' . $key . "=" . $value;
                }
                $arr_length++;
            }
        }


        if (mysqli_query($this->connect(), $query)) {
            return true;
        }
    }



    public function verify($user_table, $data, $field)
    {
        $query = "SELECT * FROM " . $user_table . " WHERE " . $data . " = " . "'$field'";
        $check = mysqli_query($this->connect(), $query);
        $result = mysqli_num_rows($check);
        if ($result == 1) {
            return 1;
        } else {
            return 0;
        }
    }


    function login($user_table, $email, $pass)
    {
        $query = "SELECT * FROM " . $user_table . " WHERE " . " email " . "=" . "'$email'";
        $result = mysqli_query($this->connect(), $query);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $check = mysqli_fetch_assoc($result);

                if (password_verify($pass, $check['password'])) {
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $check['id'];
                    return true;
                } else {
                    return 0;
                }
            } else {
                return 'invalid login credentials';
            }
        } else {
            return mysqli_error($this->connect());
        }
    }
}
$db = new operations();

include_once('./user_session.php');
