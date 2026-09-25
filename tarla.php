<?php
/*
	,,TARLA''  Technologia Została stworzona przez di_Timonix'a
	
	Tarla służy do asynchronicznego ładowania obiektów strony
	
	Cobright - Wszelkie Prawa Zaszczeżone
	
	TARLA,
	
	#plik: 2.0
*/
	
	Class tarla{
		// zmiene odpwiedzialne za przechowywanie danych do ładowania
		protected $pliki_php = [];
		protected $pliki_css = [];
		protected $pliki_js = [];
		
		
		// src = ścieżka, s = serwer, lvl = stopień ważnośći pliku
		public function add_php($src, $lvl = "0"){
			if($lvl > 10){
				echo "Maksymalny priorytet pliku wynosi 10, dla pliku '".$src."'.";
			}elseif($lvl < 0){
				echo "Minimalny priorytet pliku wynosi 0, dla pliku '".$src."'.";
			}else{
				$tab_pliki_php = [
					'src' => $src,
					'lvl' => $lvl,
				];
				
				array_push($this->pliki_php, $tab_pliki_php);
			}
		}
		public function add_css($src, $lvl = "0"){
			if($lvl > 10){
				echo "Maksymalny priorytet pliku wynosi 10, dla pliku '".$src."'.";
			}elseif($lvl < 0){
				echo "Minimalny priorytet pliku wynosi 0, dla pliku '".$src."'.";
			}else{
				$tab_pliki_css = [
					'src' => $src,
					'lvl' => $lvl,
				];
				
				array_push($this->pliki_css, $tab_pliki_css);
			}
		}
		public function add_js($src, $lvl = "0"){
			if($lvl > 10){
				echo "Maksymalny priorytet pliku wynosi 10, dla pliku '".$src."'.";
			}elseif($lvl < 0){
				echo "Minimalny priorytet pliku wynosi 0, dla pliku '".$src."'.";
			}else{
				$tab_pliki_js = [
					'src' => $src,
					'lvl' => $lvl,
				];
				
				array_push($this->pliki_js, $tab_pliki_js);
			}
		}
		// usuwanie plików do ładowania 
		public function remove_php($src, $lvl = "0"){
			$search = array_search($src, $this->pliki_php);
			unset($this->pliki_php[$search]);
		}
		public function remove_css($src, $lvl = "0"){
			$search = array_search($src, $this->pliki_css);
			unset($this->pliki_css[$search]);
		}
		public function remove_js($src, $lvl = "0"){
			$search = array_search($src, $this->pliki_js);
			unset($this->pliki_js[$search]);
		}
		// funkcjia ładowania plików php
		public function load_php(){
			$rkey = [];
			$ile_szykanych = 10;
			$ile_zlicz = 1;
			
			$ile = count($this->pliki_php); 
			for($i=0; $i < $ile; $i++){
				for($x=0; $x < $ile_zlicz; $x++){
					$wynik = false;
					
					if($wynik == false){
						$ile_szykanych-$ile_szykanych;
					}else{
						
						array_push($rkey, $wynik);
						unset($this->pliki_php[$wynik]);
						$ile_zlicz++;
						echo $ile_zlicz;
					}
				}
			}
			
			$new_array = [];
			$sortable_array = [];

			
			$itme_list = tarla::array_sort($this->pliki_php, 'lvl', SORT_DESC);
			
			for($i=0; $i < $ile; $i++){
				require_once ($this->pliki_php[$i]['src']) ;
			}
			
		}
		public function load_css(){
			$rkey = [];
			$ile_szykanych = 10;
			$ile_zlicz = 1;
			
			$ile = count($this->pliki_css); 
			for($i=0; $i < $ile; $i++){
				for($x=0; $x < $ile_zlicz; $x++){
					$wynik = false;
					
					if($wynik == false){
						$ile_szykanych-$ile_szykanych;
					}else{
						
						array_push($rkey, $wynik);
						unset($this->pliki_css[$wynik]);
						$ile_zlicz++;
						echo $ile_zlicz;
					}
				}
			}
			
			$new_array = [];
			$sortable_array = [];

			
			$itme_list = tarla::array_sort($this->pliki_css, 'lvl', SORT_DESC);
			
			for($i=0; $i < $ile; $i++){
				require_once ($this->pliki_css[$i]['src']) ;
			}
			
		}
		public function load_js(){
			$rkey = [];
			$ile_szykanych = 10;
			$ile_zlicz = 1;
			
			$ile = count($this->pliki_js); 
			for($i=0; $i < $ile; $i++){
				for($x=0; $x < $ile_zlicz; $x++){
					$wynik = false;
					
					if($wynik == false){
						$ile_szykanych-$ile_szykanych;
					}else{
						
						array_push($rkey, $wynik);
						unset($this->pliki_js[$wynik]);
						$ile_zlicz++;
						echo $ile_zlicz;
					}
				}
			}
			
			$new_array = [];
			$sortable_array = [];

			
			$itme_list = tarla::array_sort($this->pliki_js, 'lvl', SORT_DESC);
			
			for($i=0; $i < $ile; $i++){
				require_once ($this->pliki_js[$i]['src']) ;
			}
			
		}
		
		protected function array_sort($array, $on, $order=SORT_ASC){

		$new_array = [];
		$sortable_array = [];

			if (count($array) > 0) {
				foreach ($array as $k => $v) {
					if (is_array($v)) {
						foreach ($v as $k2 => $v2) {
							if ($k2 == $on) {
								$sortable_array[$k] = $v2;
							}
						}
					} else {
						$sortable_array[$k] = $v;
					}
				}

				switch ($order) {
					case SORT_ASC:
						asort($sortable_array);
						break;
					case SORT_DESC:
						arsort($sortable_array);
						break;
				}

				foreach ($sortable_array as $k => $v) {
					$new_array[$k] = $array[$k];
				}
			}

			return $new_array;
		}
		
	}
	
?>