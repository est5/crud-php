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

    public function insert($table,$params)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ',array_keys($params)),
            ':' . implode(', :',array_keys($params))
        );

        try{
        $statement=$this->pdo->prepare($sql);
        $statement->execute($params);
        }catch(Exception $e){
            die('Something wrong');
       }
    }

    public function update($table,$params,$id)
    {
        $pairs = [];
        foreach ($params as $key => $value) {
            array_push($pairs, "$key = :$key");
        }

        $sql = sprintf(
            'update %s set %s where id = %s',
            $table,
            implode(', ',array_values($pairs)),
            ":id"
        );
        
        try{
        $statement=$this->pdo->prepare($sql);
        $statement->execute([...$params,':id' => $id]);
        }catch(Exception $e){
            die('Something wrong');
       }
    }
    
}