<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GettingData extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo "auth";
	}

	// get DATA from https://ogienurdiana.com/career/ecc694ce4e7f6e45a5a7912cde9fe131
	public function getData()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://ogienurdiana.com/career/ecc694ce4e7f6e45a5a7912cde9fe131',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);

		curl_close($curl);

		// get only DATA from response
		$data = json_decode($response)->DATA;

		echo $data;
	}

	//get by NAMA from getData
	public function getDataByName()
	{

		$nama = $this->input->get("NAME");
		$sourceData = $this->getData(); // Misalnya, ini adalah metode untuk mendapatkan data dalam bentuk string

		// Ubah data string menjadi array baris
		$dataRows = explode(",", $sourceData);
		print_r($dataRows);
		die;


		// Inisialisasi array untuk menyimpan data hasil konversi
		$convertedData = [];

		// Iterasi melalui setiap baris data
		foreach ($dataRows as $row) {
			// Pecah baris menjadi array kolom
			$rowData = explode("|", $row);

			// Struktur data menjadi asosiatif array
			$data = [
				'NIM'  => $rowData[0],
				'NAMA' => $rowData[1],
				'YMD'  => $rowData[2],
			];

			// Tambahkan data ke array hasil konversi
			$convertedData[] = (object)$data;
		}



		// Filter data berdasarkan nama
		$filteredData = array_filter($convertedData, function ($item) use ($nama) {
			return $item->NAMA == $nama;
		});

		// Echo hasilnya dalam format JSON
		echo json_encode($filteredData);
	}
}
