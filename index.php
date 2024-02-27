<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ani's Distro</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="assets/styles.css" />
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bgnav" style="color: white !important">
      <div class="container pe-5 ps-5">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fontnav text-white">
          <li class="nav-item">
            <a href="index.html" class="nav-link">HOME</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">PRODUCT</a>
          </li>
        </ul>

        <div class="collapse navbar-collapse text-white" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fontnav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="daftarmember.html">Daftar Member</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- header banner -->
    <section id="header">
      <div class="container ps-0">
        <img src="assets/img/banner.jpg" class="banner" />
        <div class="judulbanner">
          <span class="subtitle1">ASE Distro</span> <br />
          <span class="subtitle2">Yuk belanjaa...!!!</span>
        </div>
      </div>
    </section>
    <!-- konten -->
    <section id="konten ">
      <div class="container pb-5">
        <div class="row">
          <div class="col-md-3 pt-4">
            <div class="kategori-title">Kategori Produk</div>
            <div class="subkategori" id="subkategori">
              <li><a href='#'>SWEATER</a></li>
              <li><a href='#'>SEPATU</a></li>
            </div>
          </div>
          <div class="col-md-9 pt-4">
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <img src="assets/img/baju1.jpg" class="card-img-top" alt="..." />
                  <div class="card-body text-center bgcardbody">
                    <h5 class="card-title">Sweater 001 - white</h5>
                    <h6 class="harga">Rp. 100,000</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item btndetail">
                      <a href="detailproduk.html" target="_blank" class="text-white">Detail</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <img src="assets/img/baju2.jpg" class="card-img-top" alt="..." />
                  <div class="card-body text-center bgcardbody">
                    <h5 class="card-title">Hoodie All Size</h5>
                    <h6 class="harga">Rp. 200,000</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item btndetail">Detail</li>
                  </ul>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <img src="assets/img/baju3.jpg" class="card-img-top" alt="..." />
                  <div class="card-body text-center bgcardbody">
                    <h5 class="card-title">T-Shirt Red</h5>
                    <h6 class="harga">Rp. 150,000</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item btndetail">Detail</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- footer -->
    <section id="footer" class="bgnav text-white">
      <div class="container pt-4">
        <div class="row">
          <div class="col-md-4">
            <address class="fw-bold mb-0">Ani's Distro :</address>
            <p class="mb-0">Jalan Merdeka No.101 , Manyar Surabaya</p>
            <p>WA : 081-3393-64971</p>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <address class="fw-bold">Follow us :</address>
            <p>
              <span class="pe-3">@anidistro</span>
              <span class="pe-3">@anidistro</span>
            </p>
          </div>
        </div>
      </div>
    </section>
    <!-- modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Login</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="bg-light p-4 m-5">
              <div class="alert alert-danger" role="alert" id="alert" style="display: none"></div>
              <div class="alert alert-success" role="alert" id="alertok" style="display: none"></div>
              <div id="judul" class="mt-3"></div>
              <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="logusername" class="form-control" id="logusername" />
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="logpassword" />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnbatal" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" id="btnkeluar" class="btn btn-primary" onclick="ceklogin()">Login</button>
          </div>
        </div>
      </div>
    </div>

    <!-- js -->
  </body>
</html>
