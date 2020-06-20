<?php

class Connection
{
    public $pdo = null;

    public function __construct()
    {
        try {
            // $this->pdo = new PDO('mysql:server=localhost;dbname=notes', 'root', '');
            $this->pdo = new PDO('mysql:server=remotemysql.com;dbname=voVh3Ac1IY', 'voVh3Ac1IY', 'y9jnsz7bP5');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "ERROR: " . $exception->getMessage();
        }

    }

    public function getNotes()
    {
        $statement = $this->pdo->prepare("SELECT * FROM voVh3Ac1IY ORDER BY create_date DESC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addNote($note)
    {
        $statement = $this->pdo->prepare(

            "INSERT INTO voVh3Ac1IY (title, description, create_date)
        VALUES (:title, :description, :date)");

        $statement->bindValue('title', $note['title']);
        $statement->bindValue('description', $note['description']);
        $statement->bindValue('date', date('Y-m-d H:i:s'));
        return $statement->execute();
    }

    public function getNoteById($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM voVh3Ac1IY WHERE id = :id");
        $statement->bindValue('id',$id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateNote($id, $note)
    {
        $statement = $this->pdo->prepare("UPDATE notes SET title = :title, description = :description WHERE id = :id");
        $statement->bindValue('id', $id);
        $statement->bindValue('title', $note['title']);
        $statement->bindValue('description', $note['description']);
        return $statement->execute();
    }

    public function deleteNote($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM notes WHERE id = :id");
        $statement->bindValue('id', $id);
        return $statement->execute();
    }
}
return new Connection();

