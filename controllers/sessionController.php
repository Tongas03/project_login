<?php

class sessionController {

    public static function init(){

        session_start();
    }

    public static function createToken(){

        $_SESSION['token'] = bin2hex(random_bytes(32));

        $_SESSION['token_expire'] = time() + 300;

    }

    public function verifyToken($token) {

        if ($_SESSION['token'] === $token) {

            if (time() >= $_SESSION['token_expire']) {

                $response = [
                    'response' => false,
                    'data' => 'Tiempo expirado, se recargará la página'
                ];

                return $response;
            }

            $response = [
                'response' => true,
                'data' => 'Redireccionando'
            ];
            
            return $response;

        } else {

            $response = [
                'response' => false,
                'data' => 'Token invalido, recargue la página'
            ];

            return $response;
        }
    }

    public static function finish() {
        
        session_start();
        
        unset($_SESSION['token']);

        unset($_SESSION['token_verify']);

        session_destroy();

        header('Location: /login/index');

    }
}