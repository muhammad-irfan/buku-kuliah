<?php
	public static const PERTANYAAN = 1;
	public static const KOMENTAR = 2;
	public static const POST = 3;
	
	private $id, $type, $content, $parentId;
	
	function __construct($id, $createNew = false, $link= null){
		if($createNew){
			$this->id = $id;
		}else{
			if($link == null){
				throw new Exception("202");
				exit(1);
			}else{
				$this->id = $id;
				$this->getType();
				$this->getContent();
				$this->getParentId();
			}
		}
	}
	
	function setType($type){
		if($type != PERTANYAAN || $type != KOMENTAR || $type != POST){
			throw new Exception("205");
			exit(1);
		}
		$resultSet = $link->query(array('feed','set',array('type',$this->id, $type)));
		$this->type = $type;
	}
	
	function getType(){
		if($this->type == null){
			$resultSet = $link->query(array('feed','get',array('type',$this->id)));
			$this->type= $resultSet['type'];
		}
		return $this->type;
	}
	
	function setContent($content){
		$resultSet = $link->query(array('feed','set',array('content',$this->id, $content)));
		$this->content = $content;
	}
	
	function getContent(){
		if($this->content == null){
			$resultSet = $link->query(array('feed','get',array('content',$this->id)));
			$this->content= $resultSet['content'];
		}
		return $this->content;
	}	
	
	function setParentId($parentId){
		$resultSet = $link->query(array('feed','set',array('parentId',$this->id, $parentId)));
		$this->parentId = $parentId;
	}
	
	function getParentId(){
		if($this->parentId == null){
			$resultSet = $link->query(array('feed','get',array('parentId',$this->id)));
			$this->parentId= $resultSet['parentId'];
		}
		return $this->parentId;
	}
?>