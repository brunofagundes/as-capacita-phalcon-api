<?php
return call_user_func(
    function () {
        $clienteCollection = new \Phalcon\Mvc\Micro\Collection();

        $clienteCollection
            ->setPrefix('/v1/clientes')
            ->setHandler('\App\Clientes\Controllers2\ClientesController')
            ->setLazy(true);

        $clienteCollection->get('/', 'getClientes');
        $clienteCollection->get('/{id:\d+}', 'getCliente');

        $clienteCollection->post('/', 'addCliente');

        $clienteCollection->put('/{id:\d+}', 'editCliente');

        $clienteCollection->delete('/{id:\d+}', 'deleteCliente');

        return $clienteCollection;
    }
);
