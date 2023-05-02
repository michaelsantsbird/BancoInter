# BancoInter
Integração Banco Inter com PHP - Fácil e sem composer

O arquivo verboletos.php já esta com a criação do token e a geração dos boletos

O aquivo token.php é apenas para gerar o Token e poder ser usado para qualquer aplicação, ele ja esta separando o JSON e pegando apenas co acess_token.

É muito fácil a integração, basta fazer as alteração do diretórios dos arquivos da CHAVE e do CERTIFICADO e alterar o client_id e o Client_secret. Lembrando que quando efetuar a criação da aplicação no app do banco inter, será necessário efetuar o download dos arquivos (chave e certificado) e armazena no diretorio que a aplicação vai buscar.

# Para criar a Aplicação (API) no banco inter, basta seguir os seguintes passo:

1. Acesse sua conta pelo Internet Banking;

2. Depois vá em "Conta Digital";

3. Em seguida procure por "Aplicações" e clique em "Nova Aplicação";

4. Será necessário criar um nome e definir uma descrição da Aplicação, da forma que desejar, pois é apenas a título de controle gerencial sobre as aplicações que assina com o Inter. Em seguida, clique em "Próximo";

5. Selecione quais permissões você quer fornecer a cada API. Ela terá acesso à todas as informações necessárias para as permissões específicas que selecionar.

6. Após selecionar as API`s, clique em "Criar Aplicação";

7. A Aplicação foi criada com sucesso!

8. Para completar a integração, é preciso baixar a "Chave da Aplicação" e o seu "Certificado".

9. Volte na aplicação e copie o CLIENT_SECRET e o CLIENT_ID.


# Caso queira outras Formas de integração, basta acessar o site: https://developers.bancointer.com.br

Gostou? 
Serviu para sua aplicação?

Podendo ajudar, segue meu PIX
71992010758





