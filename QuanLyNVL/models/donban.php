<?php
class DonBan{

    public $Id;
    public $NgayBan;
    public $ThanhTien;
    public $TrangThai;


    function __construct($Id,$NgayBan,$ThanhTien,$TrangThai)
    {
        $this->Id = $Id;
        $this->NgayBan = $NgayBan;
        $this->ThanhTien= $ThanhTien;
        $this->TrangThai= $TrangThai;
    }
    static function all()
    {
        $list =[];
        $db =DB::getInstance();
        $reg = $db->query('SELECT db.Id ,db.NgayBan , db.Tong,db.TrangThai FROM DonBan db ');
        foreach ($reg->fetchAll() as $item){
            $list[] =new DonBan($item['Id'],$item['NgayBan'],$item['Tong'],$item['TrangThai']);
        }
        return $list;
    }
    static function find($id)
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT db.Id ,db.NgayBan  ,db.Tong,db.TrangThai FROM DonBan db WHERE db.Id = :id');
        $req->execute(array('id' => $id));
        $item = $req->fetch();
        if (isset($item['Id'])) {
            return new DonBan($item['Id'],$item['NgayBan'],$item['Tong'],$item['TrangThai']);
        }
        return null;
    }
    static function add($ngayban,$Tong,$TrangThai)
    {
        $db =DB::getInstance();
        $reg =$db->query('INSERT INTO DonBan(NgayBan,Tong,TrangThai) VALUES ("'.$ngayban.'",'.$Tong.',"'.$TrangThai.'")');

    }
    static function  update($id,$DonBan)
    {
        $db = DB::getInstance();
        $reg =$db->query('UPDATE DonBan SET DonBan ="'.$DonBan.'" WHERE Id='.$id);
        header('location:index.php?controller=donban&action=index');
    }
    static function  thanhtoan($id)
    {
        $db = DB::getInstance();
        $reg =$db->query('UPDATE DonBan SET TrangThai ="1" WHERE Id='.$id);
    }
    static function  chuathanhtoan($id)
    {
        $db = DB::getInstance();
        $reg =$db->query('UPDATE DonBan SET TrangThai ="0" WHERE Id='.$id);
    }
    static function delete($id)
    {
        $db =DB::getInstance();
        $reg =$db->query('DELETE FROM ChiTietBan WHERE IdDonBan='.$id);
        $reg1 =$db->query('DELETE FROM DonBan WHERE Id = '.$id);
        header('location:index.php?controller=donban&action=index');
    }
}
