<?php
namespace App\Clientes\Models2;

/**
 * Model da tabela 'Users'
 *
 * @package App\Users\Models
 * @author Otávio Augusto Borges Pinto <otavio@agenciasys.com.br>
 * @copyright Softers Sistemas de Gestão © 2016
 */
class Livros extends \App\Models\BaseModel
{
    /**
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $iLivroId;

    /**
     * @Column(type="string", length=10, nullable=false)
     */
    public $iClienteId;

    /**
     * @Column(type="string", length=15, nullable=false)
     */
    public $sLivro;
}
