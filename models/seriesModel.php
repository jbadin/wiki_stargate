<?php

require_once 'baseModel.php';

class SeriesModel extends BaseModel
{
    public int $id;
    public string $name;
    public string $short_name;
    public int $start_year;
    public int $end_year;
    public string $description;
    public string $created_at;
    public string $updated_at;

    public function __construct()
    {
        $this->connectDb();
    }

    public function create(): bool
    {
        var_dump($this->prefix);
        $sql = 'INSERT INTO `' . $this->prefix . 'series` (`name`,`short_name`,`start_year`,`end_year`,`description`,`created_at`,`updated_at`) VALUES (:name,:short_name,:start_year,:end_year,:description,NOW(),NOW())';
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':name', $this->name, PDO::PARAM_STR);
        $req->bindValue(':short_name', $this->short_name, PDO::PARAM_STR);
        $req->bindValue(':start_year', $this->start_year, PDO::PARAM_INT);
        $req->bindValue(':end_year', $this->end_year, PDO::PARAM_INT);
        $req->bindValue(':description', $this->description, PDO::PARAM_STR);
        return $req->execute();
    }
}