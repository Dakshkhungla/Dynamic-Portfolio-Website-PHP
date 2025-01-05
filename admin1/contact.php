<?php
include('header.php');
include('sidebar.php');
$msg = null;
if (isset($_POST['del'])) {
  getdata("delete from contact where id='" . $_POST['id'] . "'");
  $msg = "Successfully Deleted !";
}

if ($msg != null) {
?>
  <div class="alert alert-success text-center" role="alert">
    <?php echo $msg; ?>
  </div>
<?php
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User Messages & Querys</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>Sr. No</th>
            <th>Name</th>
            <th>Subject</th>
            <th>Email</th>
            <th>Message</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $queryrun = getdata("SELECT * FROM contact");
          $count = 0;
          while ($data = mysqli_fetch_array($queryrun)) {
          ?>
            <tr>
              <td>#<?= $count + 1 ?></td>
              <td><?= $data['cname'] ?></td>
              <td><?= $data['csubject'] ?></td>
              <td><?= $data['cemail'] ?></td>
              <td><?= $data['cmessage'] ?></td>
              <form action="<?PHP $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="hidden" value="<?php echo $data['id'] ?>" name="id">
                <td> <button type="submit" name="del" class="btn btn-danger btn-sm">
                    Delete
                  </button></td>
            </tr>
            </form>
          <?php
            $count++;
          }
          if ($count == 0) { ?>
            <td colspan="6" align="center"> Currenty There Is No Messages or Queries !</td>
          <?php }
          ?>

        </tbody>
      </table>
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->