<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Front {

	public function index()
	{
		$this->rs = $this->md->getCampaign();
		$this->render('main', $this);
	}
}
