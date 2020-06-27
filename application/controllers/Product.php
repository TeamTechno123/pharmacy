<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function index(){

  }

/*********************************** Main Category *********************************/

  // Add Main Category....
  public function main_category(){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('main_category_name', 'Batch Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $main_category_status = $this->input->post('main_category_status');
      if(!isset($main_category_status)){ $main_category_status = '1'; }
      $save_data = $_POST;
      $save_data['main_category_status'] = $main_category_status;
      $save_data['company_id'] = $pharm_company_id;
      $save_data['main_category_addedby'] = $pharm_user_id;
      $main_category_id = $this->Master_Model->save_data('main_category', $save_data);

      if($_FILES['main_category_image']['name']){
        $time = time();
        $image_name = 'main_category_'.$main_category_id.'_'.$time;
        $config['upload_path'] = 'assets/images/category/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['main_category_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('main_category_image') && $main_category_id && $image_name && $ext && $filename){
          $main_category_image_up['main_category_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('main_category_id', $main_category_id, 'main_category', $main_category_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Product/main_category');
    }

    $data['main_category_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'','','','','','','main_category_id','DESC','main_category');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/main_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Batch...
  public function edit_main_category($main_category_id){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('main_category_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $main_category_status = $this->input->post('main_category_status');
      if(!isset($main_category_status)){ $main_category_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_main_category_img']);
      $update_data['main_category_status'] = $main_category_status;
      $update_data['main_category_addedby'] = $pharm_user_id;
      $this->Master_Model->update_info('main_category_id', $main_category_id, 'main_category', $update_data);

      if($_FILES['main_category_image']['name']){
        $time = time();
        $image_name = 'main_category_'.$main_category_id.'_'.$time;
        $config['upload_path'] = 'assets/images/category/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['main_category_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('main_category_image') && $main_category_id && $image_name && $ext && $filename){
          $main_category_image_up['main_category_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('main_category_id', $main_category_id, 'main_category', $main_category_image_up);
          if($_POST['old_main_category_img']){ unlink("assets/images/category/".$_POST['old_main_category_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Product/main_category');
    }

    $main_category_info = $this->Master_Model->get_info_arr('main_category_id',$main_category_id,'main_category');
    if(!$main_category_info){ header('location:'.base_url().'Product/main_category'); }
    $data['update'] = 'update';
    $data['update_main_category'] = 'update';
    $data['main_category_info'] = $main_category_info[0];
    $data['act_link'] = base_url().'Product/edit_main_category/'.$main_category_id;

    $data['main_category_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'','','','','','','main_category_id','DESC','main_category');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/main_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Batch...
  public function delete_main_category($main_category_id){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }
    $main_category_info = $this->Master_Model->get_info_arr_fields('main_category_image, main_category_id', 'main_category_id', $main_category_id, 'main_category');
    if($main_category_info){
      $main_category_image = $main_category_info[0]['main_category_image'];
      if($main_category_image){ unlink("assets/images/category/".$main_category_image); }
    }
    $this->Master_Model->delete_info('main_category_id', $main_category_id, 'main_category');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Product/main_category');
  }


/********************************************** Sub Category **********************************/

  // Add Sub Category....
  public function sub_category(){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('sub_category_name', 'Batch Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $sub_category_status = $this->input->post('sub_category_status');
      if(!isset($sub_category_status)){ $sub_category_status = '1'; }
      $save_data = $_POST;
      $save_data['sub_category_status'] = $sub_category_status;
      $save_data['company_id'] = $pharm_company_id;
      $save_data['sub_category_addedby'] = $pharm_user_id;
      $sub_category_id = $this->Master_Model->save_data('sub_category', $save_data);

      if($_FILES['sub_category_image']['name']){
        $time = time();
        $image_name = 'sub_category_'.$sub_category_id.'_'.$time;
        $config['upload_path'] = 'assets/images/category/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['sub_category_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('sub_category_image') && $sub_category_id && $image_name && $ext && $filename){
          $sub_category_image_up['sub_category_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('sub_category_id', $sub_category_id, 'sub_category', $sub_category_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Product/sub_category');
    }
    $data['main_category_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'main_category_status','1','','','','','main_category_id','DESC','main_category');
    $data['sub_category_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'','','','','','','sub_category_id','DESC','sub_category');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/sub_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Sub Category...
  public function edit_sub_category($sub_category_id){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('sub_category_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $sub_category_status = $this->input->post('sub_category_status');
      if(!isset($sub_category_status)){ $sub_category_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_sub_category_img']);
      $update_data['sub_category_status'] = $sub_category_status;
      $update_data['sub_category_addedby'] = $pharm_user_id;
      $this->Master_Model->update_info('sub_category_id', $sub_category_id, 'sub_category', $update_data);

      if($_FILES['sub_category_image']['name']){
        $time = time();
        $image_name = 'sub_category_'.$sub_category_id.'_'.$time;
        $config['upload_path'] = 'assets/images/category/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['sub_category_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('sub_category_image') && $sub_category_id && $image_name && $ext && $filename){
          $sub_category_image_up['sub_category_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('sub_category_id', $sub_category_id, 'sub_category', $sub_category_image_up);
          if($_POST['old_sub_category_img']){ unlink("assets/images/category/".$_POST['old_sub_category_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Product/sub_category');
    }

    $sub_category_info = $this->Master_Model->get_info_arr('sub_category_id',$sub_category_id,'sub_category');
    if(!$sub_category_info){ header('location:'.base_url().'Product/sub_category'); }
    $data['update'] = 'update';
    $data['update_sub_category'] = 'update';
    $data['sub_category_info'] = $sub_category_info[0];
    $data['act_link'] = base_url().'Product/edit_sub_category/'.$sub_category_id;

    $data['main_category_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'main_category_status','1','','','','','main_category_id','DESC','main_category');
    $data['sub_category_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'','','','','','','sub_category_id','DESC','sub_category');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Product/sub_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Sub Category....
  public function delete_sub_category($sub_category_id){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }
    $sub_category_info = $this->Master_Model->get_info_arr_fields('sub_category_image, sub_category_id', 'sub_category_id', $sub_category_id, 'sub_category');
    if($sub_category_info){
      $sub_category_image = $sub_category_info[0]['sub_category_image'];
      if($sub_category_image){ unlink("assets/images/category/".$sub_category_image); }
    }
    $this->Master_Model->delete_info('sub_category_id', $sub_category_id, 'sub_category');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Product/sub_category');
  }



}
