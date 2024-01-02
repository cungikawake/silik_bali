<?php
	$url_1 = $this->uri->segment(2);
	$url_2 = $this->uri->segment(3);

	$showMenu = true;

	if (isset($_SESSION["menu"]) && $_SESSION["menu"]) {
		$showMenu = false;
	}
?>
<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar <?php if (!$showMenu) { print "navbar-collapsed"; } ?>">
	<div class="navbar-wrapper">
		<div class="navbar-brand header-logo">
			<a href="<?php print base_url("/admin/"); ?>" class="b-brand">
				<div class="b-bg">
				   <img src="<?php print base_url("/assets/images/logo-kemdikbud-icon.png"); ?>" />
			   </div>
			   <span class="b-title" title="Sistem Layanan Informasi dan Konsultasi BGP Provinsi Bali">SILIK BALI</span>
			</a>
			<a class="mobile-menu <?php if (!$showMenu) { print "on"; } ?>" id="mobile-collapse" href="javascript:"><span></span></a>
		</div>
		<div class="navbar-content scroll-div">
			<ul class="nav pcoded-inner-navbar">
				<li class="nav-item <?php if ($url_1 == "") print "active"; ?>">
					<a href="<?php print base_url('/admin/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
				</li>
				
				<?php if ($this->utility->hasUserAccess("kegiatan","list") || $this->utility->hasUserAccess("hai_bgp","list")) { ?>
					<li class="nav-item pcoded-menu-caption">
						<label>Layanan</label>
					</li>
				<?php } ?>
				
				<?php if ($this->utility->hasUserAccess("kegiatan","list")) { ?>
					<li class="nav-item <?php if ($url_1 == "kegiatan") print "active"; ?>">
						<a href="<?php print base_url('/admin/kegiatan/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Kegiatan</span></a>
					</li>
				<?php } ?>
				
				<?php
					if ($this->utility->hasUserAccess("hai_bgp","list")) { 
						$count = $this->notif->getNotifHAI();
						$notif = "";
						
						if ($count > 0) {
							$notif = '<span class="pcoded-badge label label-danger">'.$count.'</span>';
						}
				?>
					<li class="nav-item <?php if ($url_1 == "tiket") print "active"; ?>">
						<a href="<?php print base_url('/admin/tiket/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-message-circle"></i></span><span class="pcoded-mtext">HAI BGP</span><?php print $notif; ?></a>
					</li>
				<?php } ?>
				
				<li class="nav-item pcoded-menu-caption">
					<label>Privasi</label>
				</li>
					
				<li class="nav-item <?php if ($url_1 == "user" && $url_2 == "profile") print "active"; ?>">
					<a href="<?php print base_url('/admin/user/profile/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user-check"></i></span><span class="pcoded-mtext">Profil</span></a>
				</li>
				<li class="nav-item <?php if ($url_1 == "user" && $url_2 == "documents") print "active"; ?>">
					<a href="<?php print base_url('/admin/user/documents/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Dokumen Saya</span></a>
				</li>
				
				<?php
					$count = $this->notif->getNotifPenugasan();
					$notif = "";

					if ($count > 0) {
						$notif = '<span class="pcoded-badge label label-danger">'.$count.'</span>';
					}
				?>
				<li class="nav-item <?php if ($url_1 == "user" && $url_2 == "penugasan") print "active"; ?>">
					<a href="<?php print base_url('/admin/user/penugasan/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="fas fa-id-card"></i></span><span class="pcoded-mtext">Penugasan</span><?php print $notif; ?></a>
				</li>
					
				<?php if ($this->utility->hasUserAccess("kepegawaian","penugasan") || $this->utility->hasUserAccess("kepegawaian","apr_penugasan")) { ?>
				<li class="nav-item pcoded-menu-caption">
					<label>Kepegawaian</label>
				</li>
				<?php } ?>
				
				<?php if ($this->utility->hasUserAccess("kepegawaian","penugasan")) { ?>
				<?php
					$count = $this->notif->getNotifKepegawaianPenugasan();
					$notif = "";

					if ($count > 0) {
						$notif = '<span class="pcoded-badge label label-danger">'.$count.'</span>';
					}
				?>
				<li class="nav-item <?php if ($url_1 == "kepegawaian" && $url_2 == "penugasan") print "active"; ?>">
					<a href="<?php print base_url('/admin/kepegawaian/penugasan/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="fas fa-portrait"></i></span><span class="pcoded-mtext">Penugasan</span><?php print $notif; ?></a>
				</li>
				<?php } ?>
				
				<?php if ($this->utility->hasUserAccess("kepegawaian","apr_penugasan")) { ?>
				<?php
					$count = $this->notif->getNotifAprPenugasan();
					$notif = "";

					if ($count > 0) {
						$notif = '<span class="pcoded-badge label label-danger">'.$count.'</span>';
					}
				?>
				<li class="nav-item <?php if (($url_1 == "kepegawaian" && $url_2 == "approve_penugasan") || $url_1 == "kepegawaian" && $url_2 == "approval_penugasan") print "active"; ?>">
					<a href="<?php print base_url('/admin/kepegawaian/approve_penugasan/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-pocket"></i></span><span class="pcoded-mtext">Approval Penugasan</span><?php print $notif; ?></a>
				</li>
				<?php } ?>
				
				
				<?php if ($this->utility->hasUserAccess("spj_kegiatan","list") || $this->utility->hasUserAccess("keuangan","apr_perjadin") || $this->utility->hasUserAccess("spj","list")) { ?>
					<li class="nav-item pcoded-menu-caption">
						<label>Keuangan</label>
					</li>
				<?php } ?>
				
				<?php if ($this->utility->hasUserAccess("spj","list")) { ?>
					<li class="nav-item <?php if ($url_1 == "spj" && $url_2 == "") print "active"; ?>">
						<a href="<?php print base_url('/admin/spj/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="fas fa-piggy-bank"></i></span><span class="pcoded-mtext">SPJ Penugasan</span></a>
					</li>
				<?php } ?>
				
				<?php if ($this->utility->hasUserAccess("spj_kegiatan","list")) { ?>
					<li class="nav-item <?php if ($url_1 == "spj" && $url_2 == "kegiatan") print "active"; ?>">
						<a href="<?php print base_url('/admin/spj/kegiatan/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="fas fa-donate"></i></span><span class="pcoded-mtext">SPJ Kegiatan</span></a>
					</li>
				<?php } ?>
				
				<?php if ($this->utility->hasUserAccess("keuangan","apr_perjadin")) { ?>
					<?php
						$count = $this->notif->getNotifAprPerjadin();
						$notif = "";

						if ($count > 0) {
							$notif = '<span class="pcoded-badge label label-danger">'.$count.'</span>';
						}
					?>
					<li class="nav-item <?php if ($url_1 == "spj" && $url_2 == "approve_perjadin") print "active"; ?>">
						<a href="<?php print base_url('/admin/spj/approve_perjadin/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-pocket"></i></span><span class="pcoded-mtext">Approval Perjadin</span><?php print $notif; ?></a>
					</li>
				<?php } ?>
				
				<?php if ($this->utility->hasUserAccess("keuangan","scan_perjadin")) { ?>
					<li class="nav-item <?php if ($url_1 == "spj" && $url_2 == "scan_perjadin") print "active"; ?>">
						<a href="<?php print base_url('/admin/spj/scan_perjadin/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="fas fa-barcode"></i></span><span class="pcoded-mtext">Terima Perjadin</span></a>
					</li>
				<?php } ?>
				
				<?php /*if ($this->utility->hasUserAccess("spj_kegiatan","list")) { ?>
					<li class="nav-item <?php if ($url_1 == "spj" && $url_2 == "spj") print "active"; ?>">
						<a href="<?php print base_url('/admin/spj/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="fas fa-donate"></i></span><span class="pcoded-mtext">SPJ Kegiatan</span></a>
					</li>
				<?php }*/ ?>
				
				
				
				<?php if ($this->utility->hasUserAccess("laporan","list_penugasan")) { ?>
					<li class="nav-item pcoded-menu-caption">
						<label>Laporan</label>
					</li>
				<?php } ?>
				
				<?php if ($this->utility->hasUserAccess("laporan","list_penugasan")) { ?>
					<li class="nav-item <?php if ($url_1 == "laporan" && $url_2 == "penugasan") print "active"; ?>">
						<a href="<?php print base_url('/admin/laporan/penugasan/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Laporan Penugasan</span></a>
					</li>
				<?php } ?>
				
				
				
				<?php if ($this->utility->hasUserAccess("pengaturan","satker") || $this->utility->hasUserAccess("pengaturan","api") || $this->utility->hasUserAccess("pengaturan","pejabat") || $this->utility->hasUserAccess("pengaturan","mail") || $this->utility->hasUserAccess("template","sertifikat")) { ?>
					<li class="nav-item pcoded-menu-caption">
						<label>Pengaturan</label>
					</li>
				<?php } ?>
				
				<?php if ($this->utility->hasUserAccess("pengaturan","satker") || $this->utility->hasUserAccess("pengaturan","api") || $this->utility->hasUserAccess("pengaturan","pejabat") || $this->utility->hasUserAccess("pengaturan","mail")) { ?>
					<li class="nav-item pcoded-hasmenu <?php if ($url_1 == "pengaturan") print "active pcoded-trigger"; ?>">
						<a href="javascript:" class="nav-link "><span class="pcoded-micon">
							<i class="feather icon-settings"></i></span><span class="pcoded-mtext">Umum</span>
						</a>
						<ul class="pcoded-submenu">
							<?php if ($this->utility->hasUserAccess("pengaturan","satker")) { ?>
								<li class="<?php if ($url_1 == "pengaturan" && $url_2 == "satker") print "active"; ?>"><a href="<?php print base_url('/admin/pengaturan/satker/'); ?>" class="">Satker</a></li>
							<?php } ?>
							
							<?php if ($this->utility->hasUserAccess("pengaturan","pejabat")) { ?>
								<li class="<?php if ($url_1 == "pengaturan" && $url_2 == "pejabat") print "active"; ?>"><a href="<?php print base_url('/admin/pengaturan/pejabat/'); ?>" class="">Pejabat</a></li>
							<?php } ?>
							
							<?php if ($this->utility->hasUserAccess("pengaturan","satker")) { ?>
								<li class="<?php if ($url_1 == "pengaturan" && $url_2 == "mak") print "active"; ?>"><a href="<?php print base_url('/admin/pengaturan/mak/'); ?>" class="">Mata Anggaran</a></li>
							<?php } ?>

							<?php if ($this->utility->hasUserAccess("pengaturan","api")) { ?>
								<li class="<?php if ($url_1 == "pengaturan" && $url_2 == "api") print "active"; ?>"><a href="<?php print base_url('/admin/pengaturan/api/'); ?>" class="">API</a></li>
							<?php } ?>

							<?php if ($this->utility->hasUserAccess("pengaturan","mail")) { ?>
								<li class="<?php if ($url_1 == "pengaturan" && $url_2 == "smtp") print "active"; ?>"><a href="<?php print base_url('/admin/pengaturan/smtp/'); ?>" class="">SMTP Mail</a></li>
							<?php } ?>
						</ul>
					</li>
				<?php } ?>
				
				<?php if ($this->utility->hasUserAccess("template","sertifikat")) { ?>
					<li class="nav-item pcoded-hasmenu <?php if ($url_1 == "sertifikat") print "active pcoded-trigger"; ?>">
						<a href="javascript:" class="nav-link "><span class="pcoded-micon">
							<i class="feather icon-feather"></i></span><span class="pcoded-mtext">Template</span>
						</a>
						<ul class="pcoded-submenu">
							
							<?php if ($this->utility->hasUserAccess("template","sertifikat")) { ?>
								<li class="<?php if ($url_1 == "sertifikat") print "active"; ?>"><a href="<?php print base_url('/admin/sertifikat/'); ?>" class="">Sertifikat</a></li>
							<?php } ?>
							
						</ul>
					</li>
				<?php } ?>
				
				
				
				<?php if ($this->utility->hasUserAccess("user","list") || $this->utility->hasUserAccess("biodata","list")) { ?>
					<li class="nav-item pcoded-menu-caption"><label>Master</label></li>
				<?php } ?>
				
				<?php if ($this->utility->hasUserAccess("user","list")) { ?>
					<li class="nav-item pcoded-hasmenu <?php if (($url_1 == "user" && $url_2 == "") || $url_1 == "guest") print "active pcoded-trigger"; ?>">
						<a href="javascript:" class="nav-link "><span class="pcoded-micon">
							<i class="feather feather icon-user"></i></span><span class="pcoded-mtext">User</span>
						</a>
						<ul class="pcoded-submenu">
							<li class="<?php if ($url_1 == "user" && $url_2 == "") print "active"; ?>">
								<a href="<?php print base_url('/admin/user/'); ?>">Admin</a>
							</li>

							<li class="<?php if ($url_1 == "guest") print "active"; ?>">
								<a href="<?php print base_url('/admin/guest/'); ?>">Tamu</a>
							</li>
						</ul>
					</li>
				<?php } ?>

				<?php if ($this->utility->hasUserAccess("biodata","list")) { ?>
					<li class="nav-item <?php if ($url_1 == "biodata") print "active"; ?>">
						<a href="<?php print base_url('/admin/biodata/'); ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Biodata</span></a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>
<!-- [ navigation menu ] end -->