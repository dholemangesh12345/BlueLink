<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
              <?php
                  $Uid = $_GET["Uid"];
                  $sql_query = "SELECT Uimg, Uname, Uage, Ucreationdt FROM usersdata WHERE Uid = {$Uid} AND Uprivate = 0;";
                  $result = mysqli_query($conn, $sql_query) OR die("Query Failed");
                  if(mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
              ?>
              <div class="post-container">
                  <div class="post-content single-post">
                      <img class="single-feature-image" src="admin/upload/<?php echo $row["Uimg"]; ?>" alt="Image"/>
                      <div class="profile-information">
                          <h3><?php echo $row["Uname"]; ?></h3>
                          <h4>Age : <?php echo $row["Uage"]; ?></h4>
                          <h4>Account created on : <?php echo $row["Ucreationdt"]; ?></h4>
                      </div>
                  </div>
              </div>
              <div style="min-height: auto;" id="admin-content">
              <div class="col-md-12">
              <div class="col-md-12">
                  <h1 style="font-size: 20px; " class="admin-heading">All Posts by <?php echo $row["Uname"]; ?></h1>
              </div>
              <table class="content-table">
                  <thead>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date Time</th>
                    <th>Link</th>
                  </thead>
                      <tbody>
                        <?php
                            $query = "SELECT * FROM postsdata
                            JOIN categoriesdata On Pcategory = Cid
                            WHERE Pcreator = {$Uid}
                            ORDER BY Pcreationdt DESC;";
                            $result = mysqli_query($conn, $query) OR die("Query Failed");
                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                        ?>
                          <tr>
                            <td><?php echo $row["Pid"]; ?></td>
                            <td><?php echo $row["Ptitle"]; ?></td>
                            <td><?php echo $row["Cname"]; ?></td>
                            <td><?php echo $row["Pcreationdt"]; ?></td>
                            <td><a href="single.php?Pid=<?php echo $row["Pid"]; ?>">Link</a></td>
                          </tr>
                        <?php
                                }
                            }
                        ?>
                      </tbody>
              </table>
            </div>
          </div>
        <?php
          } else {
        ?>
          <div class="post-container">
              <div class="post-content single-post">
                  <img class="single-feature-image" src="admin/upload/User.jpeg" alt="Image"/>
                  <h3 style="text-align: center;" >This Account is Private</h3>
              </div>
          </div>
        <?php
          }
        ?>
        </div>
        <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>