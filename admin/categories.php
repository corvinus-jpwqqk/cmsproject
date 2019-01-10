<?php
    include "includes/admin_header.php";
    include "includes/admin_functions.php";
?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
            include "includes/admin_navigation.php";
        ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                        <div class="col-xs-6">
                        <?php
                        // NEW CAT QUERY
                         newCategory();
                        ?>
                        <form action="categories.php" method="post">
                            <div class="form-group">
                            <label for="cat_title">Add new Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                            </div>
                        </form>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // SHOWALL CAT QUERY
                                    showCategories();
                                ?>
                                <?php
                                // DELETE QUERY
                                    deleteCategory();
                                ?>

                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php
        include "includes/admin_footer.php";
    ?>