<?php

namespace App\DAO;

use App\Model\UserModel;

class UserDAO {
    public function insertUser(UserModel $user) {
        $arquivoJson = file_get_contents(DATA_LOCATION);
        $usuarios = json_decode($arquivoJson, true);

        if (!is_array($usuarios)) {
            $usuarios = [];
        }

        if ($this->emailExists($user->getEmail(), $usuarios)) {
            return false;
        }

        $usuarios[] = [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ];

        $novoArquivoJson = json_encode($usuarios, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        return file_put_contents(DATA_LOCATION, $novoArquivoJson);
    }

    public function emailExists($email, $usuarios) {
        foreach ($usuarios as $usuario) {
            if ($usuario['email'] === $email) {
                return true;
            }
        }
        return false;
    }
}
