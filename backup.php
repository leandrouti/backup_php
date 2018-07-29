<?php



	class Backup {
		private $config = [];

		public function __construct($filename = '') 
		{
			if($filename != '')	{
				$filename = $filename;
			} else {
				$filename = './config.json';
			}
			$this->config = $this->getConfiguration($filename);
			
			var_dump($this->config);

			foreach($this->config as $config) {
				$this->backup($config, ['--dry-run', '-av']);

			}
		}


		private function backup($ary, $args) {
			$origin = $ary['origin'];
			$destination = $ary['destination'];

			if(is_array($args)) {
				$args = implode(" ", $args);
			}
			$command = "rsync {$args} {$origin} {$destination} \n";
			exec($command, $out);
			var_dump($out);
		}


		private function getConfiguration($filename) {
			if( file_exists($filename) ) {
				return json_decode(file_get_contents($filename), true);
			} else {
				throw new Exception("File not found!");
			}			
		}
	}

	$backup  = new Backup();
	//print_r($argv);


?>