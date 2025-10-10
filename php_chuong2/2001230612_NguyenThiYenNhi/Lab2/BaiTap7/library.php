<?php
class Book {
    protected $title;
    protected $author;
    protected $price;

    public function __construct($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    public function displayInfo() {
        return "Title: $this->title, Author: $this->author, Price: $this->price";
    }
}

interface Downloadable {
    public function download();
}

class Ebook extends Book implements Downloadable {
    private $fileSize;

    public function __construct($title, $author, $price, $fileSize) {
        parent::__construct($title, $author, $price);
        $this->fileSize = $fileSize;
    }

    public function displayInfo() {
        return parent::displayInfo() . " | File Size: {$this->fileSize} MB";
    }

    public function download() {
        return "Downloading '{$this->title}'...";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title  = $_POST["title"];
    $author = $_POST["author"];
    $price  = $_POST["price"];
    $type   = $_POST["type"];

    if ($type == "book") {
        $book = new Book($title, $author, $price);
        echo "<h2>Kết quả</h2>";
        echo $book->displayInfo();
    } else {
        $fileSize = $_POST["fileSize"];
        $ebook = new Ebook($title, $author, $price, $fileSize);
        echo "<h2>Kết quả</h2>";
        echo $ebook->displayInfo() . "<br>" . $ebook->download();
    }
}
