<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input type="text" class="form-control" name="search">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>
<!-- login form -->
<div class="well">
    <h4>Login</h4>
    <form action="includes/login.php" method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Username">
    </div>
    <div class="input-group">
        <input type="password" class="form-control" name="password" placeholder="Password">
    
        <span class="input-group-btn">
            <button name="login" class="btn btn-primary" type="submit">Login</button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>


<!-- Blog Categories Well -->
<div class="well">
            <?php
            $query = "SELECT * FROM categories";
            $category_query = mysqli_query($connection, $query); ?>
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
            <?php
            while($row = mysqli_fetch_assoc($category_query)){
                $category = $row['cat_title'];
                $cat_id = $row['cat_id'];
                echo "<li><a href='catposts.php?catid=$cat_id'>{$category}</a>
                </li>";
            }
            ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
        <div class="col-lg-6">
            <ul class="list-unstyled">
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<div class="well">
    <h4>Side Widget Well</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
</div>

</div>