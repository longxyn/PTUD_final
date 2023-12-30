
<?php
require_once ('models/sanpham.php');
?>

<h1 class="h3 mb-2 text-center text-gray-800 ">Nguyên Vật Liệu</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách Nguyên Vật Liệu</h6>
    </div>

    <div class="card-body">
        <a href="index.php?controller=sanpham&action=insert" class="btn btn-primary mb-3">Thêm</a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn vị</th>
                    <th>Nhà cung cấp</th>
                    <th>Sô lượng</th>
                    <th>Trạng Thái</th>
                    <th>Kho sản phẩm</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn vị</th>
                    <th>Nhà cung cấp</th>
                    <th>Sô lượng</th>
                    <th>Trạng Thái</th>
                    <th>Kho sản phẩm</th>
                    <th>Action</th>

                </tr>
                </tfoot>
                <tbody>

                <?php
                foreach ($sanpham as $item){

                    ?>
                    <form method="post">
                        <tr>
                            <td><?= $item->Id    ?></td>
                            <td><?= $item->TenSP ?></td>
                            <td><?= $item->IdDVT ?></td> 
                            <td><?= $item->IdNCC ?></td>
                          
                            <td><?= $item->SoLuong?></td>
                            <td><?php
                                if ($item->TrangThai=="1"){
                                    echo "Đã Duyệt";
                                }
                                else {
                                    echo "Chưa Duyệt";
                                }
                                ?></td>
                            <td><?= $item->id_kho_sp ?></td>

                            <td><!--<a  href="index.php?controller=khachhangs&action=showPost&id=--><!--"  class='btn btn-primary mr-3'>Details</a>-->
                             <a  href="index.php?controller=sanpham&action=edit&id=<?= $item->Id?>"  class='btn btn-primary mr-3'>Sửa</a>
                             <button type="submit" name="dele" value="<?= $item->Id ?>"    class='btn btn-danger'>Xóa</button>
                    </form>
                    </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
if(isset($_POST['dele'])){
    $id =$_POST['dele'];
    sp::delete($id);
}
?>


