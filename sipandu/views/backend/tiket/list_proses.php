<?php $this->load->view("backend/includes/header"); ?>
	<!-- [ breadcrumb ] start -->
	<div class="page-header">
		<div class="page-block">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-title">
						<h5 class="m-b-20"><i class="feather icon-message-circle"></i> Hai BGP</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- [ breadcrumb ] end -->
	<?php $this->load->view("backend/tiket/menu"); ?>

	<div class="main-body">
		<div class="page-wrapper">
			<!-- [ Main Content ] start -->
			<div class="row">
				<div class="col-md-12">										
					<?php
						$user = $_SESSION["user"];
					
						$conditions = array(
							array(
								"field" => "user_id",
								"operator" => "=",
								"value" => $user["id"]
							),
							array(
								"field" => "status",
								"operator" => "=",
								"value" => "1"
							)
						);
					
						$this->bootgrid->setTable("tiket", $conditions);
						$this->bootgrid->setTitle("TIKET PROSES");
						$this->bootgrid->sortBy('tiket.feedback');
						$this->bootgrid->sortType('DESC');
						$this->bootgrid->setTableJoin('guest');
						$this->bootgrid->setTableJoinType('LEFT JOIN');
						$this->bootgrid->setTableJoinCondition('tiket.guest_id = guest.id');

						$columns = array();
						$columns[] = array(
							"id" => "autonumeric",
							"field" => "autonumeric",
							"name" => "No",
							"type" => "autonumeric",
							"width" => "25px",
							"visible" => "true"
						);
						$columns[] = array(
							"id" => "no",
							"field" => "no",
							"name" => "Tiket"
						);
						$columns[] = array(
							"id" => "nama",
							"field" => "guest.nama",
							"name" => "Nama"
						);
						$columns[] = array(
							"id" => "unit_kerja",
							"field" => "guest.unit_kerja",
							"name" => "Unit Kerja",
							"visible" => "false"
						);
						$columns[] = array(
							"id" => "judul",
							"field" => "judul",
							"name" => "Judul"
						);
						
					
						$columns[] = array(
							"id" => "feedback",
							"field" => "feedback",
							"name" => "Feedback",
							"format" => "feedback"
						);
						
						$columns[] = array(
							"id" => "feedback_tgl",
							"field" => "feedback_tgl",
							"name" => "Tanggal Feedback",
							"format" => "date",
							"date" => array(
								"format" => "d M Y H:i a"
							)
						);
					
					
						$columns[] = array(
							"id" => "tanggapi",
							"field" => "tiket.id",
							"name" => "Aksi",
							"format" => "button",
							"button" => array(
								"text" => "<i class='fas fa-comments'></i>Tanggapi"
							),
							"link" => array(
								"url" => "/admin/tiket/detail/{{tiket__id}}"
							)
						);

						$this->bootgrid->setColumns($columns);

						$this->bootgrid->setRowCount('-1');

						print $this->bootgrid->render();
					?>
				</div>
			</div>
			<!-- [ Main Content ] end -->
		</div>
	</div>
<?php $this->load->view("backend/includes/footer"); ?>
