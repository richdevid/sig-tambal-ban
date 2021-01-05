<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('headerAdmin', $this->data);
?>
<div class="page-header">
  <h1>Home</h1>
</div>
					<p>Website ini dibangun dengan PHP (Framework Codeigniter 3), Google Maps V3 API dan Twitter bootstrap, Dibuat demi memenuhi tugas Mata Kuliah <i>Geographic Information System</i> UNESA, Dosen (<i>Ari Kurniawan, S.Kom, M.T.</i>).</p>
					<table class="table table-striped">
						<tbody>
							<tr>
								<td>Nama Pengembang</td>
								<td width="50" class="text-center">:</td>
								<td><li>Muhammad Arief Rahman I.P (17051204047)</li>
                <li>M. Ridho Wahyudi R (17051204064)</li>
                <li>Arsy Bilahil Tama (17051204066)</li>
                <li>Christopher S (17051204056)</li></td>
							</tr>
								<td>Kelas</td>
								<td width="50" class="text-center">:</td>
								<td>TI 2017 A</td>
							</tr>
						</tbody>
<?php
$this->load->view('footerAdmin', $this->data);

/* End of file main-admin.php */
/* Location: ./application/views/main-admin.php */
