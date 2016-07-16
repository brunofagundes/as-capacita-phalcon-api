<?php
namespace App\Clientes\Controllers2;

use App\Controllers\RESTController;
use App\Clientes\Models2\Clientes;

/**
 * Gerencia as requisições para o módulo admin.
 *
 * @package App\Users\Controllers
 * @author Otávio Augusto Borges Pinto <otavio@agenciasys.com.br>
 * @copyright Softers Sistemas de Gestão © 2016
 */
class ClientesController extends RESTController
{
    /**
     * Retorna uma lista de Usuários.
     *
     * @access public
     * @return Array Lista de Usuários.
     */
    public function getClientes()
    {
        try {
            $query = new \Phalcon\Mvc\Model\Query\Builder();
            $query->addFrom('\App\Clientes\Models2\Clientes', 'Clientes')
                ->columns(
                    [
                        'Clientes.iClienteId',
                        'Clientes.sNome',
                        'Clientes.sEmail',
                        'Livros.iLivroId',
                        'Livros.iClienteId as iLivroClienteId',
                        'Livros.sLivro',
                    ]
                )
                ->leftJoin('\App\Clientes\Models2\Livros', 'Livros.iClienteId = Livros.iClienteId', 'Livros')
                ->where('true');

               /* print_r($query
                ->getQuery()->getSql()['sql']);
                exit();
                   */
            return $query
                ->getQuery()
                ->execute();

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Retorna um Usuário.
     *
     * @access public
     * @return Array Usuário.
     */
    public function getCliente($iClienteId)
    {
        try {
            $clientes = (new Clientes())->findFirst(
                [
                    'conditions' => "iClienteId = '$iClienteId'",
                    'columns' => $this->partialFields,
                ]
            );

            return $clientes;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Adiciona um Usuário.
     *
     * @access public
     * @return Array Usuário.
     */
    public function addCliente()
    {
        try {
            $clientesModel = new Clientes();
            $clientesModel->sNome = $this->di->get('request')->getPost('sNome');
            $clientesModel->sEmail = $this->di->get('request')->getPost('sEmail');

            $clientesModel->saveDB();

            return $clientesModel;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Editar o campo de um Usuário.
     *
     * @access public
     * @return Array.
     */
    public function editCliente($iClienteId)
    {
        try {
            $put = $this->di->get('request')->getPut();

            $cliente = (new Clientes())->findFirst($iClienteId);

            if (false === $cliente) {
                throw new \Exception("This record doesn't exist", 200);
            }

            $cliente->sNome = isset($put['sName']) ? $put['sName'] : $cliente->sNome;
            $cliente->sEmail = isset($put['sEmail']) ? $put['sEmail'] : $cliente->sEmail;

            $cliente->saveDB();

            return $cliente;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Remove um Usuário.
     *
     * @access public
     * @return boolean.
     */
    public function deleteCliente($iClienteId)
    {
        try {
            $cliente = (new Clientes())->findFirst($iClienteId);

            if (false === $cliente) {
                throw new \Exception("This record doesn't exist", 200);
            }

            return ['success' => $cliente->delete()];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
