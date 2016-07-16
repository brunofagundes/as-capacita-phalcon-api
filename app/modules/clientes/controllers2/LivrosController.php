<?php
namespace App\Clientes\Controllers2;

use App\Controllers\RESTController;
use App\Clientes\Models2\Livros;

/**
 * Gerencia as requisições para o módulo admin.
 *
 * @package App\Phones\Controllers
 * @author Otávio Augusto Borges Pinto <otavio@agenciasys.com.br>
 * @copyright Softers Sistemas de Gestão © 2016
 */
class LivrosController extends RESTController
{
    /**
     * Retorna uma lista de Usuários.
     *
     * @access public
     * @return Array Lista de Usuários.
     */
    public function getLivros()
    {
        try {
            $livros = (new Livros())->find(
                [
                    'conditions' => 'true ' . $this->getConditions(),
                    'columns' => $this->partialFields,
                    'limit' => $this->limit
                ]
            );

            return $livros;
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
    public function getLivro($iLivroId)
    {
        try {
            $livros = (new Livros())->findFirst(
                [
                    'conditions' => "iLivroId = '$iLivroId'",
                    'columns' => $this->partialFields,
                ]
            );

            return $livros;
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
    public function addLivro()
    {
        try {
            $livros = new Livros();
            //$livros->iLivroId = $this->di->get('request')->getPost('iLivroId');
            $livros->sLivro = $this->di->get('request')->getPost('sLivro');
            $livros->iClienteId = $this->di->get('request')->getPost('iClienteId');
            $livros->saveDB();

            return $livros;
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
    public function editLivro($iLivroId)
    {
        try {
            $put = $this->di->get('request')->getPut();

            $livro = (new Livros())->findFirst($iLivroId);

            if (false === $livro) {
                throw new \Exception("This record doesn't exist", 200);
            }

            $livro->iClienteId = isset($put['iClienteId']) ? $put['iClienteId'] : $livro->iClienteId;
            $livro->sLivro = isset($put['sLivro']) ? $put['sLivro'] : $livro->sLivro;

            $livro->saveDB();

            return $livro;
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
    public function deleteLivro($iLivroId)
    {
        try {
            $livro = (new Livros())->findFirst($iLivroId);

            if (false === $livro) {
                throw new \Exception("This record doesn't exist", 200);
            }

            return ['success' => $livro->delete()];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
