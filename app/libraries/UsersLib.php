<?php

if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

// Validaciones para el modelo de usuarios (login, cambio clave, CRUD Usuario)
class UsersLib
{

    private $ci;
    protected $isLogged;

    public function __construct()
    {
        $this->ci = &get_instance(); // Esto para acceder a la instancia que carga la librería
        //$this->ci->load->model('Usereloquent');
        //$this->ci->load->model('Roleeloquent');
        //$this->isLogged = FALSE;
    }

    public function getUsers()
    {
        $this->ci->load->model('User_model');
        $this->ci->load->model('Role_model');
        $listUsers = array();
        try {
            //if(isset($this->ci->session->userdata('usuario'))){
                //Prueba de que sirve
                $listUsers = User_model::leftjoin('t_role_user', 't_users.id', '=', 't_role_user.user_id')
                    ->leftjoin('t_roles', 't_roles.id', '=', 't_role_user.role_id')
                    ->select('t_users.id', 't_users.username', 't_users.display_name','t_roles.roledisplay')
                    ->orderBy('t_users.updated_at', 'desc')
                    ->get();
            //} else {
                //return [];
            //}
        } catch (\Throwable $th) {
            return [];
        }

        return $listUsers;
    }


}