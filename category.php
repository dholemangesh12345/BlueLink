<?php
    include 'header.php';
    $Cid = $_GET["Cid"];
?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <h2 class="page-heading">Posts By Category</h2>
                    <?php
                        #-------------Pagination-------------#
                        $limit = 10;
                        if(isset($_GET['page'])){
                            $page = $_GET['page'];
                        }else{
                            $page = 1;
                        }
                        $offset = ($page - 1) * $limit;
                        #-------------Pagination-------------#
                        $sql_query = "SELECT * FROM postsdata JOIN usersdata ON Pcreator = Uid JOIN categoriesdata ON Pcategory = Cid WHERE Pcategory = {$Cid} ORDER BY Pcreationdt DESC LIMIT {$offset}, {$limit};";
                        $result = mysqli_query($conn, $sql_query) OR die("Query Failed");
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                              <a href="single.php?Pid=<?php echo $row["Pid"]; ?>">
                                <img class="post-img" src="admin/upload/<?php echo $row["Pimg"]; ?>" alt="Image"/>
                              </a>
                            </div>
                            <div class="col-md-8">
                              <div class="inner-content clearfix">
                                  <h3><a href='single.php?Pid=<?php echo $row["Pid"]; ?>'>
                                      <?php echo $row["Ptitle"]?>
                                  </a></h3>
                                  <div class="post-information">
                                      <span>
                                          <i class="fa fa-tags" aria-hidden="true"></i>
                                          <a href='category.php?Cid=<?php echo $row["Cid"]; ?>'><?php echo $row["Cname"]; ?></a>
                                      </span>
                                      <span>
                                          <i class="fa fa-user" aria-hidden="true"></i>
                                          <a href='user.php?Uid=<?php echo $row["Uid"]; ?>'><?php echo $row["Uname"]; ?></a>
                                      </span>
                                      <span>
                                          <i class="fa fa-calendar" aria-hidden="true"></i>
                                          <?php echo $row["Pcreationdt"]; ?>
                                      </span>
                                  </div>
                                  <p class="description">
                                    <?php echo substr($row["Pdescription"], 0, 200) . "..."; ?>
                                  </p>
                                  <a class='read-more pull-right' href='single.php?Pid=<?php echo $row["Pid"]; ?>'>read more</a>
                              </div>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        } else {
                          echo "<h2>No Posts Found.</h2>";
                        }
                        #-------------Pagination-------------#
                        $sql_query_pagination= "SELECT Pid FROM postsdata WHERE Pcategory = {$Cid}";
                        $result_pagination = mysqli_query($conn, $sql_query_pagination) or die("Query Failed.");
                        if(mysqli_num_rows($result_pagination) > 0){
                            $total_records = mysqli_num_rows($result_pagination);
                            $total_pages = ceil($total_records / $limit);
                            echo '<ul class="pagination admin-pagination">';
                            if($page > 1){
                                echo '<li><a href="category.php?Cid='.$Cid.'&page='.($page-1).'">Prev</a></li>';
                            }
                            for($i = 1; $i <= $total_pages; $i++){
                                if($i == $page){
                                    $active = "active";
                                }else{
                                    $active = "";
                                }
                                echo '<li class="'.$active.'"><a href="category.php?Cid='.$Cid.'&page='.$i.'">'.$i.'</a></li>';
                            }
                            if($total_pages > $page){
                                echo '<li><a href="category.php?Cid='.$Cid.'&page='.($page + 1).'">Next</a></li>';
                            }
                            echo '</ul>';
                        }
                        #-------------Pagination-------------#
                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
