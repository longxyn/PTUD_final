<?php
class kho_sp{
    public $id_kho_sp;
    public $ten_kho_sp;
    public $dia_chi;


    function __construct($id_kho_sp,$ten_kho_sp,$dia_chi)
    {
        $this->id_kho_sp=$id_kho_sp;
        $this->ten_kho_sp=$ten_kho_sp;
        $this->dia_chi=$dia_chi;

    }
    static function all()
    {
        $list = [];
        $db =DB::getInstance();
        $reg = $db->query('select *from kho_sp');
        foreach ($reg->fetchAll() as $item){
            $list[] =new kho_sp($item['id_kho_sp'],$item['ten_kho_sp'],$item['dia_chi']);
        }
        return $list;
    }
    static function find($id_kho_sp)
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM kho_sp WHERE id_kho_sp = :id_kho_sp');
        $req->execute(array('id_kho_sp' => $id_kho_sp));
        
        $item = $req->fetch();
        if (isset($item['id_kho_sp'])) {
            return new kho_sp($item['id_kho_sp'],$item['ten_kho_sp'],$item['dia_chi']);
        }
        return null;
    }
    static function add($id_kho_sp,$ten_kho_sp,$dia_chi)
    {
        $db =DB::getInstance();
        $reg =$db->query('INSERT INTO kho_sp(id_kho_sp,ten_kho_sp,dia_chi) VALUES ("'.$id_kho_sp.'","'.$ten_kho_sp.'","'.$dia_chi.'")');
        header('location:index.php?controller=kho_sp&action=index');
    }
    static function update($id_kho_sp,$ten_kho_sp,$dia_chi)
    {
        $db =DB::getInstance();
        $reg =$db->query('UPDATE kho_sp SET ten_kho_sp ="'.$ten_kho_sp.'",dia_chi="'.$dia_chi.'" WHERE id_kho_sp='.$id_kho_sp);
        header('location:index.php?controller=kho_sp&action=index');
    }
      
    static function  delete($id_kho_sp){
        $db =DB::getInstance();
        $reg =$db->query('DELETE FROM kho_sp WHERE id_kho_sp='.$id_kho_sp);
        header('location:index.php?controller=kho_sp&action=index');
    }

}