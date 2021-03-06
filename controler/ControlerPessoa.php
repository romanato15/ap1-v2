<?php

class ControllerPessoa
{

    private $_method;
    private $_modelPessoa;
    private $_codPessoa;

    public function __construct($model)
    {
        $this->_modelPessoa = $model;
        $this->_method = $_SERVER['REQUEST_METHOD'];

         //permite receber dados json através da requisição
         $json = file_get_contents("php://input");
         $dadosPessoa = json_decode($json);

         $this->_codPessoa = $dadosPessoa->cod_pessoa ?? null;

         //this -> diferenciar atributos do escopo da classe e atributos que servem somente 
         //na função local
    }

    function router()
    {
        switch ($this->_method) {
            case 'GET':

                if (isset($this->_codPessoa)) {
                    return $this->_modelPessoa->findById();
                }

                return $this->_modelPessoa->findAll();
                break;

            case 'POST':
                return $this->_modelPessoa->create();
                break;

            case 'PUT':
                return $this->_modelPessoa->update();
                break;

            case 'DELETE':
                return $this->_modelPessoa->delete();
                break;

            default:
                # code...
                break;
        }
    }
}
