<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- head -->
        <?php $this->load->view("admin/_partials/head") ?>
    </head>
    <body class="sb-nav-fixed">
       <!-- navbar -->
       <?php $this->load->view("admin/_partials/navbar") ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <!-- sidebar -->
                <?php $this->load->view("admin/_partials/sidebar") ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?= $title; ?></h1>
                        
                        <!-- breadcrum -->
                        <?php //$this->load->view("admin/_partials/breadcrumb"); ?>

                        <?php $this->load->view($content_view); ?>
                        
                    </div>
                </main>
                <!-- footer -->
                <?php $this->load->view("admin/_partials/footer") ?>
            </div>
        </div>
        <!-- modal -->
        <?php $this->load->view("admin/_partials/modal") ?>
        <!-- js -->
        <?php $this->load->view("admin/_partials/js") ?>
    </body>
</html>
