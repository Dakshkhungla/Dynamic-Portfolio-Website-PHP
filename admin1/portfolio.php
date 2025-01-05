<?php
include('header.php');
include('sidebar.php');
include('checkupload.php');
$msg = null;

$result = getdata("select * from portfolio");
$data = mysqli_fetch_assoc($result);
$pdone = "";
$target_dir = "../assets/img/";



if ((isset($_POST['insert'])) or (isset($_POST['update']))) {
  $projectpic = $_FILES['projectpic']['name'];
  if ($projectpic == "") {
    $projectpic = $data['projectpic'];
  } else {
    $pdone = Upload($_FILES['projectpic'], $target_dir);
  }
}

if (strpos($pdone, "error") !== false) {
  echo "<script>window.alert('Invalid Image Format...');</script>";
} else {
  if (isset($_POST['insert'])) {
    getdata("INSERT INTO portfolio (projectname,projectpic,projectlink) values ('" . $_POST['projectname'] . "','$projectpic','" . $_POST['projectlink'] . "')");
    $msg = "Successfully Added !";
  } else if (isset($_POST['update'])) {
    getdata("update portfolio set projectname='" . $_POST['projectname'] . "',projectpic='$projectpic',projectlink='" . $_POST['projectlink'] . "'  where id='" . $_POST['id'] . "'");
    $msg = "Successfully Updated !";
  }
}

if (isset($_POST['del'])) {
  getdata("delete from portfolio where id='" . $_POST['id'] . "'");
  $msg = "Successfully Deleted !";
}

$result = getdata("select * from portfolio");
$data = mysqli_fetch_assoc($result);

if ($msg != null) {
  echo "<script>window.alert('$msg');</script>";
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Portfolio Section</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <input type="button" name="insert" id="insert" class="btn btn-primary form-control" value="Add To Portfolio" data-target="#mymodal" data-toggle="modal">
  </div>
  <br><br>

  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>Sr No.</th>
        <th>Project Image</th>
        <th>Project Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $queryrun2 = getdata("SELECT * FROM portfolio");
      $count = 1;
      while ($data2 = mysqli_fetch_array($queryrun2)) {
      ?>
        <tr>
          <td><?= $count ?></td>
          <td><img src="../assets/img/<?= $data2['projectpic'] ?>" class="oo img-thumbnail" style="height:270px; width:300px;"></td>
          <td><?= $data2['projectname'] ?></td>
          <td>
            <button type="button" class="btn btn-primary btn-sm editBtn" data-toggle="modal" data-target="#mymodal" data-id="<?= $data2['id'] ?>" data-projectname="<?= $data2['projectname'] ?>" data-projectlink="<?= $data2['projectlink'] ?>" data-projectpic="<?= $data2['projectpic'] ?>">
              Edit
            </button>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
              <input type="hidden" value="<?php echo $data2['id'] ?>" name="id">
              <button type="submit" name="del" class="btn btn-danger btn-sm">
                Delete
              </button>
            </form>
          </td>
        </tr>
      <?php $count++;
      } ?>
    </tbody>
  </table>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Edit Portfolio</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" autocomplete="off">
          <input type="hidden" name="id" id="edit-id">
          <div class="form-row">
            <div class="form-group col-md-12">
              <img id="edit-image" class="oo img-thumbnail" style="height:300px; width:370px; margin-top:-25px">
            </div>
            <div class="form-group col-md-6">
              <div class="custom-file">
                <input type="file" name="projectpic" class="custom-file-input" id="profilepic" accept="image/png, image/PNG, image/jpeg , image/JPEG , image/jfif ,image/JFIF">
                <label class="custom-file-label" for="projectpic">Choose Pic...</label>
              </div>
            </div>

            <div class="form-group col-md-6 mt-auto">
              <label for="name">Project Name</label>
              <input type="text" name="projectname" required id="edit-projectname" class="form-control" placeholder="ToDo List Maker">
            </div>

            <div class="form-group col-md-12">
              <label for="email">Project Link</label>
              <input type="text" name="projectlink" id="edit-projectlink" class="form-control" placeholder="www.google.com">
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" id="submitButton" name="insert" value="Save">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    function clearModal() {
      $('#edit-id').val('');
      $('#edit-projectname').val('');
      $('#edit-projectlink').val('');
      $('#edit-image').attr('src', '').hide();
      $('#profilepic').val('');
      $('.custom-file-label').html('Choose Pic...');
      $('#submitButton').attr('name', 'insert');
      $('.modal-title').text('Add Portfolio');
    }

    $('.editBtn').click(function() {
      $('#edit-id').val($(this).data('id'));
      $('#edit-projectname').val($(this).data('projectname'));
      $('#edit-projectlink').val($(this).data('projectlink'));
      var imageSrc = "../assets/img/" + $(this).data('projectpic');
      $('#edit-image').attr('src', imageSrc).show();
      $('#submitButton').attr('name', 'update');
      $('.modal-title').text('Edit Portfolio');
    });


    $('#mymodal').on('hidden.bs.modal', function() {
      clearModal();
    });

    $('#mymodal').on('shown.bs.modal', function() {
      var modalHeight = $('#mymodal .modal-dialog').height();
      var imageHeight = Math.min(200, modalHeight - 200);
      $('#edit-image').css('max-height', imageHeight + 'px');
    });

    $('#insert').click(function() {
      clearModal();
    });
  });
</script>