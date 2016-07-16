<?php
namespace App\Clientes\Models2;

/**
 * Model da tabela 'Users'
 *
 * @package App\Users\Models
 * @author Otávio Augusto Borges Pinto <otavio@agenciasys.com.br>
 * @copyright Softers Sistemas de Gestão © 2016
 */
class Clientes extends \App\Models\BaseModel
{
    /**
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $iClienteId;

    /**
     * @Column(type="string", length=70, nullable=false)
     */
    public $sNome;

    /**
     * @Column(type="string", length=70, nullable=false)
     */
    public $sEmail;

    /**
     * @Column(type="datetime", nullable=false)
     */
    public $dtCriacao;

    /**
     * @Column(type="datetime", nullable=true)
     */
    public $dtAtualizada;

    public function beforeCreate()
    {
        $this->dtCriacao = (new \DateTime())->format('Y-m-d H:i:s');
        $this->dtAtualizada = '0000-00-00 00:00:00';
    }

    public function beforeUpdate()
    {
        $this->dtAtualizada = (new \DateTime())->format('Y-m-d H:i:s');
    }
}
