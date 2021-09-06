# BITRIX APP
***
#### Este é um projeto de CRUD integrado à api do sistema Bitrix, para realizar o registro, edição e exclusão de empresas e contatos relacionados através de chamadas de Webhook

## Ferramentas
***
O projeto foi construído utilizando o framework laravel 8 para as ações do backend, integrado ao framework Vue.js no frontend

## Estrutura do Banco de Dados
***
O banco de dados é composto por duas tabelas, além da tabela de migrations:

1. COMPANIES - Armazena o ID, Título, Renda, Telefones e E-mails da empresa, além de um timestamp de criação e atualização
2. CONTACTS - Armazena o ID, Nome, Sobrenome e ID da empresa à qual o contato pertence, além de um timestamp de criação e atualização


## Tela inicial
***
A tela inicial apresenta uma lista de todas as empresas cadastradas que foram salvas no banco de dados e seus cadastros refletidos no CRM do Bitrix.  

As empresas podem ser cadastradas com os seguintes dados: 
- ID (gerado automaticamente pela resposta do webhook de criação)
- Nome
- Receita anual
- Telefones*
- E-mails*
- Contatos*

\* Estes itens permitem o cadastro de mais de um por empresa

Além dos dados relacionados acima, para cada empresa diferente são apresentados os botões para editá-la ou exclui-la.

## Tela de criação de empresas
***
Ao apertar o botão "Novo Registro" na tela inicial o usuário é encaminhado à tela de "NOVA EMPRESA".

A tela de criação permite a adição de um ou mais dados para a criação de uma nova empresa que será salva no banco de dados e no CRM Bitrix.

Os botões de "adicionar telefone", "adicionar e-mail" e "adicionar contato" permitem a adição de mais de um destes elementos de uma vez.

Ao apertar o botão de salvar é enviado uma chamada ao endpoint **'crm.company.add'** e, havendo um ou mais contatos, ao endpoint **'crm.contact.add'** e **'crm.company.contact.add'** para criação e vínculo destas entidades no CRM. Ao mesmo tempo, são salvos os dados no banco de dados.

## Tela de edição de empresas
***
Ao apertar para "Editar" uma empresa presente na lista, o usuário é encaminhado para uma página de edição da empresa à qual o botão se refere.

A página é similar à página de criação, mas realiza a atualização dos dados da empresa e contatos já salvos, tanto no Bitrix, através dos endpoints **'crm.company.update'**, **'crm.contact.update'**, **'crm.contact.add'** e **'crm.company.contact.add'**', quanto no Banco de dados.

## Exclusão de empresas
***
Ao apertar para "Excluir" uma empresa presente na lista, a aplicação excluirá a empresa à qual o botão se refere, assim como os contatos relacionados a ela tanto no Bitrix quanto no banco de dados.

A exclusão no Bitrix ocorre através de chamadas aos endpoints **'crm.company.delete'** e **'crm.contact.delete'**.