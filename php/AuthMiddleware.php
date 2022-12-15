<?php
require __DIR__ . '/classes/JwtHandler.php';

class Auth extends JwtHandler
{
    protected $DB;
    protected $headers;
    protected $token;

    public function __construct($DB, $headers)
    {
        parent::__construct();
        $this->DB = $DB;
        $this->headers = $headers;
    }

    public function isValid()
    {

        if (array_key_exists('Authorization', $this->headers) && preg_match('/Bearer\s(\S+)/', $this->headers['Authorization'], $matches)) {

            $data = $this->jwtDecodeData($matches[1]);

            if (
                isset($data['data']->user_id)
            ) :
                return [
                    "success" => 1,
                    "user" => $data['data']->user_id
                ];
            else :
                return [
                    "success" => 0,
                    "message" => $data['message'],
                ];
            endif;
        } else {
            return [
                "success" => 0,
                "message" => "Token not found in request"
            ];
        }
    }

    protected function fetchUser($user_id)
    {
        $data = $DB->fetchAll(
            "SELECT * FROM `user` where user_id='".$user_id."' "
          );
         
          foreach ($data as $row) { 
        
           
          // create array
            $product_arr = array(
                "user_id" =>  $row['user_id'],
                "fullname" => $row['fullname'],
                "email" => $row['email']
         
            );
          }

                return $product_arr;
           
    }
}