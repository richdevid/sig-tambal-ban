<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('headerAdmin', $this->data);

$amenities = @explode(', ', $lokasi->amenities);
?>
<div class="page-header">
  <h1>Update Lokasi</h1>
</div>
<form class="form-horizontal" action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <?php if($this->session->flashdata('message')) : ?>
            <div class="col-sm-8 col-md-offset-2">
                <div class="form-group">
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Nama :</label>
      <div class="col-sm-8">
          <input type="text" name="name" class="form-control" value="<?php echo $lokasi->name ?>" placeholder="">
            <p class="help-block"><?php  echo form_error('name', '<small class="text-red">', '</small>'); ?></p>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Kategori :</label>
      <div class="col-sm-5">
    <?php foreach($this->db->get('categories')->result() as $key => $row) : ?>
      <div class="checkbox checkbox-info checkbox-inline">
          <input type="checkbox" value="<?php echo $row->category_id; ?>" name="categories[<?php echo $key ?>]" <?php if($this->madmin->categoryLocation($lokasi->ID, $row->category_id)) echo 'checked' ?>>
          <label> <?php echo $row->name; ?></label>
      </div>
    <?php endforeach; ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Harga Min :</label>
      <div class="col-sm-5">
          <input type="text" name="price" class="form-control" value="<?php echo $lokasi->price ?>">
            <p class="help-block"><?php  echo form_error('price', '<small class="text-red">', '</small>'); ?></p>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Harga Max :</label>
      <div class="col-sm-5">
          <input type="text" name="price2" class="form-control" value="<?php echo $lokasi->price2 ?>">
            <p class="help-block"><?php  echo form_error('price2', '<small class="text-red">', '</small>'); ?></p>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Melayani :</label>
      <div class="col-sm-9">
      <?php foreach($this->serve as $value) : ?>
        <div class="checkbox checkbox-info checkbox-inline">
            <input type="checkbox" value="<?php echo $value; ?>" name="serve[]">
            <label> <?php echo $value; ?></label>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Koordinat :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input id="input-calendar" type="text" name="latitude" class="form-control" value="<?php echo $lokasi->latitude ?>" placeholder="latitude">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('latitude', '<small class="text-red">', '</small>'); ?></p>
        </div>
        <div class="col-sm-4">
            <div class="input-group">
                <input id="input-calendar" type="text" name="longitude" class="form-control" value="<?php echo $lokasi->longitude ?>" placeholder="longitude">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('longitude', '<small class="text-red">', '</small>'); ?></p>
        </div>
        <div class="col-sm-8 col-md-offset-2">
      <?php echo $map['html'] ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Foto :</label>
        <div class="col-sm-4">
           <input type="file" name="photo" class="form-control">
        </div>
        <div class="col-md-4">
          <?php if($lokasi->photo != '') : ?>
          <img src="<?php echo base_url("public/image/{$lokasi->photo}") ?>" height="150">
        <?php endif; ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Alamat :</label>
        <div class="col-sm-8">
           <textarea name="alamat" class="form-control" rows="3"><?php echo $lokasi->address ?></textarea>
           <p class="help-block"><?php echo form_error('alamat', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>
    <div class="form-group">
    	<label class="col-sm-2 control-label">Buka :</label>
    	<div class="col-sm-8">
      		<input type="text" name="open" class="form-control" value="<?php echo $lokasi->open ?>" placeholder="07.00">
            <p class="help-block"><?php  echo form_error('open', '<small class="text-red">', '</small>'); ?></p>
    	</div>
  	</div>
    <div class="form-group">
    	<label class="col-sm-2 control-label">Tutup :</label>
    	<div class="col-sm-8">
      		<input type="text" name="close" class="form-control" value="<?php echo $lokasi->close ?>" placeholder="21.00">
            <p class="help-block"><?php  echo form_error('close', '<small class="text-red">', '</small>'); ?></p>
    	</div>
  	</div>
    <div class="form-group">
    	<label class="col-sm-2 control-label">Hari Libur :</label>
    	<div class="col-sm-8">
      		<input type="text" name="holiday" class="form-control" value="<?php echo $lokasi->holiday ?>" placeholder="">
            <p class="help-block"><?php  echo form_error('holiday', '<small class="text-red">', '</small>'); ?></p>
    	</div>
  	</div>
    <div class="form-group" style="margin-bottom: 50px;">
        <div class="col-sm-6 col-md-offset-3">
            <button type="submit" class="btn btn-lg btn-primary pull-right"><i class="fa fa-save"></i> Simpan Perubahan</button>
        </div>
    </div>
</form>
<?php
$this->load->view('footerAdmin', $this->data);


/* End of file update-lokasi.php */
/* Location: ./application/views/update-lokasi.php */
