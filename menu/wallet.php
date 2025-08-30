<?php
include('../config.php');
global $keyId, $keySecret, $displayCurrency;

if (isset($_SESSION['user_name'])) {
  $user_name = $_SESSION['user_name'];
  $user_id = $_SESSION['user_id'];

  $stmt = $con->prepare("SELECT totalamount FROM wallet_table WHERE user_id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    $totalamount = $row['totalamount'];
  } else {
    $totalamount = "0";
  }
}
?>

<?php



$stmtt = $GLOBALS['con']->prepare("SELECT * FROM api");
$stmtt->execute();
$resultt = $stmtt->get_result();
$rowt = $resultt->fetch_assoc();
$keyId = $rowt['api_key'];
$keySecret = $rowt['api_secret'];
$displayCurrency = 'INR';

require('../sbspay/razorpay-php/Razorpay.php');

if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
} else {
    // Handle isn't logged in
    die("User not logged in.");
}


// Use a prepared statement for user fetch
$stmt = $GLOBALS['con']->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if (!$row) {
    die("User not found.");
}
$user_id = $row['id'];
$_SESSION['user_id'] = $user_id;
$user_name = $row['username'];
$email = $row['email'];
$mobile = $row['mobile'];
$stmt->close();


$price = !empty($_POST['enterdepositAmount']) ? floatval($_POST['enterdepositAmount']) : 1;


$_SESSION['price'] = $price;
$_SESSION['shopping_id'] = rand(1000, 9999);



require_once __DIR__ . '/../sbspay/razorpay-php/Razorpay.php';
use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);


$orderData = [
    'receipt'         => $_SESSION['shopping_id'],
    'amount'          => $price * 100, // in paise
    'currency'        => 'INR',
    'payment_capture' => 1
];



 $razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR') {
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);
    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "My Wallet",
    "description"       => "Coding for Everyone",
    "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
    "prefill"           => [
        "name"              => $user_name,
        "email"             => $email,
        "contact"           => $mobile,
    ],
    "notes"             => [
        "address"           => "SBS Technologies, Erode",
        "merchant_order_id" => "8144065688",
    ],
    "theme"             => [
        "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR') {
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);
?>



<style>
  /* General Styles */
  body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    padding: 20px;
  }
  .wallet-box, .withdraw-box, .wallet-container, .section {
    background: #fff;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    width: 100%;
  }
  .wallet-box, .withdraw-box { text-align: center; }

  /* Sections */
  .section { display: none; width: 100%; }
  .section.active { display: block; }

  /* Headings */
  h2, h3 {
    margin: 0 0 15px;
    color: #333;
    text-align: center;
  }

  /* Balance */
  .balance, .total-cash {
    font-size: 20px;
    font-weight: bold;
    color: #1c7ed6;
    margin: 10px 0;
    text-align: center;
  }

  /* Transaction Link */
  .transaction {
    text-align: right;
    margin: 10px 0 20px;
  }
  .transaction a {
    color: #4dabf7;
    font-weight: bold;
    text-decoration: none;
    transition: 0.3s;
  }
  .transaction a:hover { text-decoration: underline; }

  /* Buttons */
  .btn, button {
    display: block;
    text-align: center;
    border: none;
    width: 100%;
    font-size: 18px;
    font-weight: bold;
    border-radius: 12px;
    cursor: pointer;
    transition: 0.3s;
    padding: 12px;
    margin: 10px 0;
  }
  .btn { background: #4dabf7; color: #fff; }
  .btn:hover { background: #1c7ed6; transform: scale(1.05); }
  .btn.withdraw, button.withdraw { background: #ff6b6b; color: #fff; }
  .btn.withdraw:hover, button.withdraw:hover { background: #d6336c; transform: scale(1.05); }


  .btn.pay {background-color: #28a745; }
  .btn.pay:hover { background-color: #218838;  }


  /* Input Fields */
  input, input[type="number"] {
    width: 100%;
    padding: 12px;
    border: 2px solid #ddd;
    border-radius: 10px;
    font-size: 16px;
    margin-bottom: 20px;
    outline: none;
    transition: border 0.3s;
  }
  input:focus, input[type="number"]:focus { border-color: #4dabf7; }

  /* Amount Selection */
  .amount-options {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin: 20px 0;
  }
  .amount-box {
    background: #4dabf7;
    color: #fff;
    padding: 20px;
    border-radius: 12px;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    cursor: pointer;
    transition: 0.3s;
    height:100px;
  }
  .amount-box:hover { box-shadow: 0 6px 15px rgba(0,0,0,0.2); background: #1c7ed6; transform: scale(1.1); }


  /* Different background colors */
  .amount-box:nth-child(1) { background: #ff6b6b; } /* Red */
  .amount-box:nth-child(2) { background: #4dabf7; } /* Blue */
  .amount-box:nth-child(3) { background: #51cf66; } /* Green */
  .amount-box:nth-child(4) { background: #f59f00; } /* Orange */


  /* Withdraw Method */
  .method { margin: 15px 0; }
  .method p { font-weight: bold; margin-bottom: 10px; color: #333; }
  label {
    display: block;
    margin-bottom: 10px;
    cursor: pointer;
    font-size: 16px;
    color: #444;
  }
  input[type="radio"] { margin-right: 8px; }

  /* Tabs */
  .tabs {
    display: flex;
    margin-bottom: 20px;
  }
  .tab {
    flex: 1;
    text-align: center;
    padding: 12px;
    cursor: pointer;
    border-radius: 8px;
    background: #e9ecef;
    font-weight: bold;
    transition: 0.3s;
    margin: 0 5px;
  }
  .tab.active {
    background: #4dabf7;
    color: #fff;
  }

  /* Transactions */
  .transaction-item {
    background: #f8f9fa;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
  }
  .failed { color: #d6336c; font-weight: bold; }
  .success { color: #2f9e44; font-weight: bold; }

  .razorpay-payment-button {
  background-color: green !important;
  color: #fff !important;
  border: none !important;
  padding: 10px 20px !important;
  font-size: 16px !important;
  border-radius: 8px !important;
  cursor: pointer !important;
}

</style>

<!-- Wallet Section (default) -->
<div id="wallet" class="section active">
  <h2>Total Cash</h2>
  <div class="total-cash">₹<?php echo $totalamount; ?></div>
  <div class="transaction">
    <a href="#" onclick="showSection('wallet-container')">Transaction History</a>
  </div>
  <button class="btn" onclick="showSection('addcash')">➕ Add Cash</button>
  <button class="btn withdraw" onclick="showSection('withdraw')">💸 Withdraw</button>
</div>

<!-- Add Cash Section -->
<div id="addcash" class="section">
  <h2>Add Cash</h2>
   <form id="depositForm" action="../sbspay/depositverify.php" method="post">
  <b>Balance: ₹<?php echo $totalamount; ?></b><br>
  <b>Select Amount</b>
  <div class="amount-options">
    <div class="amount-box">10</div>
    <div class="amount-box">20</div>
    <div class="amount-box">30</div>
    <div class="amount-box">40</div>
  </div>
  <input type="number" id="enterdepositAmount" name="enterdepositAmount" placeholder="Enter Custom Amount" required="" />
  <!--<button type="submit" class="btn pay">Pay</button> -->

 <script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo htmlspecialchars($data['key']); ?>"
    data-amount="<?php echo htmlspecialchars($data['amount']); ?>"
    data-currency="INR"
    data-name="<?php echo htmlspecialchars($data['name']); ?>"
    data-image="<?php echo htmlspecialchars($data['image']); ?>"
    data-description="<?php echo htmlspecialchars($data['description']); ?>"
    data-prefill.name="<?php echo htmlspecialchars($data['prefill']['name']); ?>"
    data-prefill.email="<?php echo htmlspecialchars($data['prefill']['email']); ?>"
    data-prefill.contact="<?php echo htmlspecialchars($data['prefill']['contact']); ?>"
    data-notes.shopping_order_id="3456"
    data-order_id="<?php echo htmlspecialchars($data['order_id']); ?>"
    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo htmlspecialchars($data['display_amount']); ?>" <?php } ?>
    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo htmlspecialchars($data['display_currency']); ?>" <?php } ?>
  >
  </script>
  <input type="hidden" name="shopping_order_id" value="<?php echo htmlspecialchars($_SESSION['shopping_id']); ?>">

  <button class="btn" onclick="goBack()">⬅ Back</button>
</form>
</div>



<!-- Withdraw Section -->
<div id="withdraw" class="section">
  <h2>Withdraw</h2>
  <div class="balance">Balance: ₹<?php echo $totalamount; ?></div>
  <input type="number" placeholder="Enter amount" />
  <div class="method">
    <p>Withdraw Method</p>
    <label><input type="radio" name="method" value="upi"> UPI</label>
    <label><input type="radio" name="method" value="bank"> Bank Account</label>
  </div>
  <button class="btn withdraw">Withdraw</button>
 <button class="btn" onclick="goBack()">⬅ Back</button>
</div>

<!-- Transaction History -->
<div id="wallet-container" class="section">
 <h2>AddCash/ Withdraw Transactions</h2>

  <div class="tabs">
    <div class="tab active" onclick="showTab('displayadd', this)">Add Cash</div>
    <div class="tab" onclick="showTab('displaywithdraw', this)">Withdraw</div>
  </div>


   <section id="transaction" class="content-section">
    <h2>Transaction</h2>
     <div class="table-responsive container mt-4 d-none">
     <table border="1" width="100%" id="example" class="table table-bordered table-striped table-hover align-middle mb-0">
        <thead class="table-dark">
            <tr>
                <th>S.No</th>
                <th>Order ID</th>
                <th>Payment ID</th>
                <th>Name</th>
                <th>Product ID</th>
                <th>Price</th>
                <th>Datetime</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        $sql = mysqli_query($GLOBALS['con'], "SELECT * FROM transactions ORDER BY id DESC LIMIT 10") 
               or die(mysqli_error($GLOBALS['con']));
        while ($row = mysqli_fetch_array($sql)) {
            echo '<tr>
                <td>' . $i . '</td>
                <td>' . htmlspecialchars($row['transaction_id']) . '</td>
                <td>' . htmlspecialchars($row['razorpay_id']) . '</td>
                <td>' . htmlspecialchars($row['user_id']) . '</td>
                <td>' . htmlspecialchars($row['product_id']) . '</td>
                <td>₹' . number_format($row['price'], 2) . '</td>
                <td>' . htmlspecialchars($row['datetime']) . '</td>
                <td><span class="badge bg-' . 
                        ($row['status'] === 'success' ? 'success' : 'danger') . '">' . 
                        htmlspecialchars($row['status']) . '</span></td>
            </tr>';
            $i++;
        }
        ?>
        </tbody>
    </table>
  </div>

  </section>



  <!-- Add Cash Records -->
  <div id="displayadd" class="section active">
    <h3>Add Cash Records</h3>
    <div class="transaction-list">
      <div class="transaction-item">
        <span>Add Cash - GPay</span>
        <span class="failed">₹20 Failed</span>
      </div>
      <div class="transaction-item">
        <span>Add Cash - GPay</span>
        <span class="success">₹30 Success</span>
      </div>
      <div class="transaction-item">
        <span>Add Cash - UPI</span>
        <span class="success">₹100 Success</span>
      </div>
    </div>
  </div>

  <!-- Withdraw Records -->
  <div id="displaywithdraw" class="section">
    <h3>Withdraw Records</h3>
    <div class="transaction-list">
      <div class="transaction-item">
        <span>Withdraw - Bank</span>
        <span class="failed">₹50 Failed</span>
      </div>
      <div class="transaction-item">
        <span>Withdraw - UPI</span>
        <span class="success">₹70 Success</span>
      </div>
      <div class="transaction-item">
        <span>Withdraw - GPay</span>
        <span class="success">₹150 Success</span>
      </div>
    </div>
  </div>

<button class="btn" onclick="goBack()">⬅ Back</button>

<script>
  function goBack() {
    // This will take user to the previous page/section
    window.history.back();
  }
</script>

</div>

<script>
  // Switch main sections (wallet, addcash, withdraw, history)
  function showSection(id) {
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    document.getElementById(id).classList.add('active');
  }

  //Switch tabs inside Transaction History
  function showTab(id, tabElement) {
    document.querySelectorAll('#wallet-container .section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    document.getElementById(id).classList.add('active');
    tabElement.classList.add('active');
  }


  // ✅ Open first tab (Add Cash) by default on load
  window.onload = function() {
    const firstTab = document.querySelector('.tabs .tab');
      showTab('displayadd', firstTab);
  };
</script>


<style>
  .section { display: none; padding: 10px; background: #fff; border: 1px solid #ddd; }
  .section.active { display: block; }
  .tab { display: inline-block; padding: 10px; cursor: pointer; background: #ddd; }
  .tab.active { background: #4CAF50; color: #fff; }
</style>



<script>
  function goBack() {
    // This will take user to the previous page/section
    window.history.back();
  }
</script>



<script>
  const amountBoxes = document.querySelectorAll(".amount-box");
  const selectedAmountInput = document.getElementById("enterdepositAmount");

  amountBoxes.forEach(box => {
    box.addEventListener("click", () => {
      // Remove active class from all
      amountBoxes.forEach(b => b.classList.remove("active"));
      // Add active to clicked
      box.classList.add("active");
      // Set value in textbox
      enterdepositAmount.value = box.innerText;
    });
  });
</script>




