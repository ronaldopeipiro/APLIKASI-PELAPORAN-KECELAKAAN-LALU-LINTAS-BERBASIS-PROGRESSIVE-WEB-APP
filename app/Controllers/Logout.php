<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Logout extends Controller
{
	public function pelapor()
	{
		$session = session();

		$token = $session->get('access_token');
		// return redirect()->to("https://accounts.google.com/o/oauth2/revoke?token=$token");
		$session->destroy();

		return redirect()->to(base_url() . '/pelapor/sign-in');
	}

	public function personil()
	{
		$session = session();
		$session->destroy();
		return redirect()->to(base_url() . '/personil/login');
	}

	public function admin()
	{
		$session = session();
		$session->destroy();
		return redirect()->to(base_url() . '/admin/login');
	}
}
