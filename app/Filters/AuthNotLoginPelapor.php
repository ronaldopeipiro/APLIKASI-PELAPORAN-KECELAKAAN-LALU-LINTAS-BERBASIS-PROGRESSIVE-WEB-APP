<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthNotLoginPelapor implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		if (session()->get('logged_in_pelapor')) {
			return redirect()->to(base_url() . '/pelapor/laporan');
		}
	}

	//--------------------------------------------------------------------

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
	}
}
