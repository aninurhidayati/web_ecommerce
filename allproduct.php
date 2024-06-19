<h3 class="text-center">Semua Produk</h3>
<hr>
<div class="row">
    <?php
    $statement_sql = $cn_mysql->prepare("select * from product order by idproduct DESC");
    $statement_sql->execute();
    $result = $statement_sql->get_result();
    while($data = $result->fetch_assoc())
    {
    ?>
    <div class="col-md-4">
        <div class="card">
            <img src="assets/img_product/<?= $data['productfile']; ?>" class="card-img-top" alt="..." />
            <div class="card-body text-center bgcardbody">
            <h5 class="card-title"><?= $data["name_product"]; ?></h5>
            <h6 class="harga"><?= $data["price"]; ?></h6>
            </div>
            <ul class="list-group list-group-flush">
            <li class="list-group-item btndetail">
                <!-- contoh mengirimkan variabel via link -->
                <!-- variabel page yang berisi detailproduk -->
                <a href="?page=detailproduk" class="text-white">Detail</a>
            </li>
            </ul>
        </div>
    </div>
    <?php } ?>
</div>