<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthAdmin implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		if (!session()->get('logged_in_admin')) {
			return redirect()->to(base_url() . '/admin/sign-in');
		}
	}

	//--------------------------------------------------------------------

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// Do something here
	}
}
