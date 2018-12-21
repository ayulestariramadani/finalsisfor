<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct(){
		parent ::__construct();

		//load model
		$this->load->model('model_company'); 
	}
	public function index() {
		$this->load->view('admin/index');
	}
	public function login() {
		$this->load->view('login');
	}
	public function loginAction() {
		redirect(base_url("index.php/admin/index"));
	}
	public function customer() {
		$this->load->view('admin/customer');
	}
	public function customerTambah(){
		$this->load->view('admin/customerForm');	
	}
	public function company() {
		$db_company['company']=$this->model_company->getAllData('company');
		$this->load->view('admin/company', $db_company);
	}
	public function companyTambah(){
		$this->load->view('admin/companyForm');	
	}
	public function library() {
		$this->load->view('admin/library');
	}
	public function libraryTambah(){
		$this->load->view('admin/libraryForm');	
	}
	public function product() {
		$this->load->view('admin/product');
	}
	public function productTambah(){
		$this->load->view('admin/productForm');	
	}
	public function post(){
		$this->load->view('admin/posts');	
	}

	//------------Tambah-------------//
	public function simpan(){
		$data = array('nama_perusahaan'=> $this->input->post('nama_perusahaan', true),
			'notlp_perusahaan'=> $this->input->post('notlp_perusahaan', true),
			'email_perusahaan'=> $this->input->post('email_perusahaan', true),
			'alamat_perusahaan'=> $this->input->post('alamat_perusahaan', true)
		);

		$this->model_company->insertData('company',$data);
		redirect('admin/company');
	}

	//------------Edit-------------//
	public function edit($id)
	{
		$db_company['company'] = $this->model_company->getData('company',$id,'id_perusahaan');
		$this->load->view('admin/companyFormEdit', $db_company);
	}

	public function update()
	{
		$data = array('nama_perusahaan'=> $this->input->post('nama_perusahaan', true),
			'notlp_perusahaan'=> $this->input->post('notlp_perusahaan', true),
			'email_perusahaan'=> $this->input->post('email_perusahaan', true),
			'alamat_perusahaan'=> $this->input->post('alamat_perusahaan', true)
	);
	$id = $this->input->post('hidden_id');
	$this->model_company->update('company',$data,$id, 'id_perusahaan');
	redirect('admin/company');
	}

	//------------Delete-------------//
	public function delete()
	{
		$u = $this->uri->segment(3);
		$this->model_company->delete('company', $u, 'id_perusahaan');
		redirect('admin/company','refresh');
	}
}
