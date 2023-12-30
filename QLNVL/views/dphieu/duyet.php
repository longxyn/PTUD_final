
<?php
require_once ('models/donvitinh.php');
require_once ('models/nhacungcap.php');
require_once ('models/kho_nvl.php'); 
include_once('models/nvl.php');
include_once('models/dphieu.php');

//từ đây
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$stringOfIds = $_SESSION['stringOfIds'];

// đến đây


        $list2 = [];
        $db2 =DB::getInstance();
        $data2 =array('nvl'=> $list2);
        $reg2 = $db2->query('select * from nvl');
        foreach ($reg2->fetchAll() as $item){
            $list2[] =new NVL($item['Id'],$item['TenNVL'],$item['IdDVT'],$item['IdNCC'],$item['SoLuong'],$item['TrangThai'],$item['id_kho_nvl']);
                        }
        $data2 =array('nvl'=> $list2);

    $list3 = [];
    $db3 =DB::getInstance();
    $data3 =array('kho_nvl'=> $list3);
    $reg3 = $db3->query('select * from kho_nvl');
    foreach ($reg3->fetchAll() as $item){
        $list3[] =new kho_nvl($item['id_kho_nvl'],$item['ten_kho_nvl'],$item['dia_chi']);
                    }
    $data3 =array('kho_nvl'=> $list3);


?>
<center>
<h2>Điều phối list nvl về kho</h2>
<form onsubmit="return validateForm();" method="post" action="">
    <div class="form-group ml-5">
        
       
         <input type="hidden" name="id_kho_nvl" id="id_kho_nvl" value="">
                 <!-- từ đây -->
                 
         <button type="submit" name="create-nvl" class=" mt-2 btn-success btn">XÁC NHẬN </button>
                    <?php 
                   if (isset($_SESSION['stringOfIds'])) {
                    $stringOfIds = $_SESSION['stringOfIds'];
                    echo "các id nvl bạn điều phối gồm : $stringOfIds";
                    // Bây giờ bạn có thể sử dụng $stringOfIds trong truy vấn SQL của bạn.
                } else {
                    echo "Không tìm thấy giá trị stringOfIds.";
                }
                        ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Xử lý sự kiện khi giá trị dropdown thay đổi
        $("#knvl").change(function() {
            // Lấy giá trị được chọn từ dropdown
            var selectedKho = $("#knvl").val();
            
            // Cập nhật giá trị của ô input ẩn
            $("#id_kho_nvl").val(selectedKho !== undefined ? selectedKho : '');
        });
    });
</script>



<?php

if (isset($_POST['create-nvl'])) {
    // Lấy giá trị chuỗi $stringOfIds từ SESSION 
    // Đảm bảo xác thực và kiểm tra an toàn trước khi sử dụng $stringOfIds
    $newIdKho = isset($_POST['id_kho_nvl']) ? $_POST['id_kho_nvl'] : '';

    // Thực hiện câu truy vấn UPDATE
    if (!empty($stringOfIds)) {
        $conn = new mysqli("localhost", "root", "", "db_qlkho");

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối không thành công: " . $conn->connect_error);
        }

        // Câu truy vấn UPDATE
        $query = "UPDATE dphieu SET  trangthai = '1' WHERE Id IN $stringOfIds";

        // Thực hiện câu truy vấn
        if ($conn->query($query) === TRUE) {
            echo "<script>
            alert('Điều phối danh sách nvl thành công');
            setTimeout(function() {
                window.location.href = '?controller=nvl';
            });
          </script>";
    
            
        } else {
            echo "Lỗi cập nhật: " . $conn->error;
        }

        // Đóng kết nối
        $conn->close();
    } else {
        echo "Chuỗi ID không hợp lệ.";
    }
}
?>


