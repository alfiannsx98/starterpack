<?php

function check_login()
{
    $ci = get_instance();

    if(!$ci->session->userdata('email'))
    {
        redirect('Auth');
    }
    else
    {
        $role_id = $ci->session->userdata('role_id');
        $menu    = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('access_user',
            [
                'role_id' => $role_id,
                'menu_id' => $menu_id
            ]
        );
        
        if($userAccess->num_rows() <1 )
        {
            redirect('auth/blocked');
        }
    }
}