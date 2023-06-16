<?php
  include 'header.php';
  include 'config.php';
  $Pid = $_GET["Pid"];
?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php
                        $sql_query = "SELECT * FROM postsdata JOIN usersdata ON Pcreator = Uid JOIN categoriesdata ON Pcategory = Cid WHERE Pid = {$Pid};";
                        $result = mysqli_query($conn, $sql_query);
                        $row = mysqli_fetch_assoc($result);
                    ?>
                    <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $row["Ptitle"]; ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?Cid=<?php echo $row["Pcategory"]; ?>'><?php echo $row["Cname"]; ?></a>
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
                            <img class="single-feature-image" src="admin/upload/<?php echo $row["Pimg"]; ?>" alt="Image"/>
                            <p class="description">
                                <?php echo $row["Pdescription"]; ?>
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
                    <!-------------Answers-------------->
                    <div class="post-container">
                      <div class="post-content single-post">
                            <h3>Solutions</h3>
                      </div>
                    <?php
                        $sql_query = "SELECT * FROM solutionsdata JOIN usersdata ON Screator = Uid WHERE Spid = {$Pid};";
                        $result = mysqli_query($conn, $sql_query) OR die("Query Failed");
                        if(mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">                                
                                  <img class="post-img" src="admin/upload/<?php echo $row["Simg"]; ?>" alt=""/>
                                </div>
                                <div class="col-md-8">
                                  <div class="inner-content clearfix">
                                      <div class="post-information">
                                          <span>
                                              <i class="fa fa-user" aria-hidden="true"></i>
                                              <a href='author.php?Uid=<?php echo $row["Uid"]; ?>'>
                                                  <?php echo $row["Uname"]; ?>
                                              </a>
                                          </span>
                                          <span>
                                              <i class="fa fa-calendar" aria-hidden="true"></i>
                                                  <?php echo $row["Screationdt"]; ?>
                                          </span>
                                      </div>
                                      <p class="description">
                                         <?php
                                              $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                                              $text = $row["Sdescription"];
                                              if(preg_match($reg_exUrl, $text, $url)) {
                                                  echo preg_replace($reg_exUrl, "<a href='{$url[0]}''><strong>{$url[0]}</strong></a> ", $text);
                                              } else {
                                                  echo $text;
                                              }
                                          ?>
                                      </p>
                                  </div>
                                </div>
                            </div>
                        </div>
                    <?php
                            }
                        } else {
                            echo "<h2>No Solutions Found.</h2>";
                        }
                    ?>
                    </div>
                    <!-------------/Answers-------------->
                    <!----------Post_solution_container--------->
                    <?php
                        if(isset($_SESSION["username"])){
                    ?>
                    <form style="margin-bottom: 30px;" action="save-solution-post.php" method="POST" enctype="multipart/form-data">
                      <div class="post-content single-post">
                            <h3>Post Solutions</h3>
                      </div>
                      <div class="form-group">
                          <input type="hidden" name="Pid" class="form-control" value="<?php echo $Pid; ?>" placeholder="">
                      </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea name="Sdescription" class="form-control" rows="5" required></textarea>
                        </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="Simg">
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required/>
                    </form>
                    <?php
                        }
                    ?>
                    <!----------/Post_solution_container--------->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
