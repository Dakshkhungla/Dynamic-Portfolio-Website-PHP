<?php
include('header.php');
include('sidebar.php');
$msg = null;

// Check if the form has been submitted for insertion or updating
if (isset($_POST['save'])) {
  // For insertion
  getdata("INSERT INTO resume(category,ogname,title,workdesc,year) VALUES ('" . $_POST['category'] . "','" . $_POST['ogname'] . "','" . $_POST['title'] . "','" . $_POST['workdesc'] . "','" . $_POST['year'] . "')");
  $msg = "Successfully Added !";
} else if (isset($_POST['update'])) {
  // For updating
  getdata("UPDATE resume SET category='" . $_POST['category'] . "',ogname='" . $_POST['ogname'] . "',title='" . $_POST['title'] . "',workdesc='" . $_POST['workdesc'] . "',year='" . $_POST['year'] . "' WHERE id='" . $_POST['id'] . "'");
  $msg = "Successfully Updated !";
}

if (isset($_POST['del'])) {
  getdata("delete from resume where id='" . $_POST['id'] . "'");
  $msg = "Successfully Deleted!";
}

$result = getdata("SELECT * FROM resume");

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
          <h1 class="m-0">Edit Resume Page</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <input type="button" name="insert" id="insert" class="btn btn-primary form-control" value="Add To Resume" data-target="#mymodal" data-toggle="modal">
  </div>
  <br>
  <br>
  <table id="rlist" class="table table-striped table-sm .table-responsive ">
    <thead>
      <tr>
        <th>Category</th>
        <th>Course/Position</th>
        <th>Duration</th>
        <th>Institution/Company</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $cat;
      while ($row = mysqli_fetch_assoc($result)) {
        if ($row['category'] == "e") {
          $cat = "Education";
        } else {
          $cat = "Professional Experience";
        }
      ?>
        <tr>
          <td><?php echo $cat ?></td>
          <td><?php echo $row['title'] ?></td>
          <td><?php echo  $row['year'] ?></td>
          <td><?php echo $row['ogname'] ?></td>
          <td>
            <button type="button" name="edit" class="btn btn-primary btn-sm editBtn" data-target="#mymodal" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-category="<?php echo $row['category']; ?>" data-title="<?php echo $row['title']; ?>" data-ogname="<?php echo $row['ogname']; ?>" data-year="<?php echo $row['year']; ?>" data-workdesc="<?php echo $row['workdesc']; ?>"> Edit</button>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" style="display:inline;">
              <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
              <button type="submit" name="del" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Resume</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="resumeForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
          <input type="hidden" name="id" id="edit-id">
          <div class="form-group">
            <label for="category">Select Category</label>
            <select name="category" id="category" class="form-control">
              <option value="e">Education</option>
              <option value="pe">Professional Experience</option>
            </select>
          </div>
          <div class="form-group">
            <label for="title">Course/Position Name</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>
          <div class="form-group">
            <label for="ogname">Institute or Company Name</label>
            <input type="text" class="form-control" id="ogname" name="ogname" required>
          </div>
          <div class="form-group">
            <label for="year">Duration or Time Period</label>
            <input type="text" class="form-control" id="year" name="year" required>
          </div>
          <div class="form-group">
            <label for="workdesc">Description (Optional)</label>
            <textarea class="form-control" id="workdesc" name="workdesc" rows="3"></textarea>
          </div>
          <button type="submit" id="submitButton" name="save" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  // JavaScript to handle modal behavior
  $(document).ready(function() {
    // Function to clear modal fields
    function clearModal() {
      $('#edit-id').val('');
      $('#category').val('e'); // Default category to "Education"
      $('#title').val('');
      $('#ogname').val('');
      $('#year').val('');
      $('#workdesc').val('');
      $('#submitButton').attr('name', 'save'); // Change submit button name to "save" for insertion
      $('.modal-title').text('Add To Resume'); // Change modal title
    }

    // Function to populate modal fields for editing
    $('.editBtn').click(function() {
      $('#edit-id').val($(this).data('id'));
      $('#category').val($(this).data('category'));
      $('#title').val($(this).data('title'));
      $('#ogname').val($(this).data('ogname'));
      $('#year').val($(this).data('year'));
      $('#workdesc').val($(this).data('workdesc'));
      $('#submitButton').attr('name', 'update'); // Change submit button name to "update" for updating
      $('.modal-title').text('Edit Resume'); // Change modal title
    });

    // Function to clear modal fields when modal is shown (for insertion)
    $('#insert').click(function() {
      clearModal();
    });

  });
</script>