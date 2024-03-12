<?php
require_once '../jwt/JWT.php';
require_once '../modelos-datos/authModel.php';
require_once '../respuestas/response.php';
use Firebase\JWT\JWT;

class AdminAuthentication extends AuthModel
{
    private $key = 'clave_secreta_muy_discreta';

    public function signInAdmin($user)
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

        if (sizeof($result) == 0 || $result[0]['disponible'] != 2) {
            $response = [
                'result' => 'error',
                'details' => 'Credenciales inválidas o no tienes permisos de administrador'
            ];
            Response::result(403, $response);
            exit;
        }

        $dataToken = [
            'iat' => time(),
            'data' => [
                'id' => $result[0]['id'],
                'email' => $result[0]['email'],
                'role' => 'admin'
            ]
        ];

        $jwt = JWT::encode($dataToken, $this->key);

        parent::update($result[0]['id'], $jwt);

        return $jwt;
    }
}

$auth = new AdminAuthentication();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $user = json_decode(file_get_contents('php://input'), true);

        $token = $auth->signInAdmin($user);

        $response = array(
            'result' => 'ok',
            'token' => $token
        );

        Response::result(200, $response);
        break;

    default:
        $response = array(
            'result' => 'error',
            'details' => 'Método no permitido'
        );
        Response::result(405, $response);
        break;
}
?>
