<?php
return call_user_func(
    function () {
        $clienteCollection = new \Phalcon\Mvc\Micro\Collection();

        $clienteCollection
            ->setPrefix('/v1/livros')
            ->setHandler('\App\Clientes\Controllers2\LivrosController')
            ->setLazy(true);

        $clienteCollection->get('/', 'getLivros');
        $clienteCollection->get('/{id:\d+}', 'getLivro');

        $clienteCollection->post('/', 'addLivro');

        $clienteCollection->put('/{id:\d+}', 'editLivro');

        $clienteCollection->delete('/{id:\d+}', 'deleteLivro');

        return $clienteCollection;
    }
);
