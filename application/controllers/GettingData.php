<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GettingData extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('EMAIL') == '') {
			$res = array(
				'status' => 'error',
				'message' => 'Sesi habis, Silahkan login terlebih dahulu'
			);

			echo json_encode($res);
			die();
		}
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

		return $data;
	}

	//get by NAMA from getData
	public function getDataByName()
	{

		$nama = $this->input->get("NAME");
		$sourceData = $this->getData();

		// pisahkan data berdasarkan baris
		$dataRows = explode("\n", $sourceData);



		// Inisialisasi array untuk menyimpan data hasil konversi
		$convertedData = [];

		$i = 0;
		// Iterasi melalui setiap baris data
		foreach ($dataRows as $row) {
			if ($i == 0) {
				$i++;
				continue;
			}
			// Pecah baris menjadi array kolom
			$rowData = explode("|", $row);

			// Struktur data menjadi asosiatif array
			$data = [
				'NIM'  => $rowData[0] ?? null,
				'NAMA' => $rowData[2] ?? null,
				'YMD'  => $rowData[1] ?? null,
			];

			// Tambahkan data ke array hasil konversi
			$convertedData[] = (object)$data;
			$i++;
		}

		$filteredData = array_filter($convertedData, function ($item) use ($nama) {
			return $item->NAMA == $nama;
		});

		// Echo hasilnya dalam format JSON
		echo json_encode($filteredData);
	}

	//get by NAMA from getData
	public function getDataByNIM()
	{

		$param = $this->input->get("NIM");
		$sourceData = $this->getData();

		// pisahkan data berdasarkan baris
		$dataRows = explode("\n", $sourceData);



		// Inisialisasi array untuk menyimpan data hasil konversi
		$convertedData = [];

		$i = 0;
		// Iterasi melalui setiap baris data
		foreach ($dataRows as $row) {
			if ($i == 0) {
				$i++;
				continue;
			}
			// Pecah baris menjadi array kolom
			$rowData = explode("|", $row);

			// Struktur data menjadi asosiatif array
			$data = [
				'NIM'  => $rowData[0] ?? null,
				'NAMA' => $rowData[2] ?? null,
				'YMD'  => $rowData[1] ?? null,
			];

			// Tambahkan data ke array hasil konversi
			$convertedData[] = (object)$data;
			$i++;
		}

		$filteredData = array_filter($convertedData, function ($item) use ($param) {
			return $item->NIM == $param;
		});

		// Echo hasilnya dalam format JSON
		echo json_encode($filteredData);
	}

	//get by NAMA from getData
	public function getDataByYMD()
	{

		$param = $this->input->get("YMD");
		$sourceData = $this->getData();

		// pisahkan data berdasarkan baris
		$dataRows = explode("\n", $sourceData);

		// Inisialisasi array untuk menyimpan data hasil konversi
		$convertedData = [];

		$i = 0;
		// Iterasi melalui setiap baris data
		foreach ($dataRows as $row) {
			if ($i == 0) {
				$i++;
				continue;
			}
			// Pecah baris menjadi array kolom
			$rowData = explode("|", $row);

			// Struktur data menjadi asosiatif array
			$data = [
				'NIM'  => $rowData[0] ?? null,
				'NAMA' => $rowData[2] ?? null,
				'YMD'  => $rowData[1] ?? null,
			];

			// Tambahkan data ke array hasil konversi
			$convertedData[] = (object)$data;
			$i++;
		}

		$filteredData = array_filter($convertedData, function ($item) use ($param) {
			return $item->YMD == $param;
		});

		// Echo hasilnya dalam format JSON
		echo json_encode($filteredData);
	}
}
