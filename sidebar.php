<?php
  include 'config.php';
?>
<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
            $sql_query = "SELECT * FROM postsdata JOIN usersdata ON Pcreator = Uid JOIN categoriesdata ON Pcategory = Cid ORDER BY Pcreationdt DESC LIMIT 6";
            $result = mysqli_query($conn, $sql_query);
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="recent-post">
            <a class="post-img" href="single.php?Pid=<?php echo $row["Pid"];?>">
                <img src="admin/upload/<?php echo $row["Pimg"]; ?>" alt="Image"/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?Pid=<?php echo $row["Pid"];?>"></a><?php echo $row["Ptitle"]; ?></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?Cid=<?php echo $row["Cid"]; ?>'><?php echo $row["Cname"]; ?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $row["Pcreationdt"]; ?>
                </span>
                <a class="read-more" href="single.php?Pid=<?php echo $row["Pid"];?>">read more</a>
            </div>
            </div>
        <?php
                }
            } else {
                echo "<h3>No Posts Found</h3>";
            }
        ?>
        </div>
    <!-- /recent posts box -->
</div>
