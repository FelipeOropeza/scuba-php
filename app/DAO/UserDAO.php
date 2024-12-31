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

        $usuarios[] = [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ];

        $novoArquivoJson = json_encode($usuarios, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        return file_put_contents(DATA_LOCATION, $novoArquivoJson);
    }
}