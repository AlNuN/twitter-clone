<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

    // Checks if superglobal GET has login key
    $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('index');
	}

  public function inscreverse(){

    // empty fields when pages load
    $this->view->usuario = array(
      'nome' => '',
      'email' => '',
      'senha' => '',);

    $this->view->erroCadastro = false;
    $this->render('inscreverse');
  }

  public function registrar(){

    //Instantiate user from App\Models\Usuario.php
    $usuario =  Container::getModel('Usuario');

    $usuario->__set('nome', $_POST['nome']);
    $usuario->__set('email', $_POST['email']);
    $usuario->__set('senha', $_POST['senha']);

    if($usuario->validarCadastro()){
        if(count($usuario->getUsuarioPorEmail()) > 0) {

            $this->view->usuario = array (
                'nome' => $_POST['nome'],
                'email' => $_POST['email'].' (email já cadastrado)',
                'senha' => $_POST['senha']
            );
            $this->view->erroCadastro = 2;
            $this->render('inscreverse');

        } else {
            $usuario->__set('senha', md5($_POST['senha']));
            $usuario->salvar();
            $this->render('cadastro');
        }

    } else {
        $this->view->usuario = array(
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha']
        );
        $this->view->erroCadastro = 1;
        $this->render('inscreverse');
    }
}

}

?>
