<?php 
	 class Usuario{

		private $idUsuario;
		private $deslogin;
		private $dessenha;
		private $dtCadastro;

		public function getIdUsuario(){
			return $this->idUsuario;
		}
		public function setIdUsuario($value){
			$this->idUsuario = $value;
		}

		public function getDeslogin(){
			return $this->deslogin;
		}

		public function setDeslogin($value){
			$this->deslogin = $value;
		}

		public function getDessenha(){
			return $this->dessenha;
		}

		public function setDessenha($value){
			$this->dessenha = $value;
		}

		public function getDtCadastro(){
			return $this->dtCadastro;
		}

		public function setDtCadastro($value){
			$this->dtCadastro = $value;
		}

		public function loadById($id){
			$sql = new Sql();

			$results = $sql -> select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID"=>$id
			));

			if (count($results)>0){
				$row = $results[0];
				$this->setIdUsuario($row['idusuario']);
				$this->setDessenha($row['dessenha']);
				$this->setDeslogin($row['deslogin']);
				$this->setDtCadastro(new DateTime($row['dtcadastro'])); 
			}
		}

		public function __toString(){
			return json_encode(array(
				"idusuario:"=>$this->getIdUsuario(),
				"Login:"=>$this->getDeslogin(),
				"dessenha:"=>$this->getDessenha(),
				"dtCadastro"=>$this->getDtCadastro()->format("d/m/y h:i:s")
			));
		}


		public static function getList(){
			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
		}

		public static function search($login){
			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin like :SEARCH order by deslogin", array(

				':SEARCH'=>"%".$login."%"));
		}

		public function login($login, $password){
			$sql = new Sql();

			$results = $sql -> select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
				":LOGIN"=>$login,
				":PASSWORD"=>$password

			));

			if (count($results)>0){
				$row = $results[0];
				$this->setIdUsuario($row['idusuario']);
				$this->setDessenha($row['dessenha']);
				$this->setDeslogin($row['deslogin']);
				$this->setDtCadastro(new DateTime($row['dtcadastro'])); 
			} else{
				throw new Exception("Login ou senha Invalidos");
			}
		}

	}

?>