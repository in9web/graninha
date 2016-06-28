<?php
// Routes

/*$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});*/

// redirect to Dashboard/Default
$app->get('/', function ($request, $response, $args) { return $response->withRedirect('/dashboard', 200); });

$app->get('/dashboard', function ($request, $response, $args) {
    
    $data = App\TwigExtension::getTemplateVars();

    //$data['transactions'] = Transaction::simple();

    return $this->view->render($response, 'dashboard/index.twig', $data);

})->setName('dashboard_index');

$app->get('/profile/change/{id}', function ($request, $response, $args) {
    
    $data = App\TwigExtension::getTemplateVars();

    $id = (int) $args['id'];

    $data['id'] = $id;
    $msg = array();

    if ($request->isXhr()) {

        return $response->withJson($data, 201);

    } else {

        // Set flash message for next request
        foreach ($msg as $key => $message) {
            
            $this->flash->addMessage($key, $message);

        }
        
        return $response->withRedirect('/dashboard', 200);

    }

})->setName('profile_change');

$app->post('/profile', function ($request, $response, $args) {
    
    $data = App\TwigExtension::getTemplateVars();

    $msg = array();

    if ($request->isXhr()) {

        return $response->withJson($data, 201);

    } else {

        // Set flash message for next request
        foreach ($msg as $key => $message) {
            
            $this->flash->addMessage($key, $message);

        }
        
        return $response->withRedirect('/dashboard', 200);

    }

})->setName('profile_store');

$app->get('/start', function ($request, $response, $args) {
    // Sample log message
    //applog("Slim-Skeleton '/' route");
    
    $data = array();
    $data = App\TwigExtension::getTemplateVars();

    // Render index view
    return $this->view->render($response, 'index.twig', $data);
});

$app->get('/transaction', function ($request, $response, $args) {
    
    $data = App\TwigExtension::getTemplateVars();

    $data['transactions'] = Transaction::simple();

    if ($request->isXhr()) {

        return $response->withJson($data);

    } else {

        return $this->view->render($response, 'transactions/index.twig', $data);
    }

})->setName('transaction_index');

$app->get('/transaction/create', function ($request, $response, $args) {
    
    $data = App\TwigExtension::getTemplateVars();

    //$data['transactions'] = Transaction::simple();
    $data['single_page'] = true;

    if ($request->isXhr()) {

        return $response->withJson($data);

    } else {

        return $this->view->render($response, 'transactions/form.twig', $data);
    }

})->setName('transaction_create');

$app->get('/transaction/{id}/edit', function ($request, $response, $args) {
    
    $data = App\TwigExtension::getTemplateVars();

    //$data['transactions'] = Transaction::simple();
    $id = (int)$args['id'];

    $data['transaction'] = Transaction::find($id);
    $data['single_page'] = true;

    if ($request->isXhr()) {

        return $response->withJson($data);

    } else {

        return $this->view->render($response, 'transactions/form.twig', $data);
    }

})->setName('transaction_edit');

$app->post('/transaction', function ($request, $response, $args) {
    
    $data = App\TwigExtension::getTemplateVars();

    $t = new Transaction;
    
    $saved = $t->saveFromPost();

    $msg = array();
    
    if ($saved) {
        
        $msg['ok'] = 'Woohoo! Salvo com sucesso.';

    } else {
        
        $msg['error'] = 'Ops! Problema ao salvar dados.';
    }
    
    $data['result'] = $t;
    $data['msg'] = $msg;
    
    if ($request->isXhr()) {

        return $response->withJson($data, 201);

    } else {

        // Set flash message for next request
        foreach ($msg as $key => $message) {
            
            $this->flash->addMessage($key, $message);

        }
        
        //return $response->withRedirect('/transaction', 200);
        return $response->write('<script>parent.location.reload(true);parent.$.colorbox.close();</script>', 200);

    }

})->setName('transaction_store');

$app->delete('/transaction/{id}', function ($request, $response, $args) {

    $id = (int) $args['id'];

    $t = Transaction::find($id);
    $deleted = $t->delete();

    if ($deleted) {
    
        $msg['ok'] = 'Woohoo! Salvo com sucesso.';

    } else {
        
        $msg['error'] = 'Ops! Problema ao salvar dados.';
    }
    
    $data['result'] = $t;
    $data['msg'] = $msg;
    
    if ($request->isXhr()) {

        return $response->withJson($data, 200);

    } else {

        // Set flash message for next request
        foreach ($msg as $key => $message) {
            
            $this->flash->addMessage($key, $message);

        }
        
        return $response->withRedirect('/transaction', 200);

    }

})->setName('transaction_destroy');