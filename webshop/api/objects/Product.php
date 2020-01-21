<?php

class Product
{
    // Table names
    private const PROD = "product";
    // Connection
    private $connection;
    // Attributes
    private $id;
    private $name;
    private $price;
    private $stock;
    private $webshop;


    //Getters and Setters
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name){
        $this->name = $name;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice(float $price)
    {
        $this->price = $price;
    }
    public function getStock(): int
    {
        return $this->stock;
    }
    public function setStock(int $stock)
    {
        $this->stock = $stock;
    }
    public function getWebshop(): string
    {
        return $this->webshop;
    }
    public function setWebshop(string $webshop){
        $this->webshop = $webshop;
    }


    // Constructor    
    public function __construct(\Pdo $db)
    {
        $this->connection = $db;
    }

    function read()
    {
        $query = 'SELECT p.id, p.name, p.price, p.stock, p.webshop FROM ' . SELF::PROD . ' p';
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create(){
        $query = 'INSERT INTO '. SELF::PROD . ' SET name=:name, price=:price, stock=:stock, webshop=:webshop';
        $stmt = $this->connection->prepare($query);

        $stmt->bindValue(':name',$this->getName());
        $stmt->bindValue(':price',$this->getPrice());
        $stmt->bindValue(':stock',$this->getStock());
        $stmt->bindValue(':webshop',$this->getWebshop());


        if($stmt->execute()){
            return true;
        }return false;

    }

    function buy(){
        
    }


}
