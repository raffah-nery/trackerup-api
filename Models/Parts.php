<?php
namespace App\Models;

class Parts
{
    private static $table = 'parts';

    public static function select(int $code)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT p.code,
        p.name,
        c.name AS category,
        p.description,
        p.qty,
        p.ncm FROM ' . self::$table . ' AS p INNER JOIN categories AS c ON p.fk_categories = c.id  WHERE p.code = :code AND p.deleted = false';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        else
        {
            throw new \Exception("Nenhum registro encontrado.");
        }
    }

    public static function selectByCategory(string $category)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT 
        p.code,
        p.name,
        c.name AS category,
        p.description,
        p.qty,
        p.ncm FROM ' . self::$table . ' AS p INNER JOIN categories AS c ON p.fk_categories = c.id WHERE p.fk_categories = (SELECT id FROM categories WHERE name = :category) AND p.deleted = false';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':category', $category);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else
        {
            throw new \Exception("Nenhum registro encontrado.");
        }
    }

    public static function selectAll()
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT p.code,
        p.name,
        c.name AS category,
        p.description,
        p.qty,
        p.ncm FROM ' . self::$table . ' AS p INNER JOIN categories AS c ON p.fk_categories = c.id  WHERE p.deleted = false';
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else
        {
            throw new \Exception("Nenhum registro encontrado.");
        }
    }

    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'INSERT INTO ' . self::$table . ' (code, name, fk_categories, description, qty, ncm, deleted) VALUES (:code, :name, (SELECT id FROM categories WHERE name = :category), :description, :qty, :ncm, :deleted)';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':code', $data['code']);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':category', $data['category']);
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':qty', $data['qty']);
        $stmt->bindValue(':ncm', $data['ncm']);
        $stmt->bindValue(':deleted', 0);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return 'Nova peça inserida com sucesso!';
        }
        else
        {
            throw new \Exception("Falha ao inserir a nova peça!");
        }
    }

    public static function update($code, $data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'UPDATE ' . self::$table . ' SET code=:code, name=:name, fk_categories=(SELECT id FROM categories WHERE name=:category), description=:description, qty=:qty, ncm=:ncm WHERE code=:target';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':code', $data['code']);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':category', $data['category']);
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':qty', $data['qty']);
        $stmt->bindValue(':ncm', $data['ncm']);
        $stmt->bindValue(':target', $code);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return 'Registro alterado com sucesso!';
        }
        else
        {
            throw new \Exception("Falha ao alterar o registro!");
        }
    }

    public static function delete($code)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'UPDATE ' . self::$table . ' SET deleted=true WHERE code = :code';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            return 'Registro deletado com sucesso!';
        }
        else
        {
            throw new \Exception("Falha ao alterar a categoria!");
        }
    }
}

