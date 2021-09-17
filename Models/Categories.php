<?php
namespace App\Models;

class Categories
{
    private static $table = 'categories';

    public static function select(int $id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT id, name, description FROM ' . self::$table . ' WHERE id = :id AND deleted=false';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        else
        {
            throw new \Exception("Nenhuma categoria encontrada!");
        }
    }

    public static function selectAll()
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT id, name, description FROM ' . self::$table . ' WHERE deleted=false';
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else
        {
            throw new \Exception("Nenhuma categoria encontrada!");
        }
    }

    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'INSERT INTO ' . self::$table . ' (name, description) VALUES (:name, :description)';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':name', strtolower($data['name']));
        $stmt->bindValue(':description', $data['description']);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return 'A categoria ' . $data['name'] . ' foi inserida com sucesso!';
        }
        else
        {
            throw new \Exception("Falha ao inserir a categoria!");
        }
    }

    public static function update($id, $data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'UPDATE ' . self::$table . ' SET name=:name, description=:description WHERE id=:id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':name', strtolower($data['name']));
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return 'Registro alterado com sucesso!';
        }
        else
        {
            throw new \Exception("Falha ao alterar a categoria!");
        }
    }

    public static function delete($id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'UPDATE ' . self::$table . ' SET deleted=true WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return 'Registro deletado com sucesso!';
        }
        else
        {
            throw new \Exception("Falha ao deletar a categoria!");
        }
    }
}

