<?php include("../functions.php");
if ((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level']))) header("Location: login.php");
if ($_SESSION['user_level'] != "admin") header("Location: login.php"); ?><?php include 'header.php'; ?> <div class="col-12 col-md-12 p-3 p-md-5 bg-white border border-white text-center"><i class="fas fa-chart-line fa-4x"></i>
    <h1><strong>Laporan Pendapatan</strong></h1>
    <hr>
    <p>Rincian laporan pendapatan.</p>
    <table class="table table-responsive table-lg shadow" width="100%" cellspacing="0">
        <tbody>
            <tr>
                <td class="float-start">Hari ini</td>
                <td class="float-end bg-dark text-white">Rp. <?php echo number_format(getSalesGrandTotal("DAY"),0,',','.'); ?></td>
            </tr>
            <tr>
                <td class="float-start">Minggu ini</td>
                <td class="float-end bg-dark text-white">Rp. <?php echo number_format(getSalesGrandTotal("WEEK"),0,',','.'); ?></td>
            </tr>
            <tr>
                <td class="float-start">Bulan ini</td>
                <td class="float-end bg-dark text-white">Rp. <?php echo number_format(getSalesGrandTotal("MONTH"),0,',','.'); ?></td>
            </tr>
            <tr class="table-warning">
                <td><b>Total Penghasilan</b></td>
                <td><b>Rp. <?php echo number_format(getSalesGrandTotal("ALLTIME"),0,',','.'); ?></b></td>
            </tr>
        </tbody>
    </table>
    <div class="col-12 p-3 p-md-5">
        <table id="tblCurrentOrder" class="table table-responsive table-lg shadow" width="100%" cellspacing="0">
            <thead class="bg-dark text-white">
                <th>#</th>
                <th>Jenis</th>
                <th>Menu</th>
                <th class='text-center'>Qty</th>
                <th class='text-center'>Status</th>
                <th class='text-center'>Total</th>
                <th class='text-center'>Date</th>
            </thead>
            <tbody id="tblBodyCurrentOrder"> <?php $displayOrderQuery = " SELECT O.orderID, M.menuName, OD.itemID,MI.menuItemName,OD.quantity,O.status,MI.price ,date_format(O.order_date,'%d-%m-%Y') as order_date FROM tbl_order O LEFT JOIN tbl_orderdetail OD ON O.orderID = OD.orderID LEFT JOIN tbl_menuitem MI ON OD.itemID = MI.itemID LEFT JOIN tbl_menu M ON MI.menuID = M.menuID WHERE O.status<>'cancelled' ORDER BY O.orderID DESC";
              								if ($orderResult = $sqlconnection->query($displayOrderQuery)) {
                                                    $currentspan = 0;
                                                    $total = 0;
                                                    if ($orderResult->num_rows == 0) {
                                                        echo "<tr><td class='text-center' colspan='7' >Belum ada order saat ini.</td></tr>";
                                                    } else {
                                                        while ($orderRow = $orderResult->fetch_array(MYSQLI_ASSOC)) {
                                                            $rowspan = getCountID($orderRow["orderID"], "orderID", "tbl_orderdetail");
                                                            if ($currentspan == 0) {
                                                                $currentspan = $rowspan;
                                                                $total = 0;
                                                            }
                                                            $total += ($orderRow['price'] * $orderRow['quantity']);
                                                            echo "<tr>";
                                                            if ($currentspan == $rowspan) {
                                                                echo "<td rowspan=" . $rowspan . "># " . $orderRow['orderID'] . "</td>";
                                                            }
                                                            echo "<td>" . $orderRow['menuName'] . "</td><td>" . $orderRow['menuItemName'] . "</td><td class='text-center'>" . $orderRow['quantity'] . "</td> ";
                                                            if ($currentspan == $rowspan) {
                                                                echo "<td class='text-center' rowspan=" . $rowspan . ">" . $orderRow['status'] . "</td>";
                                                                echo "<td rowspan=" . $rowspan . " class='text-center'>" . number_format(getSalesTotal($orderRow['orderID']),0,',','.') . "</td>";
                                                                echo "<td rowspan=" . $rowspan . " class='text-center'>" . $orderRow['order_date'] . "</td>";
                                                                echo "</td>";
                                                            }
                                                            echo "</tr>";
                                                            $currentspan--;
                                                        }
                                                    }
                                                } ?></tbody>
        </table>
    </div> <?php include 'footer.php'; ?>