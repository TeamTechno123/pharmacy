<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Master extends CI_Controller{
    public function __construct(){
      parent::__construct();
      date_default_timezone_set('Asia/Kolkata');
    }

    public function index(){

    }


/********************************* Unit ***********************************/
  // Add Unit...
  public function unit(){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' || $pharm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('unit_name', 'Unit Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $unit_status = $this->input->post('unit_status');
      if(!isset($unit_status)){ $unit_status = '1'; }
      $save_data = $_POST;
      $save_data['unit_status'] = $unit_status;
      $save_data['company_id'] = $pharm_company_id;
      $save_data['unit_addedby'] = $pharm_user_id;
      $user_id = $this->Master_Model->save_data('unit', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/unit');
    }

    $data['unit_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'','','','','','','unit_id','ASC','unit');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/unit', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Unit...
  public function edit_unit($unit_id){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' || $pharm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('unit_name', 'Unit Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $unit_status = $this->input->post('unit_status');
      if(!isset($unit_status)){ $unit_status = '1'; }
      $update_data = $_POST;
      $update_data['unit_status'] = $unit_status;
      $update_data['unit_addedby'] = $pharm_user_id;
      $this->Master_Model->update_info('unit_id', $unit_id, 'unit', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/unit');
    }

    $unit_info = $this->Master_Model->get_info_arr('unit_id',$unit_id,'unit');
    if(!$unit_info){ header('location:'.base_url().'Master/unit'); }
    $data['update'] = 'update';
    $data['update_unit'] = 'update';
    $data['unit_info'] = $unit_info[0];
    $data['act_link'] = base_url().'Master/edit_unit/'.$unit_id;

    $data['unit_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'','','','','','','unit_id','ASC','unit');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/unit', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Unit...
  public function delete_unit($unit_id){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' || $pharm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('unit_id', $unit_id, 'unit');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/unit');
  }


/********************************* GST Slab ***********************************/
  // Add GST Slab...
  public function gst(){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' || $pharm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('gst_title', 'GST Slab Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $gst_status = $this->input->post('gst_status');
      if(!isset($gst_status)){ $gst_status = '1'; }
      $save_data = $_POST;
      $save_data['gst_status'] = $gst_status;
      $save_data['company_id'] = $pharm_company_id;
      $save_data['gst_addedby'] = $pharm_user_id;
      $user_id = $this->Master_Model->save_data('gst', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/gst');
    }

    $data['gst_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'','','','','','','gst_id','ASC','gst');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/gst', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update GST Slab...
  public function edit_gst($gst_id){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' || $pharm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('gst_title', 'GST Slab Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $gst_status = $this->input->post('gst_status');
      if(!isset($gst_status)){ $gst_status = '1'; }
      $update_data = $_POST;
      $update_data['gst_status'] = $gst_status;
      $update_data['gst_addedby'] = $pharm_user_id;
      $this->Master_Model->update_info('gst_id', $gst_id, 'gst', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/gst');
    }

    $gst_info = $this->Master_Model->get_info_arr('gst_id',$gst_id,'gst');
    if(!$gst_info){ header('location:'.base_url().'Master/gst'); }
    $data['update'] = 'update';
    $data['update_gst'] = 'update';
    $data['gst_info'] = $gst_info[0];
    $data['act_link'] = base_url().'Master/edit_gst/'.$gst_id;

    $data['gst_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'','','','','','','gst_id','ASC','gst');
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/gst', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete GST Slab...
  public function delete_gst($gst_id){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' || $pharm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('gst_id', $gst_id, 'gst');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/gst');
  }



































/********************************* SLider ***********************************/

  // Add Slider...
  public function slider(){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('slider_title', 'slider title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $slider_status = $this->input->post('slider_status');
      if(!isset($slider_status)){ $slider_status = '1'; }
      $save_data = $_POST;
      $save_data['slider_status'] = $slider_status;
      $save_data['company_id'] = $pharm_company_id;
      $save_data['slider_addedby'] = $pharm_user_id;
      $save_data['slider_date'] = date('d-m-Y');
      $save_data['slider_time'] = date('h:i:s A');
      $slider_id = $this->Master_Model->save_data('slider', $save_data);

      if($_FILES['slider_image']['name']){
        $time = time();
        $image_name = 'slider_'.$slider_id.'_'.$time;
        $config['upload_path'] = 'assets/images/slider/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['slider_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('slider_image') && $slider_id && $image_name && $ext && $filename){
          $slider_image_up['slider_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('slider_id', $slider_id, 'slider', $slider_image_up);
          // unlink("assets/images/tours/".$slider_image_old);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/slider');
    }

    $data['slider_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'','','','','','','slider_id','DESC','slider');
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('Master/slider', $data);
    $this->load->view('Include/footer', $data);
  }

  // Edit Slider...
  public function edit_slider($slider_id){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('slider_title', 'slider title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $slider_status = $this->input->post('slider_status');
      if(!isset($slider_status)){ $slider_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_slider_img']);
      $update_data['slider_status'] = $slider_status;
      $update_data['slider_addedby'] = $pharm_user_id;
      $update_data['slider_date'] = date('d-m-Y');
      $update_data['slider_time'] = date('h:i:s A');
      $this->Master_Model->update_info('slider_id', $slider_id, 'slider', $update_data);

      if($_FILES['slider_image']['name']){
        $time = time();
        $image_name = 'slider_'.$slider_id.'_'.$time;
        $config['upload_path'] = 'assets/images/slider/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['slider_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('slider_image') && $slider_id && $image_name && $ext && $filename){
          $slider_image_up['slider_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('slider_id', $slider_id, 'slider', $slider_image_up);
          if($_POST['old_slider_img']){ unlink("assets/images/slider/".$_POST['old_slider_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/slider');
    }
    $slider_info = $this->Master_Model->get_info_arr('slider_id',$slider_id,'slider');
    if(!$slider_info){ header('location:'.base_url().'Master/slider'); }
    $data['update'] = 'update';
    $data['update_slider'] = 'update';
    $data['slider_info'] = $slider_info[0];
    $data['act_link'] = base_url().'Master/edit_slider/'.$slider_id;

    $data['slider_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'','','','','','','slider_id','DESC','slider');
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('Master/slider', $data);
    $this->load->view('Include/footer', $data);
  }

  // Delete Slider...
  public function delete_slider($slider_id){
    $coach_user_id = $this->session->userdata('coach_user_id');
    $coach_company_id = $this->session->userdata('coach_company_id');
    $coach_role_id = $this->session->userdata('coach_role_id');
    if($coach_user_id == '' && $coach_company_id == ''){ header('location:'.base_url().'User'); }
    $slider_info = $this->Master_Model->get_info_arr_fields('slider_image, slider_id', 'slider_id', $slider_id, 'slider');
    if($slider_info){
      $slider_image = $slider_info[0]['slider_image'];
      if($slider_image){ unlink("assets/images/slider/".$slider_image); }
    }
    $this->Master_Model->delete_info('slider_id', $slider_id, 'slider');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/slider');
  }







  // public function sub_category_information(){
  //   $pharm_user_id = $this->session->userdata('pharm_user_id');
  //   $pharm_company_id = $this->session->userdata('pharm_company_id');
  //   $pharm_role_id = $this->session->userdata('pharm_role_id');
  //   if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }
  //   $this->load->view('Include/head');
  //   $this->load->view('Include/navbar');
  //   $this->load->view('Master/sub_category_information');
  //   $this->load->view('Include/footer');
  // }

/*********************************************** Blog *********************************/

  // Add Blog....
  public function blog(){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('blog_title', 'Batch Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $blog_status = $this->input->post('blog_status');
      if(!isset($blog_status)){ $blog_status = '1'; }
      $save_data = $_POST;
      $save_data['blog_status'] = $blog_status;
      $save_data['company_id'] = $pharm_company_id;
      $save_data['blog_addedby'] = $pharm_user_id;
      $save_data['blog_date'] = date('d-m-Y');
      $save_data['blog_time'] = date('h:i:s A');
      $blog_id = $this->Master_Model->save_data('blog', $save_data);

      if($_FILES['blog_image']['name']){
        $time = time();
        $image_name = 'blog_'.$blog_id.'_'.$time;
        $config['upload_path'] = 'assets/images/blog/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['blog_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('blog_image') && $blog_id && $image_name && $ext && $filename){
          $blog_image_up['blog_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('blog_id', $blog_id, 'blog', $blog_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/blog');
    }
    // $data['main_category_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'main_category_status','1','','','','','main_category_id','DESC','main_category');
    $data['blog_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'','','','','','','blog_id','DESC','blog');
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('Master/blog', $data);
    $this->load->view('Include/footer', $data);
  }

  // Edit/Update Blog...
  public function edit_blog($blog_id){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('blog_title', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $blog_status = $this->input->post('blog_status');
      if(!isset($blog_status)){ $blog_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_blog_image']);
      $update_data['blog_status'] = $blog_status;
      $update_data['blog_addedby'] = $pharm_user_id;
      $update_data['blog_date'] = date('d-m-Y');
      $update_data['blog_time'] = date('h:i:s A');
      $this->Master_Model->update_info('blog_id', $blog_id, 'blog', $update_data);

      if($_FILES['blog_image']['name']){
        $time = time();
        $image_name = 'blog_'.$blog_id.'_'.$time;
        $config['upload_path'] = 'assets/images/blog/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['blog_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('blog_image') && $blog_id && $image_name && $ext && $filename){
          $blog_image_up['blog_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('blog_id', $blog_id, 'blog', $blog_image_up);
          if($_POST['old_blog_image']){ unlink("assets/images/blog/".$_POST['old_blog_image']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/blog');
    }

    $blog_info = $this->Master_Model->get_info_arr('blog_id',$blog_id,'blog');
    if(!$blog_info){ header('location:'.base_url().'Master/blog'); }
    $data['update'] = 'update';
    $data['update_blog'] = 'update';
    $data['blog_info'] = $blog_info[0];
    $data['act_link'] = base_url().'Master/edit_blog/'.$blog_id;

    // $data['main_category_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'main_category_status','1','','','','','main_category_id','DESC','main_category');
    $data['blog_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'','','','','','','blog_id','DESC','blog');
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('Master/blog', $data);
    $this->load->view('Include/footer', $data);
  }

  //Delete Blog....
  public function delete_blog($blog_id){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }
    $blog_info = $this->Master_Model->get_info_arr_fields('blog_image, blog_id', 'blog_id', $blog_id, 'blog');
    if($blog_info){
      $blog_image = $blog_info[0]['blog_image'];
      if($blog_image){ unlink("assets/images/blog/".$blog_image); }
    }
    $this->Master_Model->delete_info('blog_id', $blog_id, 'blog');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/blog');
  }

/*********************************************** Product ******************************************/

  // Add Product....
  public function product(){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('product_name', 'Batch Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $product_status = $this->input->post('product_status');
      if(!isset($product_status)){ $product_status = '1'; }
      $save_data = $_POST;
      unset($save_data['attribute']);
      $save_data['product_status'] = $product_status;
      $save_data['company_id'] = $pharm_company_id;
      $save_data['product_addedby'] = $pharm_user_id;
      $product_id = $this->Master_Model->save_data('product', $save_data);

      foreach($_POST['attribute'] as $multi_data){
        $multi_data['product_id'] = $product_id;
        $multi_data['product_attribute_addedby'] = $pharm_user_id;
        $this->db->insert('product_attribute', $multi_data);
      }

      if($_FILES['product_image']['name']){
        $time = time();
        $image_name = 'product_'.$product_id.'_'.$time;
        $config['upload_path'] = 'assets/images/product/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['product_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('product_image') && $product_id && $image_name && $ext && $filename){
          $product_image_up['product_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('product_id', $product_id, 'product', $product_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/product');
    }
    $data['gst_list'] = $this->Master_Model->get_list_by_id3('','gst_status','1','','','','','gst_id','ASC','gst');
    $data['main_category_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'main_category_status','1','','','','','main_category_id','DESC','main_category');
    $data['unit_list'] = $this->Master_Model->get_list_by_id3('','unit_status','1','','','','','unit_id','ASC','unit');

    $data['product_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'','','','','','','product_id','DESC','product');
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('Master/product', $data);
    $this->load->view('Include/footer', $data);
  }

  // Edit/Update Product...
  public function edit_product($product_id){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('product_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $product_status = $this->input->post('product_status');
      if(!isset($product_status)){ $product_status = '1'; }
      $update_data = $_POST;
      unset($update_data['attribute']);
      unset($update_data['old_product_image']);
      $update_data['product_status'] = $product_status;
      $update_data['product_addedby'] = $pharm_user_id;
      $this->Master_Model->update_info('product_id', $product_id, 'product', $update_data);


      foreach($_POST['attribute'] as $multi_data){
        if(isset($multi_data['product_attribute_id'])){
          $product_attribute_id = $multi_data['product_attribute_id'];
          if(!isset($multi_data['product_attribute_price'])){
            $this->Master_Model->delete_info('product_attribute_id', $product_attribute_id, 'product_attribute');
          }else{
            $multi_data['product_attribute_addedby'] = $pharm_user_id;
            $this->Master_Model->update_info('product_attribute_id', $product_attribute_id, 'product_attribute', $multi_data);
          }
        }
        else{
          $multi_data['product_id'] = $product_id;
          $multi_data['product_attribute_addedby'] = $pharm_user_id;
          $this->db->insert('product_attribute', $multi_data);
        }
      }
      if($_FILES['product_image']['name']){
        $time = time();
        $image_name = 'product_'.$product_id.'_'.$time;
        $config['upload_path'] = 'assets/images/product/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['product_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('product_image') && $product_id && $image_name && $ext && $filename){
          $product_image_up['product_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('product_id', $product_id, 'product', $product_image_up);
          if($_POST['old_product_image']){ unlink("assets/images/product/".$_POST['old_product_image']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/product');
    }

    $product_info = $this->Master_Model->get_info_arr('product_id',$product_id,'product');
    if(!$product_info){ header('location:'.base_url().'Master/product'); }
    $data['update'] = 'update';
    $data['update_product'] = 'update';
    $data['product_info'] = $product_info[0];
    $data['act_link'] = base_url().'Master/edit_product/'.$product_id;

    $main_category_id = $product_info[0]['main_category_id'];
    $data['main_category_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'main_category_status','1','','','','','main_category_name','ASC','main_category');
    $data['sub_category_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'sub_category_status','1','main_category_id',$main_category_id,'','','sub_category_name','ASC','sub_category');
    $data['unit_list'] = $this->Master_Model->get_list_by_id3('','unit_status','1','','','','','unit_id','ASC','unit');
    $data['gst_list'] = $this->Master_Model->get_list_by_id3('','gst_status','1','','','','','gst_id','DESC','gst');

    $data['product_list'] = $this->Master_Model->get_list_by_id3($pharm_company_id,'','','','','','','product_id','DESC','product');
    $data['product_attribute_list'] = $this->Master_Model->get_list_by_id3('','product_id',$product_id,'','','','','product_attribute_id','ASC','product_attribute');
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('Master/product', $data);
    $this->load->view('Include/footer', $data);
  }

  //Delete Product....
  public function delete_product($product_id){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }
    $product_info = $this->Master_Model->get_info_arr_fields('product_image, product_id', 'product_id', $product_id, 'product');
    if($product_info){
      $product_image = $product_info[0]['product_image'];
      if($product_image){ unlink("assets/images/product/".$product_image); }
    }
    $this->Master_Model->delete_info('product_id', $product_id, 'product');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/product');
  }

  public function order_list(){
    $pharm_user_id = $this->session->userdata('pharm_user_id');
    $pharm_company_id = $this->session->userdata('pharm_company_id');
    $pharm_role_id = $this->session->userdata('pharm_role_id');
    if($pharm_user_id == '' && $pharm_company_id == ''){ header('location:'.base_url().'User'); }
    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('Master/order_list');
    $this->load->view('Include/footer');
  }




/*******************************  Check Duplication  ****************************/
  public function check_duplication(){
    $column_name = $this->input->post('column_name');
    $column_val = $this->input->post('column_val');
    $table_name = $this->input->post('table_name');
    $company_id = '';
    $cnt = $this->Master_Model->check_duplication($company_id,$column_val,$column_name,$table_name);
    echo $cnt;
  }
}
?>
