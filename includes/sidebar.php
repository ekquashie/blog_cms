<div class="col-md-4">

     <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="POST" class="input-group">
            <label>
                <input type="text" name="search" class="form-control">
            </label>
            <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php

                    $conn = openCon();

                    $side_cat_query = "SELECT * FROM `categories`";
                    $side_categories_result = $conn->query($side_cat_query);

                    while($row = $side_categories_result->fetch_assoc()) {
                        $cat_title = $row['cat_title'];
                    ?>
                    <li><a href="#"><?php echo $cat_title ?></a></li>

                    <?php } closeCon($conn); ?>

                </ul>
            </div>
            <!-- /.col-lg-6 -->
<!--            <div class="col-lg-6">-->
<!--                <ul class="list-unstyled">-->
<!--                    <li><a href="#">Category Name</a>-->
<!--                    </li>-->
<!--                    <li><a href="#">Category Name</a>-->
<!--                    </li>-->
<!--                    <li><a href="#">Category Name</a>-->
<!--                    </li>-->
<!--                    <li><a href="#">Category Name</a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
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