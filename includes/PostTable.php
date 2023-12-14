<?php

class PostTable
{
    protected PDO $pdo;

    public function __construct()
    {
        include(__DIR__ . '/../includes/Config.php');
        $dbConfig = $config['db'];
        $database = $dbConfig['database'];
        $hostname = $dbConfig['hostname'];
        $username = $dbConfig['username'];
        $password = $dbConfig['password'];

        $this->pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    }

    /**
     * @return int Last insert ID.
     */
    public function insert(
        string $username,
        string $email,
    ):int {
        $sql = '
            INSERT
              INTO `post` (`username`, `email`)
            VALUES (:username, :email)
                 ;
        ';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    public function updateSetImageWherePostId(
        string $image,
        int $postId,
    ) {
        $sql = '
            UPDATE `post`
               SET `image` = :image
             WHERE `post_id` = :postId
                 ;
        ';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':postId', $postId);

        $stmt->execute();
    }

    public function select(): array
    {
        $sql = '
            SELECT `post_id`, `username`, `email`, `image`
              FROM `post`
             ORDER
                BY `post_id` ASC
                 ;
        ';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectWherePostId(
        int $postId,
    ):array {
        $sql = '
            SELECT `post_id`, `username`, `email`, `image`
              FROM `post`
             WHERE `post_id` = :postId
                 ;
        ';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':postId', $postId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
