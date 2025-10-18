<?php
class BankAccount {
    private $accountNumber;
    private $accountHolder;
    private $balance;

    public function __construct($accountNumber, $accountHolder, $balance = 0) {
        $this->accountNumber = $accountNumber;
        $this->accountHolder = $accountHolder;
        $this->balance = $balance;
    }

    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
            return "Nạp $amount thành công!";
        }
        return "Số tiền nạp phải > 0.";
    }

    public function withdraw($amount) {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            return "Rút $amount thành công!";
        }
        return "Số dư không đủ!";
    }

    public function displayBalance() {
        return "Số dư hiện tại: " . $this->balance;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $holder  = $_POST["holder"];
    $balance = $_POST["balance"];
    $amount  = $_POST["amount"];
    $action  = $_POST["action"];

    $account = new BankAccount("123456", $holder, $balance);
    if ($action == "deposit") {
        $msg = $account->deposit($amount);
    } else {
        $msg = $account->withdraw($amount);
    }

    echo "<h2>Kết quả</h2>";
    echo $msg . "<br>";
    echo $account->displayBalance();
}
