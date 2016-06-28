<?php 

function app()
{
    return $GLOBALS['app'];
}

function applog($message, $type='info')
{
    return app()->getContainer()->logger->$type($message);
}

/**
 * get_url_conditions Pega os parametros de filtros/condicoes para o banco de dados
 * @param  array  $options redinifir configs basicas
 * @return array          retorna array com dados basico para auxiliar na consulta
 */
function get_url_conditions($options=array())
{
    $defaults = array(
        'limit' => 10
    );
    $defaults = array_merge($defaults, $options);

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? $_GET['limit'] : $defaults['limit'];

    $offset = ($page-1) * $limit;

    return array(
        'limit'  => $limit,
        'offset' => $offset
    );
}

function add_message($key, $message)
{
    return app()->getContainer()->flash->addMessage($key, $message);
}

function get_message($key, $pre='', $pos='')
{
    $msg = app()->getContainer()->flash->getMessage($key);

    $new_msg = array();
    
    if (!empty($msg)) {

        foreach ($msg as $message) {
            
            $new_msg[] = $pre.$message.$pos;

        }

    }

    return $new_msg;
}

function show_message($key, $pre='', $pos='', $glue='')
{
    echo implode($glue, get_message($key, $pre, $pos));
}