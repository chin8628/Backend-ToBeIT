<html>

    <head>
        <title>{title}</title>

        <?php echo link_tag("asset/css/bootstrap.min.css"); ?>
        <script src="<?php echo base_url(); ?>asset/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>


        <nav class="navbar navbar-default">
            <div class="container-fluid container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url(); ?>">Home </a></li>
                        <li><a href="<?php echo base_url(); ?>attendees">Attendees </a></li>
                        <li><a href="<?php echo base_url(); ?>checkin">Check In </a></li>
                        <li><a href="<?php echo base_url(); ?>order">Find Order </a></li>
                        <li><a href="<?php echo base_url(); ?>auth/logout">Logout </a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </head>