<?php include './main/index.php';
include './main/db_connect.php';
?>
<br><br><br>
    <form id="voucherForm" method="POST" action="process_voncher.php">
        <div class="container-fluid mt-3">
            <div>
                <h5>ရောင်းဈေးပေါင်းထည့်ရန်</h5>
            </div>
            <div class="row">
                <div class="col-sm-5 col-md-6">
                    <!-- Sell record display -->
                    <?php
                    $file = __DIR__ . DIRECTORY_SEPARATOR . 'sellrecord.php';
                    if (file_exists($file)) {
                        include($file);
                    } else {
                        echo "File not found";
                    }
                    ?>
                </div>
                <div class="bg-white col-sm-5 col-md-6">
                    <h5 class="text-center">Voucher</h5>
                    <div class="row">
                        <div class="col h5 mb-0"><p id="barcode"></p></div>
                        <div class="col h5 mb-0"><p id="product"></p></div>
                        <div class="col h5 mb-0"><p id="price"></p></div>   
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="button col-md-6">
                                <button type="submit" name="submit" class="btn btn-info" style="width: 100%; height: 50px; font-size: 20px;">Save</button>  
                            </div>
                            <div class="button col-md-6">
                                <button type="button" class="btn btn-danger" style="width: 100%; height: 50px; font-size: 20px;" onclick="handlePrint()">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        let barcode = '';
        let interval;

        document.addEventListener('keydown', (e) => {
            if (interval) {
                clearInterval(interval);
            }

            if (e.code === 'Enter') {
                if (barcode) {
                    fetchProductDetails(barcode);
                    barcode = '';
                }
            } else {
                barcode += e.key;
                interval = setInterval(() => barcode = '', 500);
            }
        });

        function fetchProductDetails(barcode) {
            if (barcode) {
                const url = `get_product.php?barcode=${encodeURIComponent(barcode)}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            document.getElementById('barcode').innerText = barcode;
                            document.getElementById('product').innerText = data.product;
                            document.getElementById('price').innerText = data.price;
                            document.getElementById('voucherForm').barcode.value = barcode;
                            document.getElementById('voucherForm').product.value = data.product;
                            document.getElementById('voucherForm').price.value = data.price;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                alert('Please enter a barcode');
            }
        }

        function handlePrint() {
            fetch('http://127.0.0.1:5000/print', {  // Update URL to match your printing server
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Print job started successfully!');
                } else {
                    alert('Failed to start print job.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error starting print job.');
            });
        }
    </script>

