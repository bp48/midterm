<?php
    class Quote {
        private $conn;
        private $table='quotes';

        public $id;
        public $quote;
        public $author_id;
        public $category_id;

        public function __construct($db) {
            $this->conn= $db;
        }

        public function read() {
            $query = 'SELECT
            q.id,
            q.quote,
            q.author_id,
            q.category_id
            
            FROM
                ' . $this->table . ' q
            ';

            $stmt=$this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
                
        }

        public function read_single(){
            $query = 'SELECT
            q.id,
            q.quote,
            q.author_id,
            q.category_id
            FROM
                ' . $this->table . ' q
            WHERE
                q.id = ?
            LIMIT 0,1';

            $stmt=$this->conn->prepare($query);
            
            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $row= $stmt->fetch(PDO::FETCH_ASSOC);

            $this->quote=$row['quote'];
            $this->author_id=$row['author_id'];
            $this->category_id=$row['category_id'];

        }

        public function create(){
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    quote = :quote
                    author_id = :author_id
                    category_id = :category_id';
            
            $stmt=$this->conn->prepare($query);

            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);

            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;

        }

        public function update(){
            $query = 'UPDATE ' . $this->table . '
                SET
                    quote = :quote
                    author_id = :author_id
                    category_id = :category_id
                WHERE
                    id = :id';
            
            $stmt=$this->conn->prepare($query);

            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;

        }


        public function delete()
        {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            $stmt=$this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;

            
        }
    }