<?php
require_once '../jwt/JWT.php';
require_once '../modelos-datos/authModel.php';
require_once '../respuestas/response.php';
use Firebase\JWT\JWT;

class Authentication extends AuthModel
{
    private $key = 'clave_secreta_muy_discreta';
    private $idUser = '';

    public function signIn($user)
    {
        if (!isset($user['email']) || !isset($user['password']) || empty($user['email']) || empty($user['password'])) {
            $response = [
                'result' => 'error',
                'details' => 'Los campos password y email son obligatorios'
            ];
            Response::result(400, $response);
            exit;
        }

        $result = parent::login($user['email'], hash('sha256', $user['password']));

        if (sizeof($result) == 0 || $result[0]['disponible'] != 1) {
            $response = [
                'result' => 'error',
                'details' => 'El usuario esta dasactivado :('
            ];
            Response::result(403, $response);
            exit;
        }

        $dataToken = [
            'iat' => time(),
            'data' => [
                'id' => $result[0]['id'],
                'email' => $result[0]['email']
            ]
        ];

        $jwt = JWT::encode($dataToken, $this->key);

        parent::update($result[0]['id'], $jwt);

        return $jwt;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function verify()
    {
        if (!isset($_SERVER['HTTP_API_KEY'])) {
            $response = [
                'result' => 'error',
                'details' => 'Usted no tiene los permisos para esta solicitud'
            ];
            Response::result(403, $response);
            exit;
        }

        $jwt = $_SERVER['HTTP_API_KEY'];

        try {
            $data = JWT::decode($jwt, $this->key, ['HS256']);
            $this->idUser = $data->data->id;
            $user = parent::getById($this->idUser);

            if ($user[0]['token'] != $jwt) {
                throw new Exception();
            }
        } catch (\Throwable $th) {
            $response = [
                'result' => 'error',
                'details' => 'No tiene los permisos para esta solicitud'
            ];
            Response::result(403, $response);
            exit;
        }
    }

    public function modifyToken($id, $email)
    {
        $dataToken = [
            'iat' => time(),
            'data' => [
                'id' => $id,
                'email' => $email
            ]
        ];

        $jwt = JWT::encode($dataToken, $this->key);
        parent::update($id, $jwt);

        return $jwt;
    }

    public function insertarLog($milog)
    {
        parent::insertarLog($milog);
    }
}
