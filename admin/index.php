<?php include 'includes/admin_header.php'; ?>

    <div id="wrapper">

        <?php
        $conn = openCon();

        ?>

        <!-- Navigation -->
        <?php include 'includes/admin_navigation.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin Dashboard

                            <?php echo $_SESSION['username'] ?>
                            <small>Author</small>
                        </h1>


                        <!-- /.row -->

                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-file-text fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <?php
                                                    $query = "SELECT * FROM `posts`";
                                                    $get_posts = $conn->query($query);
                                                    $post_count = $get_posts->num_rows;
                                                ?>
                                                <div class='huge'><?php echo $post_count; ?></div>
                                                <div>Posts</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="posts.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-comments fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <?php
                                                $query = "SELECT * FROM `comments`";
                                                $get_comments = $conn->query($query);
                                                $comment_count = $get_comments->num_rows;
                                                ?>
                                                <div class='huge'><?php echo $comment_count; ?></div>
                                                <div>Comments</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="comments.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <?php
                                                $query = "SELECT * FROM `users`";
                                                $get_users = $conn->query($query);
                                                $user_count = $get_users->num_rows;
                                                ?>
                                                <div class='huge'><?php echo $user_count ?></div>
                                                <div> Users</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="users.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-list fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <?php
                                                $query = "SELECT * FROM `categories`";
                                                $get_categories = $conn->query($query);
                                                $category_count = $get_categories->num_rows;
                                                ?>
                                                <div class='huge'><?php echo $category_count ?></div>
                                                <div>Categories</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="categories.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php
                        $query = "SELECT * FROM `posts` WHERE `post_status`='draft'";
                        $select_draft_post = $conn->query($query);
                        $draft_count = $select_draft_post->num_rows;
                        ?>

                        <div class="row">
                            <script type="text/javascript">
                                google.charts.load('current', {'packages':['bar']});
                                google.charts.setOnLoadCallback(drawChart);

                                function drawChart() {
                                    var data = google.visualization.arrayToDataTable([
                                        ['Data', 'Count'],
                                        <?php
                                            $element_text = ['Active Posts', 'Draft Posts', 'Categories', 'Users', 'Comments'];
                                            $element_count = [$post_count, $draft_count, $category_count, $user_count, $comment_count];

                                            for($i=0; $i<sizeof($element_text); $i++) {
                                                echo "['$element_text[$i]', $element_count[$i]],";
                                            }

                                        ?>
                                    ]);

                                    var options = {
                                        chart: {
                                            title: '',
                                            subtitle: '',
                                        }
                                    };

                                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                    chart.draw(data, google.charts.Bar.convertOptions(options));
                                }
                            </script>

                            <div id="columnchart_material" style="width: auto; height: 500px;"></div>

                        </div>

                        <?php closeCon($conn); ?>
                        <!-- /.row -->

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include 'includes/admin_footer.php'; ?>