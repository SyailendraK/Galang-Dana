<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>My Profile</title>

    <!-- Custom fonts for this template-->
    <link
      href="<?= base_url() ?>/vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/css/sb-admin-2.min.css" rel="stylesheet" />
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <?= $this->include('layout/admin/sidebar') ?>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <?= $this->include('layout/admin/topbar') ?>
          <!-- End of Topbar -->

          <?= $this->renderSection('page-content') ?>
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span
                >Copyright &copy; GalangDana
                <?= date('Y') ?></span
              >
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div
      class="modal fade"
      id="logoutModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button
              class="close"
              type="button"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Select "Logout" below if you are ready to end your current session.
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-secondary"
              type="button"
              data-dismiss="modal"
            >
              Cancel
            </button>
            <a class="btn btn-primary" href="<?= base_url() ?>/logout">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>/js/sb-admin-2.min.js"></script>
    
    <script>
      function previewImageAll(input,label,preview) {
        const ktp = document.querySelector('#'+input);
        const ktpLabel = document.querySelector('.'+label);
        const imgPreview = document.querySelector('.'+preview);

        ktpLabel.textContent = ktp.files[0].name;

        const filektp = new FileReader();
        filektp.readAsDataURL(ktp.files[0]);

        filektp.onload = function (e) {
          imgPreview.src = e.target.result;
        }
      }



      function previewImage() {
        const ktp = document.querySelector("#ktp");
        const ktpLabel = document.querySelector(".ktp-label");
        const imgPreview = document.querySelector(".img-preview-ktp");

        ktpLabel.textContent = ktp.files[0].name;

        const filektp = new FileReader();
        filektp.readAsDataURL(ktp.files[0]);

        filektp.onload = function (e) {
          imgPreview.src = e.target.result;
        }
      }

      function previewImage2() {
        const ktpdiri = document.querySelector("#ktpdiri");
        const ktpdiriLabel = document.querySelector(".ktpdiri-label");
        const imgPreview = document.querySelector(".img-preview-ktpdiri");

        ktpdiriLabel.textContent = ktpdiri.files[0].name;

        const filektpdiri = new FileReader();
        filektpdiri.readAsDataURL(ktpdiri.files[0]);

        filektpdiri.onload = function (e) {
          imgPreview.src = e.target.result;
        }
      }

      function previewImage3() {
        const ktp = document.querySelector("#fotoDiri");
        const fotoDiriLabel = document.querySelector(".fotoDiri-label");
        const imgPreview = document.querySelector(".img-preview-fotoDiri");

        fotoDiriLabel.textContent = fotoDiri.files[0].name;

        const filefotoDiri = new FileReader();
        filefotoDiri.readAsDataURL(fotoDiri.files[0]);

        filefotoDiri.onload = function (e) {
          imgPreview.src = e.target.result;
        }
      }
      if(document.querySelector('.alert')){
        document.querySelector('.alert').addEventListener('click',() => {
          document.querySelector('.alert').remove();
        });
      }
    </script>
</html>
