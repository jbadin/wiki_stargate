<?php

require_once 'baseModel.php';

class SeriesModel extends BaseModel
{
    public int $id;
    public string $name;
    public string $short_name;
    public int $start_year;
    public int $end_year;
    public string $img;
    public string $description;
    public string $created_at;
    public string $updated_at;

    public function __construct()
    {
        $this->connectDb();
    }

    /**
     * Check if a series already exists in the database by a given field and value
     * @param mixed $field
     * @param mixed $value
     * @return bool
     */
    public function checkIfExists($field, $value): bool
    {
        $sql = 'SELECT COUNT(*) FROM `' . $this->prefix . 'series` WHERE `' . $field . '` = :value';
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':value', $value, PDO::PARAM_STR);
        $req->execute();
        return $req->fetchColumn() > 0;
    }

    /**
     * 
     * Method to create a new series in the database
     * @param string name - the name of the series
     * @param string short_name - the short name of the series
     * @param int start_year - the year the series started
     * @param int end_year - the year the series ended
     * @param string description - the description of the series
     * @return bool
     */
    public function create(): bool
    {
        $sql = 'INSERT INTO `' . $this->prefix . 'series` (`name`,`short_name`,`start_year`,`end_year`, `img`,`description`,`created_at`,`updated_at`) VALUES (:name,:short_name,:start_year,:end_year,:img,:description,NOW(),NOW())';
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':name', $this->name, PDO::PARAM_STR);
        $req->bindValue(':short_name', $this->short_name, PDO::PARAM_STR);
        $req->bindValue(':start_year', $this->start_year, PDO::PARAM_INT);
        $req->bindValue(':end_year', $this->end_year != '' ? $this->end_year : 'NULL', PDO::PARAM_INT);
        $req->bindValue(':img', $this->img, PDO::PARAM_STR);
        $req->bindValue(':description', $this->description, PDO::PARAM_STR);
        return $req->execute();
    }

        /**
        * Method to get an existing series in the database
        * @param int id - the id of the series to update
        * @return bool
        */
    public function getByShortName(string $short_name): bool
    {
        $sql = 'SELECT `id`,`name`, `start_year`, `end_year`, `img`, `description` FROM `' . $this->prefix . 'series` WHERE `short_name` = :short_name';
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':short_name', $short_name, PDO::PARAM_STR);
        $req->execute();
        $series = $req->fetch(PDO::FETCH_ASSOC);
        if ($series) {
            $this->id = (int)$series['id'];
            $this->name = $series['name'];
            $this->start_year = (int)$series['start_year'];
            $this->end_year = (int)$series['end_year'];
            $this->img = $series['img'];
            $this->description = $series['description'];
            return true;
        } else {
            return false;
        }
    }

    public function getList(): array
    {
        $sql = 'SELECT `id`,`name`, `short_name`, `start_year`, `end_year`, `img`, `description`, DATE_FORMAT(`created_at`, "%d/%m/%Y à %Hh%i") AS created_at, DATE_FORMAT(`updated_at`, "%d/%m/%Y à %Hh%i") AS updated_at FROM `' . $this->prefix . 'series` ORDER BY `name` ASC';
        $req = $this->pdo->query($sql);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

}