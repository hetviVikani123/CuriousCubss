<?php echo"

<aside id='sidebar' class='sidebar'>

<ul class='sidebar-nav' id='sidebar-nav'>

  <li class='nav-item'>
    <a class='nav-link ' href='../Admin_Dashboard/admin_Dashboard.php'>
      <i class='bi bi-grid'style='color:#855e46;::click'></i>
      <span style='color:#855e46;'>Dashboard</span>
    </a>
  </li>

  

  <li class='nav-item'>
    <a class='nav-link collapsed active' href='ManageMentor.php'>
      <i class='bi bi-person' style='color:#855e46;'></i>
      <span style='color:#855e46;'>Manage Mentors</span>
    </a>
  </li>

  <li class='nav-item'>
    <a class='nav-link collapsed' href='adminReports.php'>
      <i class='bi bi-question-circle' style='color:#855e46;'></i>
      <span style='color:#855e46;'>Reports</span>
    </a>
  </li>

  <li class='nav-item'>
    <a class='nav-link collapsed' href='./manageChild.php'>
      <i class='bi bi-envelope' style='color:#855e46;'></i>
      <span style='color:#855e46;'>Manage Child</span>
    </a>
  </li>
  <li class='nav-item'>
    <a class='nav-link collapsed' href='./add_categories.php'>
      <i class='bi bi-bookmark-plus' style='color:#855e46;'></i>
      <span style='color:#855e46;'>Add Subject Categories</span>
    </a>
  </li>
  <li class='nav-item'>
  <a class='nav-link collapsed' href='manageParent.php''>
    <i class='bi bi-envelope' style='color:#855e46;'></i>
    <span style='color:#855e46;'>Manage Parent</span>
  </a>
</li>



  
 
</ul>

</aside>
<!-- End Sidebar-->
";?> 
<html>
  <head>
    <style>
      .sidebar-nav .nav-item {
  background-color:aliceblue;
}

    </style>
  </head>
  <body>
    <script>
      $('a').click(function(){
        $('a').css('background-color',"");
        $(this).css('background-color','aliceblue');
      });
    </script>
  </body>
</html>

<!-- // <li class='nav-item'>
  //   <a class='nav-link collapsed' href='../Auth/login.php'>
  //     <i class='bi bi-box-arrow-in-right' style='color:#855e46;'></i>
  //     <span style='color:#855e46;'>Logout</span>
  //   </a>
  // </li> -->