<?php
include 'header.php';


$obj = new Varieties();

$result=$obj->get_branch_varieties($_GET['id']);
// print_r($result);die();

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper watermark_img">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Varieties</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">



						<li class="breadcrumb-item"><a href="stock.php">Stock List</a></li>
						<li class="breadcrumb-item active">Varieties List</li>


					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid"> 

			<!-- Main row -->
			<div class="row">
				<div class="col-12">
					<div class="card">

						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>

									<tr>
										<th>S.No</th>
										<th>Name</th>
										<th>Quantity</th>
										<!-- <th>Mrp</th>
										<th>Sale Price</th>
 -->

									</tr>

								</thead>
								<tbody>

									<?php 
									$i=0;
									$total_qty=0;
									$total_mrp=0;
									$total_sale=0;
									foreach ($result as $key => $value) {
										// $result2 = $obj->get_variety($value['id']);



										$i++;

										echo "<tr><td>".$i."</td>
										<td>".$value['name']."</td>";


										if ($value['qty']==" " || $value['qty']==0) {
											$null="0";
											echo "<td>".$null."</td>";
										}else{

											echo "<td>".$value['qty']."</td>";
										}
										// echo " <td>".$result2[0]['mrp']."</td>

										// <td>".$result2[0]['sales_price']."</td>
										// </tr>";
										$total_qty+=$value['qty'];
										// $total_mrp+=$result2[0]['mrp'];
										// $total_sale+=$result2[0]['sales_price'];

									}

									



									?>
									<tfoot>  
          <?php echo "<tr><td colspan='1'></td><td><b>Total</b></td><td>".$total_qty."</td>
         
          </tr>";
          ?> 
         </tfoot>






								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
			</div>
			<!-- /.row (main row) -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
  <!-- <div class="modal fade" id="order_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
             
            </div>
          </div>

        </div>
 
       </div> -->


       <?php 
       include 'footer.php';
       ?>
       <script type="text/javascript">
       	$(function () {
       		$("#example1").DataTable({
       			"responsive": true, "lengthChange": false, "autoWidth": false,
       			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
       		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
       	});
       </script>
       
