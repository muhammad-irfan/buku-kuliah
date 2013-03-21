<?php
class Buku
	private $id, $gambarId, $resensi, $judul, $penulis, $penerbit;
	function __construct($id, $createNew = false, $link = null){
		if($createNew){
			$this->id = $id;
			$resensi = array();
		}else{
			if($link == null){
				throw new Exception("201");
				exit(1);
			}else{
				$this->id = $id;
				$this->getGambarId();
				$this->getResensi();
				$this->getJudul();
				$this->getPenulis();
				$this->getPenerbit();
			}
		}
	}
	
	function setGambarId($id){
		$resultSet = $link->query(array('buku','set',array('gambar',$this->id, $id)));
		$this->gambarId = $id;
	}
	
	function getGambarId(){
		if($this->gambarId == null){
			$resultSet = $link->query(array('buku','get',array('gambar',$this->id)));
			$this->gambarId = $resultSet['gambarId'];
		}
		return $this->gambarId;
	}
	
	function addResensi($resensi){
		$resultSet = $link->query(array('buku','set',array('resensi',$this->id, $resensi)));
		($this->resensi).push($resensi);
	}
	
	function getResensi($id){
		if(count($this->resensi) == 0){
			$resultSet = $link->query(array('buku','get',array('resensi',$this->id, $id)));
			$this->resensi[$id] = $resultSet['resensi'];
		}
		return $this->resensi[$id];
	}
	
	function getResensi(){
		if($this->resensi == null || count($this->resensi) == 0){
			$resultSet = $link->query(array('buku','get',array('resensi',$this->id, -1)));
			$this->resensi = $resultSet['resensi'];
		}
		return $this->resensi;
	}
	
	function deleteResensi($id){
		$resultSet = $link->query(array('buku','delete',array('resensi',$this->id, $id)));
		$temp1 = array_slice($this->resensi, 1, $id-1);
		$temp2 = array_slice($this->resensi, $id+1);
		$this->resensi = array_merge($temp1, $temp2);
	}
	
	function setJudul($judul){
		$resultSet = $link->query(array('buku','set',array('judul',$this->id, $judul)));
		$this->judul = $resultSet['judul'];
	}
	
	function getJudul(){
		if($this->judul == null){
			$resultSet = $link->query(array('buku','get',array('judul',$this->id)));
			$this->judul = $resultSet['judul'];
		}
		return $this->judul;
	}
	
	function setPenulis($penulis){
		$resultSet = $link->query(array('buku','set',array('penulis',$this->id, $penulis)));
		$this->penulis = $resultSet['penulis'];
	}
	
	function getPenulis(){
		if($this->penulis == null){
			$resultSet = $link->query(array('buku','get',array('penulis',$this->id)));
			$this->penulis = $resultSet['penulis'];
		}
		return $this->penulis;
	}
	
	
	function setPenerbit($penerbit){
		$resultSet = $link->query(array('buku','set',array('penerbit',$this->id, $penerbit)));
		$this->penerbit = $resultSet['penerbit'];
	}
	
	function getPenerbit(){
		if($this->penerbit == null){
			$resultSet = $link->query(array('buku','get',array('penerbit',$this->id)));
			$this->penerbit = $resultSet['penerbit'];
		}
		return $this->penerbit;
	}
}

?>