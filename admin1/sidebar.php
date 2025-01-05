 <!-- Main Sidebar Container -->
 <?php

  $query = getdata("SELECT * FROM basic_setup");
  $data = mysqli_fetch_assoc($query);
  ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="assets/img/<?= $data['icon'] ?>" rel="icon">
   <link href="assets/img/<?= $data['icon'] ?>" rel="apple-touch-icon">
 </head>

 <body class="hold-transition sidebar-mini">
   <div class="wrapper">
     <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position:fixed; margin-left:-2px;">
       <!-- Brand Logo -->
       <span class="brand-link">
         <img src="../assets/img/<?= $data['icon'] ?>" alt="Portfolio Logo" class="brand-image img-circle elevation-3 " style="opacity: .8">
         <span class="brand-text font-weight-light"><b><?= $data['title'] ?></b></span>
       </span>

       <!-- Sidebar -->
       <div class="sidebar">
         <!-- Sidebar user panel (optional) -->


         <!-- SidebarSearch Form -->
         <div class="form-inline">
           <div class="input-group" data-widget="sidebar-search">
             <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
             <div class="input-group-append">
               <button class="btn btn-sidebar">
                 <i class="fas fa-search fa-fw"></i>
               </button>
             </div>
           </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
           <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
             <li class="nav-item menu-open">
               <a href="#" class="nav-link active">
                 <i class="nav-icon fas fa-tachometer-alt"></i>
                 <p>
                   Edit Pages
                   <i class="right fas fa-angle-left"></i>
                 </p>
               </a>
               <ul class="nav nav-treeview">
                 <li class="nav-item">
                   <a href="home.php" class="nav-link active">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Edit Home</p>
                   </a>
                 </li>
                 <li class="nav-item">
                   <a href="about.php" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Edit About</p>
                   </a>
                 </li>

                 <li class="nav-item">
                   <a href="resume.php" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Edit Resume</p>
                   </a>
                 </li>

                 <li class="nav-item">
                   <a href="portfolio.php" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Edit Portfolio</p>
                   </a>
                 </li>

                 <li class="nav-item">
                   <a href="seo.php" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Edit SEO</p>
                   </a>
                 </li>
               </ul>
             </li>

             <li class="nav-item">
               <a href="contact.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Contacts</p>
               </a>
             </li>
           </ul>
           </li>

           </ul>
           </li>
           </ul>
         </nav>
         <!-- /.sidebar-menu -->
       </div>
       <!-- /.sidebar -->
     </aside>

     <!-- Control Sidebar -->
     <aside class="control-sidebar control-sidebar-dark">
       <!-- Control sidebar content goes here -->
       <div class="p-3">
         <h5>Title</h5>
         <p>Sidebar content</p>
       </div>
     </aside>
     <!-- /.control-sidebar -->

 </html>