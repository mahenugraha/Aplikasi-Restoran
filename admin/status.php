<?php include("../functions.php"); if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) header("Location: login.php"); if($_SESSION['user_level'] != "admin") header("Location: login.php"); ?> <?php include 'header.php'; ?> <div class="col-12 col-md-12 p-3 p-md-3 bg-white border border-white text-center"><h1 class="text-center">Order Status</h1> <i class="fas fa-tv fa-4x"></i><hr><p class="text-center">Daftar Status Pesanan</p><div class="card-body text-center"><table id="tblCurrentOrder" table class="table table-responsive table-lg shadow" width="100%" cellspacing="0"><thead class="bg-dark text-white"><th>#</th><th>Jenis</th><th>Menu</th><th>Qty</th><th>Status</th></thead><tbody id="tblBodyCurrentOrder"></tbody></table></div></div> <script src="vendor/jquery/jquery.min.js"></script> <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> <script src="vendor/jquery-easing/jquery.easing.min.js"></script> <script src="js/sb-admin.min.js"></script> <script type="text/javascript">$(document).ready(function(){refreshTableOrder();});function refreshTableOrder(){$("#tblBodyCurrentOrder").load("displayorder.php?cmd=display");} setInterval(function(){refreshTableOrder();},3000);</script> <?php include 'footer.php'; ?>