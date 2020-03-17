<?php
/**
 * Class FileDownloader
 *
 * @author Furkan Sezgin (ZquaRe)
 * @mail furkan-sezgin@hotmail.com
*/

class FileDownloader
{
	private $url = null;
	private $folder = null;
	private $name = null;

	private function remoteFileCheck($url)
	{
		// Initialize cURL
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		// Check the response code
		if ($responseCode == 200) {
			return true;
		} else {
			return false;
		}
	}

	public function Download($url, $folder, $name = null)
	{
		$this->url = $url;
		$this->folder = $folder;
		$this->name = $name;

		if (self::remoteFileCheck($this->url)) {
			$this->imageName = explode("/", $this->url);
			$this->imageName = end($this->imageName);
			$this->extension = pathinfo($this->imageName)['extension'];

			if (!empty($this->folder)) {
				if (file_exists($this->folder)) {
					if (!empty($this->name)) {
						copy($this->url, $this->folder . '/' . $this->name . '.' . $this->extension);
					} else {
						copy($this->url, $this->folder . '/' . $this->imageName);
					}
				} else {
					return json_encode(
						array(
							'status' 		=> 'error', 
							'description' 	=> 'Folder not found', 
							'folder' 		=> $this->folder, 
							'class' 		=> get_class($this), 
							'function' 		=> __FUNCTION__)
					);
				}
			} else {
				if (!empty($this->name)) {
					copy($this->url, $this->name . '.' . $this->extension);
				} else {
					copy($this->url, $this->imageName);
				}
			}
		} else {
			return json_encode(
				array(
					'status' 		=> 'error', 
					'description' 	=> 'File not available on remote server', 
					'Url' 			=> $this->url,
					'class' 		=> get_class($this), 
					'function' 		=> __FUNCTION__
				)
			);
		}
	}
}

?>