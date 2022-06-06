<?php

class QueryBuilder
{
    public function __construct(protected PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from ${table}");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($table,$data)
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $table,
            implode(', ',array_keys($data)),
            ':' . implode(', :',array_keys($data))
        );

        try{
        $statement=$this->pdo->prepare($sql);
        $statement->execute($data);
        }catch(Exception $e){
            die('Something wrong');
       }
    }

    public function selectById($table,$id)
    {
        $sql=sprintf(
            'SELECT title,author,content FROM %s WHERE id=%s',
            $table,
            ":id"
        );

        try{
            $statement=$this->pdo->prepare($sql);
            $statement->execute([':id' => $id]);
            return $statement->fetch();
            }catch(Exception $e){
                die('Something wrong');
           }
    }

    public function deleteById($table,$id)
    {
        $sql = sprintf(
            'DELETE FROM %s WHERE id=%s',
            $table,
            ":id"
        );
        
        try{
            $statement=$this->pdo->prepare($sql);
            $statement->execute([':id' => $id]);
            }catch(Exception $e){
                die('Something wrong');
           }
    }

    public function update($table,$data,$id)
    {
        $pairs = [];
        foreach ($data as $key => $value) {
            array_push($pairs, "$key = :$key");
        }

        $sql = sprintf(
            'UPDATE %s SET %s WHERE id = %s',
            $table,
            implode(', ',array_values($pairs)),
            ":id"
        );
        
        try{
        $statement=$this->pdo->prepare($sql);
        $statement->execute([...$data,':id' => $id]);
        }catch(Exception $e){
            die('Something wrong');
       }
    }
    
}