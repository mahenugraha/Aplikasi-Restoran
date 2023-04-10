<?php
	include("../functions.php");

  if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
    header("Location: login.php");

  if($_SESSION['user_level'] != "staff")
    header("Location: login.php");

  if($_SESSION['user_role'] != "waiters"){
    echo ("<script>window.alert('Available for waiters only!'); window.location.href='index.php';</script>");
    exit();
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Buat Pesanan</title>
  </head>
  <nav class="navbar navbar-expand-lg navbar-light bg-dark text-white">
    <div class="container-fluid"> <a class="navbar-brand" href="#"><img width="50" class="img=fluid" src="../image/bg-2.png"></a> <button class="navbar-toggler text-warning" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"> <i class="fas fa-ellipsis-v"></i> </button>
        <div class="collapse navbar-collapse text-center justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav"> <a class="nav-link text-warning" href="index.php"> <i class="fas fa-concierge-bell"></i> <span>Home</span> </a>  <a class="nav-link text-warning" href="order.php"> <i class="fas fa-utensils"></i> <span>Pesanan</span></a>   <a class="nav-link text-warning" href="#" data-toggle="modal" data-target="#logoutModal"> <i class="fas fa-power-off"></i> <span>Logout</span> </a></div>
        </div>
    </div>
</nav>
	   <div class="container">
<div class="row">
<div class="col-12 col-md-12 p-3 p-md-3"></div>
<div class="col-12 col-md-4 p-3 p-md-3 shadow rounded">
          <!-- Page Content -->
          <h1 class="text-center"><strong>Pesanan</strong></h1>
          <hr>
          <p class="text-center">Pilih menu dan buat pesanan.</p>

          
                  <table class="table text-center" width="100%" cellspacing="0">
                  	<tr>
                  	<?php 
						$menuQuery = "SELECT * FROM tbl_menu";

						if ($menuResult = $sqlconnection->query($menuQuery)) {
							$counter = 0;
							while($menuRow = $menuResult->fetch_array(MYSQLI_ASSOC)) { 
								if ($counter >=4) {
									echo "</tr>";
									$counter = 0;
								}

								if($counter == 0) {
									echo "<tr>";
								} 
								?>
								<td class="bg-dark"><button style="margin-bottom:4px;white-space: normal;" class="btn btn-warning" onclick="displayItem(<?php echo $menuRow['menuID']?>)"><?php echo $menuRow['menuName']?>  <i class="fas fa-utensils"></i></button></td>
							<?php

							$counter++;
							}
						}
					?>
					</tr>
                  </table>
                  <table id="tblItem" class="table table-bordered text-center bg-warning text-white" width="100%" cellspacing="0"></table>

                <div id="qtypanel" hidden="">
        					Qty : <input id="qty" required="required" type="number" min="1" max="50" name="qty" value="1" />
        					<button class="btn btn-dark" onclick = "insertItem()">+ Order</button>
        					<br><br>
				</div>

                </div>
            
         

<div class="col-12 col-md-8 p-3 p-md-3 ">
                <div class="card-header text-center bg-dark text-white">
                  Daftar Pesanan</div>
                <div class="card-body">
                    <form action="insertorder.php" method="POST">
						<table id="tblOrderList" class="table " width="100%" cellspacing="0">
							<tr>
								<th>Menu</th>
								<th>Harga</th>
								<th width="8%">Qty</th>
								<th>Total</th>
								<th width="8%">Hapus</th>
							</tr>
						</table>
					
						<input class="btn btn-dark btn-lg col-12" type="submit" name="sentorder" value="Simpan Pesanan">
					</form>
                </div>
              </div>
            </div>


<div class="col-12 col-md-12 p-3 p-md-5 bg-white border border-white text-center">
Copyright © 2022
</div>


      </div>
      <!-- /.content-wrapper -->



      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel">Log Out</h5> <button class="close btn btn-dark text-white" type="button" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body bg-dark text-light">Yakin mau keluar ?<br>Klik Logout untuk keluar dari aplikasi ini</div>
            <div class="modal-footer bg-warning"> <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button> <a class="btn btn-danger" href="logout.php">Logout</a></div>
        </div>
    </div>
</div>

   
<script src="vendor/jquery/jquery.min.js"></script> <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> <script src="vendor/jquery-easing/jquery.easing.min.js"></script> <script src="js/sb-admin.min.js"></script> <script src='https://cdn.jsdelivr.net/npm/vue/dist/vue.js'></script> <script src='https://bstp.sourceforge.io/gallerya.js'></script> <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> <script>var currentItemID=null;function displayItem(id){$.ajax({url:"displayitem.php",type:'POST',data:{btnMenuID:id},success:function(output){$("#tblItem").html(output);}});} function insertItem(){var id=currentItemID;var quantity=$("#qty").val();$.ajax({url:"displayitem.php",type:'POST',data:{btnMenuItemID:id,qty:quantity},success:function(output){$("#tblOrderList").append(output);$("#qtypanel").prop('hidden',true);}});$("#qty").val(1);} function setQty(id){currentItemID=id;$("#qtypanel").prop('hidden',false);} $(document).on('click','.deleteBtn',function(event){event.preventDefault();$(this).closest('tr').remove();return false;});</script>

  </body>

</html>