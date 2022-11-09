<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthNotLoginPersonil implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		if (session()->get('logged_in_personil')) {
			return redirect()->to(base_url() . '/personil');
		}
	}

	//--------------------------------------------------------------------

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
	}
}
