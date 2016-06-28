# Graninha

Pequeno gerenciador financeiro. Sugestões e melhorias contato@in9web.com

# Preview / Screenshot

![Preview Graninha](https://raw.githubusercontent.com/in9web/graninha/master/preview.jpg)
# Como instalar

Basta executar os seguintes comandos: 

```composer install``` 

```vendor/bin/phinx migrate```

Respectivamente irá instalar as dependencias da aplicação e depois realizar as migrações do sistema, ou seja criar o banco de dados.

# Como configurar

Após instalar você já estará apto para usar o sistema, porém caso não queira o usar o banco de dados padrão que é o sqlite você deve alterar as configurações no arquivo config.php que contem as informações de conexão ao banco de dados, assim como outras informações de debug e funcionamento da aplicação na maioria autoexplicativa.

# Como usar 

Para usar basta executar o servidor php em linha de comando com o comando abaixo ou similar:

```php -S localhost:8000```

Caso queira usar o Apache ou Nginx sugiro que leia http://www.slimframework.com/docs/start/web-servers.html#apache-configuration que contem informações para configurar de acordo com cada ferramenta desejada.

# Dicas e Sugestões

Caso encontre um problema pode abrir uma issue aqui mesmo que estaremos vendo como resolver, caso queira ajudar ainda mais pode criar um pull request ficaremos ainda mais felizes.
