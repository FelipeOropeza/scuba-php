<?php

namespace App\DAO;

use App\Model\UserModel;

class UserDAO
{
    public function insertUser(UserModel $user)
    {
        $mail_validation = false;

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
            'password' => $user->getPassword(),
            'mail_validation' => $mail_validation
        ];

        $novoArquivoJson = json_encode($usuarios, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        return file_put_contents(DATA_LOCATION, $novoArquivoJson);
    }

    public function emailExists($email, $usuarios)
    {
        foreach ($usuarios as $usuario) {
            if ($usuario['email'] === $email) {
                return true;
            }
        }
        return false;
    }

    public function getUserByEmail($email)
    {
        $arquivoJson = file_get_contents(DATA_LOCATION);
        $usuarios = json_decode($arquivoJson, true);

        if (!is_array($usuarios)) {
            return null;
        }

        foreach ($usuarios as $usuario) {
            if ($usuario['email'] === $email) {
                if (!$usuario['mail_validation']) {
                    return false;
                }

                return new UserModel(
                    $usuario['id'],
                    $usuario['name'],
                    $usuario['email'],
                    $usuario['password']
                );
            }
        }

        return null;
    }


    public function validarEmail($email)
    {
        $arquivoJson = file_get_contents(DATA_LOCATION);
        $usuarios = json_decode($arquivoJson, true);

        if (!is_array($usuarios)) {
            return false;
        }

        foreach ($usuarios as &$usuario) {
            if ($usuario['email'] === $email) {
                $usuario['mail_validation'] = true;

                $novoArquivoJson = json_encode($usuarios, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                return file_put_contents(DATA_LOCATION, $novoArquivoJson);
            }
        }

        return false;
    }

    public function deleteUserById($id)
    {
        $arquivoJson = file_get_contents(DATA_LOCATION);
        $usuarios = json_decode($arquivoJson, true);

        if (!is_array($usuarios)) {
            return false;
        }

        foreach ($usuarios as $index => $usuario) {
            if ($usuario['id'] === $id) {
                unset($usuarios[$index]);

                $usuarios = array_values($usuarios);

                $novoArquivoJson = json_encode($usuarios, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                return file_put_contents(DATA_LOCATION, $novoArquivoJson);
            }
        }

        return false;
    }

    public function updatePasswordByEmail($email, $newPassword)
{
    $arquivoJson = file_get_contents(DATA_LOCATION);
    $usuarios = json_decode($arquivoJson, true);

    if (!is_array($usuarios)) {
        return false;
    }

    foreach ($usuarios as &$usuario) {
        if ($usuario['email'] === $email) {
            $usuario['password'] = $newPassword;

            $novoArquivoJson = json_encode($usuarios, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            return file_put_contents(DATA_LOCATION, $novoArquivoJson);
        }
    }

    return false;
}

}
