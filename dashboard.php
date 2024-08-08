<?php
include './main/sidebar.php';
include './main/db_connect.php';

//============== Product open================================//  

$sqlPrice = "SELECT SUM(total_price) AS total_prices FROM products_copy";
$resultPrice = $conn->query($sqlPrice);
$pricetotal = $resultPrice->fetch_assoc();

$sqlQty = "SELECT SUM(quantity) AS qty FROM products_copy";
$resultQty = $conn->query($sqlQty);
$qtytotal = $resultQty->fetch_assoc();

$sqlProfic = "SELECT SUM(profic) AS Profics FROM products_copy";
$resultProfic = $conn->query($sqlProfic);
$profictotal = $resultProfic->fetch_assoc();

//============== Product close================================//  

//============== Sell open================================//  

$sqlItem = "SELECT SUM(item_count) AS total_items FROM sell";
$resultItem = $conn->query($sqlItem);
$item = $resultItem->fetch_assoc();

$sqlSellPrice = "SELECT SUM(total_price) AS sell_price FROM sell";
$resultSellPrice = $conn->query($sqlSellPrice);
$sellpricetotal = $resultSellPrice->fetch_assoc();

//============== Sell close================================//  

//============== Document open================================//  

$sqlDocumentPrice = "SELECT SUM(total_price) AS document_price FROM documents";
$resultDocumentPrice = $conn->query($sqlDocumentPrice);
$DocumentPrice = $resultDocumentPrice->fetch_assoc();

//============== Document close================================// 

//============== Employy open================================//  

$sqlEmployy = "SELECT COUNT(*) AS total_employy FROM employy";
$resultEmployy = $conn->query($sqlEmployy);
$employy = $resultEmployy->fetch_assoc();

$sqlSalary = "SELECT SUM(salary) AS total_salary FROM employy";
$resulSalary = $conn->query($sqlSalary);
$salary = $resulSalary->fetch_assoc();

//============== Employy close================================// 

//============== income/outcome open================================//  

$sqlIncome = "SELECT SUM(income) AS total_income FROM incomes";
$resultIncome = $conn->query($sqlIncome);
$income = $resultIncome->fetch_assoc();

$sqlOutcome = "SELECT SUM(outcome) AS total_outcome FROM outcomes";
$resultOutcome = $conn->query($sqlOutcome);
$outcome = $resultOutcome->fetch_assoc();

//============== income/outcome close================================// 

?>
<style>
.card-body {
    padding: 20px;
}
</style>

<div class="content-page">
    <div class="container-fluid mt-3">
        <h3>Dashboards</h3>
        <div class="row">
            <div class="col-12 col-md-4 mb-3">
                <div class="card bg-transparent text-white p-2 h-100 d-flex flex-column">
                    <div class="card-body">
                        <h4>ဝယ်ယူမှုစာရင်း</h4>
                        <p style="padding-left: 20px; padding-top: 10px" class="h5">ရောင်းရငွေ :
                            <?php echo $pricetotal['total_prices']?></p>
                        <p style="padding-left: 20px;" class="h5">အရေအတွက် : <?php echo $qtytotal['qty']?></p>
                        <p style="padding-left: 20px;" class="h5">အမြတ်ငွေ : <?php echo $profictotal['Profics']?></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <div class="card bg-transparent text-white p-2 h-100 d-flex flex-column">
                    <div class="card-body">
                        <h4>ရောင်းအားစာရင်း</h4>
                        <p style="padding-left: 20px; padding-top: 10px" class="h5">အရေအတွက် :
                            <?php echo $item['total_items']?></p>
                        <p style="padding-left: 20px;" class="h5">ရောင်းရငွေ :
                            <?php echo $sellpricetotal['sell_price']?></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <div class="card bg-transparent text-white p-2 h-100 d-flex flex-column">
                    <div class="card-body">
                        <h4>အသုံးစရိတ်စာရင်း</h4>
                        <p style="padding-left: 20px; padding-top: 10px" class="h5">အသုံးစာရိတ်စုစုပေါင်း :
                            <?php echo $DocumentPrice['document_price']?></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <div class="card bg-transparent text-white p-2 h-100 d-flex flex-column">
                    <div class="card-body">
                        <h4>ဝန်ထမ်းစာရင်း</h4>
                        <p style="padding-left: 20px; padding-top: 10px" class="h5">ဝန်ထမ်းအရေအတွက် :
                            <?php echo $employy['total_employy']?></p>
                        <p style="padding-left: 20px;" class="h5">စုစုပေါင်းလစာ : <?php echo $salary['total_salary']?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <div class="card bg-transparent text-white p-2 h-100 d-flex flex-column">
                    <div class="card-body">
                        <h4>အခြားအသုံးစာရိတ်</h4>
                        <p style="padding-left: 20px; padding-top: 10px" class="h5">ဝင်ငွေ :
                            <?php echo $income['total_income']?></p>
                        <p style="padding-left: 20px;" class="h5">ထွက်ငွေ : <?php echo $outcome['total_outcome']?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>