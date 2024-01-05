<?php $this->load->view("backend/includes/header"); ?>
	<!-- [ breadcrumb ] start -->
	<div class="page-header">
		<div class="page-block">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-title">
						<h5 class="m-b-20"><i class="feather icon-user"></i> Master Admin</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- [ breadcrumb ] end -->

	<div class="main-body">
		<div class="page-wrapper">
			<!-- [ Main Content ] start -->
			<div class="row">
				<div class="col-md-12">										
					<?php
						$this->bootgrid->setTable("user");
						$this->bootgrid->setTitle("MASTER ADMIN");

						$columns = array();
						$columns[] = array(
							"id" => "id",
							"field" => "id",
							"name" => "ID",
							"type" => "numeric",
							"width" => "25px",
							"identifier" => "true",
							"visible" => "false"
						);
						$columns[] = array(
							"id" => "autonumeric",
							"field" => "autonumeric",
							"name" => "No",
							"type" => "autonumeric",
							"width" => "25px",
							"visible" => "true"
						);
						$columns[] = array(
							"id" => "username",
							"field" => "username",
							"name" => "Username"
						);
						$columns[] = array(
							"id" => "nama",
							"field" => "nama",
							"name" => "Nama"
						);
						$columns[] = array(
							"id" => "sync_biodata",
							"field" => "sync_biodata",
							"name" => "Sync Biodata",
							"format" => "sync_biodata"
						);
						$columns[] = array(
							"id" => "dibuat_tgl",
							"field" => "dibuat_tgl",
							"name" => "Dibuat Tgl",
							"format" => "date",
							"date" => array(
								"format" => "d/m/Y H:i a"
							),
							"visible" => "false"
						);
					
						if ($this->utility->hasUserAccess("user","reset_password")) {
							$columns[] = array(
								"id" => "reset_password",
								"field" => "id",
								"name" => "Password",
								"format" => "button",
								"button" => array(
									"text" => "<i class='fa fa-lock'></i>Reset",
									"class" => "reset-password"
								),
								"modal" => array(
									"view" => "backend/user/modal_reset"
								)
							);
						}

						$this->bootgrid->setColumns($columns);
					
						if ($this->utility->hasUserAccess("user","add")) {
							$addButton = array(
								"text" => "Tambah",
								"modal" => array(
									"view" => "backend/user/modal_add"
								)
							);
							$this->bootgrid->setAddButton($addButton);	
						}
					
						if ($this->utility->hasUserAccess("user","edit")) {
							$editButton = array(
								"text" => "Edit",
								"modal" => array(
									"view" => "backend/user/modal_edit"
								)
							);
							$this->bootgrid->setEditButton($editButton);
						}
					
						if ($this->utility->hasUserAccess("user","delete")) {
							$deleteButton = array(
								"text" => "Delete"
							);
							$this->bootgrid->setDeleteButton($deleteButton);
						}

						$this->bootgrid->setRowCount('15');

						print $this->bootgrid->render();
					?>
				</div>
			</div>
			<!-- [ Main Content ] end -->
		</div>
	</div>
<?php $this->load->view("backend/includes/footer"); ?>
