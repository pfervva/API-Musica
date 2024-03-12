<?php

/**
 * Modelo para la autenticación.
 */
class AuthModel
{
    private $connection;
    
    public function __construct()
    {
        $this->connection = new mysqli('db', 'root', 'santi', 'cancionesDb', '3306');

        if ($this->connection->connect_errno) {
            echo 'Error de conexión a la base de datos';
            exit;
        }
    }

    /**
     * Este método, recibe el email y el password ya codificado.
     * Realiza una query, devolviendo el id, nombre, email y el campo disponible
     * a partir del email y de la password codificada.
     */
    public function login($email, $password)
    {
        $query = "SELECT id, nombre, email, disponible FROM usuarios WHERE email = ? AND password = ?";

        if ($stmt = $this->connection->prepare($query)) {
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $results = $stmt->get_result();

            $resultArray = [];
            while ($row = $results->fetch_assoc()) {
                $resultArray[] = $row;
            }
            $stmt->close();

            return $resultArray;
        } else {
            return [];
        }
    }

    /**
     * Actualiza el token a partir del id. Cada logeo, tenemos que actualizar el registro.
     */
    public function update($id, $token)
    {
        $query = "UPDATE usuarios SET token = ? WHERE id = ?";
        if ($stmt = $this->connection->prepare($query)) {
            $stmt->bind_param("si", $token, $id);
            $stmt->execute();
            $affectedRows = $stmt->affected_rows;
            $stmt->close();
            return $affectedRows;
        }
        return 0;
    }

    /**
     * Retorna el token dado un id de usuario.
     */
    public function getById($id)
    {
        $query = "SELECT token FROM usuarios WHERE id = ?";
        if ($stmt = $this->connection->prepare($query)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            $resultArray = [];
            while ($row = $result->fetch_assoc()) {
                $resultArray[] = $row;
            }
            $stmt->close();
            return $resultArray;
        } else {
            return [];
        }
    }

    public function insertarLog($milog)
    {
        $query = "INSERT INTO log (log) VALUES(?)";
        if ($stmt = $this->connection->prepare($query)) {
            $stmt->bind_param("s", $milog);
            $stmt->execute();
            $stmt->close();
        }
    }
}
