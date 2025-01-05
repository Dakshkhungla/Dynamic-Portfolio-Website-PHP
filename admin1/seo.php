<?php
include('header.php');
include('sidebar.php');
include('checkupload.php');

$query = getdata("SELECT * FROM basic_setup");
$data = mysqli_fetch_assoc($query);
$pdone = "";
if (isset($_GET['msg'])) {

  if ($_GET['msg'] == 'updated') {
?>
    <div class="alert alert-success text-center" role="alert">
      Successfully Updated !
    </div>
  <?php
  }
  if ($_GET['msg'] == 'error') {
  ?>
    <div class="alert alert-danger text-center" role="alert">
      something wrong with your image please check type or size !
    </div>
<?php
  }
}


if (isset($_POST['update'])) {

  $target_dir = "../assets/img/";
  $siteicon = $_FILES['siteicon']['name'];
  if ($siteicon == "") {
    $siteicon = $data['icon'];
  } else {
    $pdone = Upload($_FILES['siteicon'], $target_dir);
  }

  if (strpos($pdone, "error") !== false) {
    echo "<script>window.alert('Invalid Image Format...');</script>";
  } else {
    getdata("update basic_setup set icon='$siteicon',title='" . $_POST['title'] . "',keyword='" . $_POST['keyword'] . "',description='" . $_POST['description'] . "' where id='1' ");
    echo "<script>window.alert('Data Updated!!  ');</script>";
    $query = getdata("SELECT * FROM basic_setup");
    $data = mysqli_fetch_assoc($query);
  }
}
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit SEO Section</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group col-md-12">
          <img src="../assets/img/<?= $data['icon'] ?>" class="img-thumbnail ooo" style="height:300px; width:370px; margin-top:-25px">
        </div>

        <div class="form-group col-md-6">
          <div class="custom-file">

            <input type="file" name="siteicon" class="custom-file-input" accept="image/*" id="profilepic">
            <label class="custom-file-label" for="projectpic">Choose Pic...</label>
          </div>
        </div>

        <div class="form-group col-md-6 mt-auto">
          <label for="name">Website Title</label>
          <input type="name" name="title" value="<?= $data['title'] ?>" class="form-control" id="name" placeholder="ABC">
        </div>



        <div class="form-group col-md-12">
          <label for="email">Keywords (Seperate with ',' comma)</label>
          <input type="text" name="keyword" value="<?= $data['keyword'] ?>" class="form-control" id="email" placeholder="web developer,php developer,graphic designer,freelancer">
        </div>
        <div class="form-group col-md-12">
          <label for="email">Site Description (160 Characters recommended)</label>
          <input type="text" value="<?= $data['description'] ?>" name="description" class="form-control" id="email" placeholder="this is portfolio website">
        </div>
        <div class="form-group ml-auto">
          <input type="submit" name="update" class="btn btn-primary" value="Update">
        </div>

      </div>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->