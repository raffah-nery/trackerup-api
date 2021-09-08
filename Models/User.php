<?php
namespace App\Models;

class User
{
    private static $table = 'users';

    public static function select(int $id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        else
        {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    public static function selectByEmail(string $email)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE email = :email';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        else
        {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    public static function selectAll()
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table;
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else
        {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'INSERT INTO ' . self::$table . ' (name, email, password) VALUES (:name, :email, :password)';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':password', md5($data['password']));
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return 'Usuário(a) inserido com sucesso!';
        }
        else
        {
            throw new \Exception("Falha ao inserir usuário(a)!");
        }
    }
}

