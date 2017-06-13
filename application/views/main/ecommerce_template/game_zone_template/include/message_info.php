<?php 
/*=============================================================
    USING
    =================
    1.  on , controllers
        $this->model_utama->insert_data($table,$after_sanitize_element);
        $this->session->set_flashdata('success', 'Data berhasil disimpan!');
    
    2.  on , views
        $this->load->view('library/fields/message_info');
=============================================================*/

    $messages = array(
                    'warning'       =>  array(
                                            'icon'  => 'fa-exclamation',
                                            'class' => ''
                                            ),
                    'danger'        =>  array(
                                            'icon'  => 'fa-times',
                                            'class' => 'alert-danger'
                                            ),
                    'success'       =>  array(
                                            'icon'  => 'fa-check',
                                            'class' => 'alert-success'
                                            ),
                    'info'          =>  array(
                                            'icon'  => 'fa-exclamation',
                                            'class' => 'alert-info'
                                             )
                    );
                            
    foreach( $messages as $mes_status => $mes_des  ){
        $mess_result = $this->session->flashdata($mes_status);
        if( $mess_result != '' ){
            echo '  <div class="alert '.$mes_des['class'].'">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><i class="fa '.$mes_des['icon'].'"></i></strong>'.$mess_result.'</div>';
        }
    }
?>