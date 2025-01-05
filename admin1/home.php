<?php
include('checkupload.php');
include('header.php');
include('sidebar.php');

$result = getdata("SELECT * FROM personal_setup");
$data = mysqli_fetch_array($result);

$target_dir = "../assets/img/";
$pdone = $cdone = "";
if (isset($_POST['save'])) {
  $target_dir = "../assets/img/"; // Define your target directory
  $profilepic = $_FILES['profile']['name'];
  $homewallpaper = $_FILES['cover']['name'];

  if ($profilepic == "") {
    $profilepic = $data['profilepic'];
  } else {
    $pdone = Upload($_FILES['profile'], $target_dir);
  }

  if ($homewallpaper == "") {
    $homewallpaper = $data['homewallpaper'];
  } else {
    $cdone = Upload($_FILES['cover'], $target_dir);
  }

  if (strpos($cdone, "error") !== false || strpos($pdone, "error") !== false) {
    echo "<script>window.alert('Invalid Image Format...');</script>";
  } else {
    getdata("UPDATE personal_setup SET profilepic='$profilepic',name='" . $_POST['name'] . "',twitter='" . $_POST['twitter'] . "',facebook='" . $_POST['facebook'] . "',instagram='" . $_POST['instagram'] . "',linkedin='" . $_POST['linkedin'] . "',github='" . $_POST['github'] . "',homewallpaper='$homewallpaper',professions='" . $_POST['profession'] . "',location='" . $_POST['address'] . "',mobile='" . $_POST['mobile'] . "',emailid='" . $_POST['email'] . "' WHERE id=1");

    // Fetch updated data
    $result = getdata("SELECT * FROM personal_setup");
    $data = mysqli_fetch_array($result);
    echo "<script>window.alert('Successfully Submitted!')</script>";
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
          <h2>Edit Home Section</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->

  <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" autocomplete="off">
    <div class="form-row">
      <div class="form-group col-md-6">
        <img src="../assets/img/<?= $data['profilepic'] ?>" class="oo img-thumbnail" style="height:340px; width:370px; margin-top:-25px"><br>
        <div class="custom-file">
          <input type="file" name="profile" class="custom-file-input" id="profilepic">
          <label class="custom-file-label" for="profilepic">Choose Profile Pic...</label>
        </div>
      </div>
      <div class="form-group col-md-6">
        <img src="../assets/img/<?= $data['homewallpaper'] ?>" class="oo img-thumbnail" style="height:340px; width:370px; margin-top:-25px">
        <div class="custom-file">
          <input type="file" name="cover" class="custom-file-input" id="profilepic">
          <label class="custom-file-label" for="profilepic">Choose Home Cover...</label>
        </div>
      </div>

      <div class="form-group col-md-6">
        <label for="name">Name</label>
        <input type="name" name="name" value="<?= $data['name'] ?>" pattern="[a-zA-Z\s]+" class="form-control" id="name" placeholder="abc" required>
      </div>

      <div class="form-gr oup col-md-6">
        <label for="email">Email</label>
        <input type="email" name="email" value="<?= $data['emailid'] ?>" required class="form-control" id="email" placeholder="abc@gmail.com">
      </div>
      <div class="form-group col-md-6">
        <label for="twitter">Twitter</label>
        <input type="text" class="form-control" value="<?= $data['twitter'] ?>" name="twitter" id="twitter" placeholder="https://twitter.com/abc">
      </div>

      <div class="form-group col-md-6">
        <label for="facebook">Facebook</label>
        <input type="text" class="form-control" value="<?= $data['facebook'] ?>" name="facebook" id="facebook" placeholder="https://facebook.com/abc">
      </div>

      <div class="form-group col-md-6">
        <label for="instagram">Instagram</label>
        <input type="text" class="form-control" value="<?= $data['instagram'] ?>" name="instagram" id="instagram" placeholder="https://instagram.com/abc">
      </div>

      <div class="form-group col-md-6">
        <label for="linkedin">Linkedin</label>
        <input type="text" class="form-control" value="<?= $data['linkedin'] ?>" name="linkedin" id="linkedin" placeholder="https://linkedin.com/abc">
      </div>
      <div class="form-group col-md-6">
        <label for="github">Github</label>
        <input type="text" class="form-control" value="<?= $data['github'] ?>" name="github" id="github" placeholder="https://github.com/abc">
      </div>

      <div class="form-group col-md-3">
        <label for="mobile">Mobile No</label>
        <input type="text" class="form-control" value="<?= $data['mobile'] ?>" pattern="[0-9]{10}" required name="mobile" id="mobile" placeholder="+919999999999">
      </div>

    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" name="address" value="<?= $data['location'] ?>" class="form-control" id="address" placeholder="XYZ Colony">
    </div>
    <div class="form-row">
      <div class="form-group col-md-9">
        <label for="profession">Proffesion Titles (Separate with ',' comma)</label>
        <input type="text" class="form-control" name="profession" value="<?= $data['professions'] ?>" id="profession" placeholder="Web Developer,PHP Developer,Graphic Designer">
      </div>

    </div>
    <input type="submit" name="save" class="btn btn-primary" value="Save Changes">
  </form>
</div>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->