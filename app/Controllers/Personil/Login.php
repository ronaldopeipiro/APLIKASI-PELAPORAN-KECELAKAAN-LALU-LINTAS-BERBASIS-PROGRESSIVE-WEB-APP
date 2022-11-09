<?php

namespace App\Controllers\Personil;

use CodeIgniter\Controller;
use App\Models\PersonilModel;

class Login extends Controller
{
	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->validation = \Config\Services::validation();
		$this->request = \Config\Services::request();
		$this->PersonilModel = new PersonilModel();

		$this->namaAkunEmailSMTP = "LAPOR LAKA LANTAS APP";
		$this->akunEmailSMTP = "laporlakalantasapp@gmail.com";
		$this->passwordEmailSMTP = "ywsxjzhlpofqeydf";
	}

	public function encrypt_openssl($string)
	{
		$ciphering = "AES-256-CTR";
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;
		$encryption_iv = '1234567891011121';
		$encryption_key = "#*PelaporanKecelakaan2021SkripsiRonal#@";

		$encryption = openssl_encrypt(
			$string,
			$ciphering,
			$encryption_key,
			$options,
			$encryption_iv
		);

		return $encryption;
	}

	public function decrypt_openssl($string_encrypt)
	{
		$ciphering = "AES-256-CTR";
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;

		$decryption_iv = '1234567891011121';
		$decryption_key = "#*PelaporanKecelakaan2021SkripsiRonal#@";

		$decryption = openssl_decrypt(
			$string_encrypt,
			$ciphering,
			$decryption_key,
			$options,
			$decryption_iv
		);

		return $decryption;
	}

	function crypto_rand_secure($min, $max)
	{
		$range = $max - $min;
		if ($range < 1) return $min; // not so random...
		$log = ceil(log($range, 2));
		$bytes = (int) ($log / 8) + 1; // length in bytes
		$bits = (int) $log + 1; // length in bits
		$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
			$rnd = $rnd & $filter; // discard irrelevant bits
		} while ($rnd > $range);
		return $min + $rnd;
	}

	function getToken($length)
	{
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet .= "0123456789";
		$max = strlen($codeAlphabet); // edited

		for ($i = 0; $i < $length; $i++) {
			$token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];
		}

		return $token;
	}

	public function index()
	{
		helper(['form']);
		$data = [
			'title' => 'LOGIN PERSONIL',
			'db' => $this->db,
			'validation' => $this->validation
		];
		return view('personil/auth/sign-in', $data);
	}

	public function sign_up()
	{
		helper(['form']);
		$data = [
			'title' => 'DAFTAR SEBAGAI PERSONIL',
			'db' => $this->db,
			'validation' => $this->validation
		];
		return view('personil/auth/sign-up', $data);
	}

	public function sign_up_account()
	{
		$namaLengkap = $this->request->getPost('namaLengkap');
		$nrp = $this->request->getPost('nrp');
		$noHp = $this->request->getPost('noHp');
		$email = $this->request->getPost('email');
		$passwordBaru = $this->request->getPost('passwordBaru');
		$konfirmasiPassword = $this->request->getPost('konfirmasiPassword');

		$cek_nrp = $this->PersonilModel->where('nrp', $nrp)->first();
		if ($cek_nrp) {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Akun dengan NRP ' . $nrp . ' telah terdaftar !'
			));
			return false;
		}

		$cek_email = $this->PersonilModel->where('email', $email)->first();
		if ($cek_email) {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Email ' . $email . ' telah digunakan !'
			));
			return false;
		}

		$cek_noHp = $this->PersonilModel->where('no_hp', $noHp)->first();
		if ($cek_noHp) {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Nomor handphone ' . $noHp . ' telah digunakan !'
			));
			return false;
		}

		if ($passwordBaru != $konfirmasiPassword) {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Password tidak sesuai dengan konfirmasi !'
			));
			return false;
		}

		$password = password_hash($passwordBaru, PASSWORD_DEFAULT);
		$waktu_input = date("Y-m-d H:i:s");

		$simpan_data_personil = $this->PersonilModel->save([
			'nama_lengkap' => $namaLengkap,
			'nrp' => $nrp,
			'email' => $email,
			'no_hp' => $noHp,
			'password' => $password,
			'status_akun' => '1',
			'aktif' => '0',
			'create_datetime' => $waktu_input
		]);

		if ($simpan_data_personil) {
			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Akun berhasil dibuat, silahkan login dengan akun anda !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Akun gagal dibuat, mohon periksa kembali data yang anda masukkan !'
			));
		}
	}

	public function auth()
	{
		$session = session();
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');

		$data = ($this->db->query("SELECT * FROM tb_personil WHERE nrp='$username' OR email='$username' LIMIT 1"))->getRow();

		if ($data) {
			$pass = $data->password;
			$status = $data->status_akun;

			if ($status != "2") {
				$verify_pass = password_verify($password, $pass);
				if ($verify_pass) {
					$ses_data = [
						'id_user' => $data->id_personil,
						'logged_in_personil'  => TRUE
					];

					$waktu_login = date("Y-m-d H:i:s");
					$this->PersonilModel->updatePersonil([
						'last_login' => $waktu_login
					], $data->id_personil);

					$session->set($ses_data);
					echo json_encode(array(
						'success' => '1',
						'pesan' => 'Selamat Datang ' . $data->nama_lengkap
					));
				} else {
					echo json_encode(array(
						'success' => '0',
						'pesan' => 'Password Salah !'
					));
				}
			} elseif ($status == "0") {
				echo json_encode(array(
					'success' => '0',
					'pesan' => 'Akun anda telah dinonaktifkan !'
				));
			}
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'NRP/Email tidak ditemukan !'
			));
		}
	}

	public function lupa_password()
	{
		helper(['form']);
		$data = [
			'title' => 'LUPA PASSWORD AKUN PERSONIL',
			'db' => $this->db,
			'validation' => $this->validation
		];
		return view('personil/auth/lupa-password', $data);
	}

	public function reset_password($token_reset_password)
	{
		helper(['form']);
		$data = [
			'title' => 'RESET PASSWORD AKUN',
			'db' => $this->db,
			'validation' => $this->validation,
			'token' => $token_reset_password
		];
		return view('personil/auth/reset-password', $data);
	}

	public function submit_lupa_password()
	{
		$session = session();
		$username = $this->request->getVar('username');

		if ($username == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom Email/NRP tidak boleh kosong !'
			));
			return false;
		}

		$cek_data = $this->db->query("SELECT * FROM tb_personil WHERE email='$username' OR nrp='$username' ORDER BY id_personil DESC LIMIT 1");

		if ($row = $cek_data->getRow()) {
			$id_personil = $row->id_personil;
			$nama_lengkap = $row->nama_lengkap;
			$email = $row->email;
			$nrp = $row->nrp;

			$id_pangkat = $row->id_pangkat;
			if ($id_pangkat != "" and $id_pangkat != 0) {
				$pangkat = $this->db->query("SELECT * FROM tb_pangkat_personil WHERE id_pangkat='$id_pangkat' ")->getRow();
				$nama_lengkap = $pangkat->singkatan . " " . $row->nama_lengkap;
			}

			$token = $this->getToken(197);

			$this->PersonilModel->updatePersonil([
				'token_reset_password' => $token
			], $id_personil);

			$this->kirim_email_reset_password($nama_lengkap, $nrp, $email, $token);

			echo json_encode(array(
				'success' => '1',
				'pesan' => 'Tautan untuk melakukan reset password telah dikirimkan melalui email ' . $email . '. Silahkan cek email anda !'
			));
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Email/NRP yang anda masukkan tidak tertaut dengan akun manapun, mohon periksa kembali !'
			));
			return false;
		}
	}

	public function kirim_email_reset_password($nama_penerima, $nrp, $email_penerima, $token)
	{
		$email_smtp = \Config\Services::email();

		$config["protocol"] = "smtp";
		$config["mailType"] = 'html';
		$config["charset"] = 'utf-8';
		// $config["CRLF"] = 'rn';
		$config["priority"] = '5';
		$config["SMTPHost"] = "smtp.gmail.com"; //alamat email SMTP 
		$config["SMTPUser"] = $this->akunEmailSMTP; //password email SMTP 
		$config["SMTPPass"] = $this->passwordEmailSMTP;

		// $config["SMTPPort"] = 465;
		// $config["SMTPCrypto"] = "ssl";
		$config["SMTPPort"] = 587;
		$config["SMTPCrypto"] = "tls";
		$config["SMTPAuth"] = true;
		$email_smtp->initialize($config);
		$email_smtp->setFrom($this->akunEmailSMTP, $this->namaAkunEmailSMTP);

		$email_smtp->setTo($email_penerima);

		$email_smtp->setSubject("Permintaan Reset Password");
		$pesan = '
					<h3>Hallo, saudara/i <b>' . $nama_penerima . '</b> (NRP.' . $nrp . ')</h3>
					anda baru saja meminta untuk melakukan reset password akun anda pada aplikasi LAPOR LAKA LANTAS APP.
					<br>
					Jika benar bahwa anda yang meminta untuk melakukan reset password, silahkan lakukan reset password akun anda melalui tautan berikut.
					<br>
					<br>
					<a href="' . base_url() . '/personil/reset-password/' . $token . '">
						' . base_url() . '/personil/reset-password/' . $token . '
					</a>
					<br>
					<br>
					Tetapi, jika bukan anda yang meminta untuk melakukan reset password, silahkan abaikan pesan ini
					<br>
					<br>
					Terima Kasih 
					<br>
					<br>
					<br>
					<br>
					<br>
					<i><b>Pesan ini dikirimkan otomatis oleh sistem !</b></i>
					<br>
			';

		$email_smtp->setMessage($pesan);
		$email_smtp->send();
	}

	public function submit_reset_password()
	{
		$session = session();
		$token_reset_password = $this->request->getVar('token_reset_password');
		$password_baru = $this->request->getVar('password_baru');
		$konfirmasi_password = $this->request->getVar('konfirmasi_password');

		if ($token_reset_password == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Token tidak ditemukan !'
			));
			return false;
		}

		if ($password_baru == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom password tidak boleh kosong !'
			));
			return false;
		}

		if ($konfirmasi_password == "") {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Kolom konfirmasi password tidak boleh kosong !'
			));
			return false;
		}

		if ($password_baru == $konfirmasi_password) {

			$cek_data = $this->PersonilModel->getPersonilByTokenResetPassword($token_reset_password);
			if ($cek_data) {
				$id_personil = $cek_data['id_personil'];
				$nama_lengkap = $cek_data['nama_lengkap'];
				$nrp = $cek_data['nrp'];
				$email = $cek_data['email'];

				$id_pangkat = $cek_data['id_pangkat'];
				if ($id_pangkat != "" and $id_pangkat != 0) {
					$pangkat = $this->db->query("SELECT * FROM tb_pangkat_personil WHERE id_pangkat='$id_pangkat' ")->getRow();
					$nama_lengkap = $pangkat->singkatan . " " . $cek_data['nama_lengkap'];
				}

				$password_baru_hash = password_hash($password_baru, PASSWORD_DEFAULT);

				$this->PersonilModel->updatePersonil([
					'password' => $password_baru_hash,
					'token_reset_password' => '',
				], $id_personil);

				$this->kirim_email_konfirmasi_update_password($nama_lengkap, $nrp, $email, $password_baru);

				echo json_encode(array(
					'success' => '1',
					'pesan' => 'Password akun anda berhasil diubah, silahkan masuk kembali !'
				));
			} else {
				echo json_encode(array(
					'success' => '0',
					'pesan' => 'Token tidak valid !'
				));
				return false;
			}
		} else {
			echo json_encode(array(
				'success' => '0',
				'pesan' => 'Password tidak sesuai dengan konfirmasi !'
			));
			return false;
		}
	}

	public function kirim_email_konfirmasi_update_password($nama_penerima, $nrp, $email_penerima, $password_baru)
	{
		$email_smtp = \Config\Services::email();

		$config["protocol"] = "smtp";
		$config["mailType"] = 'html';
		$config["charset"] = 'utf-8';
		// $config["CRLF"] = 'rn';
		$config["priority"] = '5';
		$config["SMTPHost"] = "smtp.gmail.com"; //alamat email SMTP 
		$config["SMTPUser"] = $this->akunEmailSMTP; //password email SMTP 
		$config["SMTPPass"] = $this->passwordEmailSMTP;

		// $config["SMTPPort"] = 465;
		// $config["SMTPCrypto"] = "ssl";
		$config["SMTPPort"] = 587;
		$config["SMTPCrypto"] = "tls";
		$config["SMTPAuth"] = true;
		$email_smtp->initialize($config);
		$email_smtp->setFrom($this->akunEmailSMTP, $this->namaAkunEmailSMTP);

		$email_smtp->setTo($email_penerima);

		$email_smtp->setSubject("Berhasil Reset Password Akun Personil");
		$pesan = '
					<h3>Hallo, saudara/i <b>' . $nama_penerima . '</b> (NRP.' . $nrp . ')</h3>
					Password akun anda berhasil diubah.
					<br>
					<br>
					Berikut informasi akun anda :
					<table>
						<tr>
							<td>Nama Lengkap</td>
							<td>:</td>
							<td>' . $nama_penerima . '</td>
						</tr>
						<tr>
							<td>NRP</td>
							<td>:</td>
							<td>' . $nrp . '</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td>' . $email_penerima . '</td>
						</tr>
						<tr>
							<td>Password baru</td>
							<td>:</td>
							<td>' . $password_baru . '</td>
						</tr>
					</table>
					<br>
					<br>
					Silahkan login aplikasi melalui tautan berikut ini
					<br>
					<a href="' . base_url() . '/personil/sign-in">
						' . base_url() . '/personil/sign-in
					</a>
					<br>
					<br>
						Jika ini bukan anda, silahkan lakukan permintaan reset password akun anda melalui tautan berikut :
					<br>
					<a href="' . base_url() . '/personil/lupa-password">
						' . base_url() . '/personil/lupa-password
					</a>
					<br>
					<br>
					Terima Kasih 
					<br>
					<br>
					<br>
					<br>
					<i><b>Pesan ini dikirimkan otomatis oleh sistem !</b></i>
					<br>
			';

		$email_smtp->setMessage($pesan);
		$email_smtp->send();
	}
}
