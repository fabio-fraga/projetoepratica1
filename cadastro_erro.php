<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastro</title>
    <link href="css/cadastro.css" rel="stylesheet">
</head>
<body>

    <header>
        <a href="/"><img src="img/Logo-Forum.png"></a>          

        <form action="pesquisar.php" method="POST" id="form-pesquisa">
            <input type="text" name="pesquisar" placeholder="Pesquisar" id="input-pesquisa">
            <input type="image" src="img/lupa.png" id="submit-pesquisa">
        </form>

    </header>

    <div class="div-principal">

        <h1 id="msgboasvindas">Ficou em dúvida sobre como responder determinada questão? Crie tópicos, responda perguntas e interaja com a comunidade do <span>Fórum</span> <span id="forall">For All</span> !</h1>
        
        <div class="div-form-erro">
            
    <form action="cadastro_validacao.php" method="POST">

        <h1>Cadastre-se!</h1>
        <input type="text" name="nome" placeholder="Nome de usuário - ID" id="input-nome"/>
        <input type="text" name="email" placeholder="Endereço de e-mail"/>                
        <input type="password" name="senha" placeholder="Senha"/> 
        <input type="password" name="redigitar_senha" placeholder="Digite a senha novamente"/>
        <input type="submit" value="Registrar"/>

    </form>

        <p id="p-erro"><?=$report_erro?></p>

    <br>
    <br>
    <br>

    <h1 id="login">Já possui uma conta? <a href="/">Faça login</a>!</h1>
        
        </div>

    </div>
   
    <footer>
        <table>
            <tr>
                <td class="borda-right">
                    <h1>Sobre</h1>
                        <p>
                            <strong>1.Construção: </strong>
                                Projeto desenvolvido para a disciplina de <strong>Projeto e Prática I</strong> do curso de <strong>Informática Para Internet</strong> do <strong>Instituto Federal de Educação, Ciência e Tecnologia de Pernambuco - campus Igarassu</strong>. 
                        </p>
                        <p>
                            <strong>2.Desenvolvedores: </strong>
                            <ul>
                                <li>Danilo Monteiro da Silva;</li>
                                <li>Everthon Henrique da Paz Barbosa;</li>
                                <li>Fábio Moura de Fraga;</li>
                                <li>Emerson Gabriel Queiroz de Moura;</li>
                                <li>Gabriel Barros Teixeira;</li>
                                <li>Guilherme Valença Rodrigues Pereira;</li>
                                <li>Paulo Vinícius Santos do Carmo.</li>

                            </ul>
                        </p>
                        <p>
                            <strong>3.Orientador: </strong>
                                <ul>
                                    <li>Prof. Alexandre Strapação Guedes Vianna. </li>
                                </ul>                    
                        </p>
                        <p>
                            <strong>4.Documentação: </strong>
                                <ul>
                                    <li>Link: <a href="PDF/Proposta - Projeto e Prática 1 - Fórum IFPE.pdf"><strong>Clique aqui!</strong></a></li>
                                </ul>                     
                        </p>

                        <img src="img/Ifpe_logo.png" class="foto-footer">
                </td>

                <td class="borda-right">
                    <h1>Ajuda/Instruções:</h1>
                        <p>
                            <strong>1.Objetivo: </strong>
                                O Fórum For All foi desenvolvido com o propósito de auxiliar os profissionais e estudantes na resolução de determinadas perguntas. Além disso, incentivar a interação entre as pessoas, fazendo com que compartilhem seus conhecimentos e experiências também é um dos nossos principais ideais. 
                        </p> 
                        <p>
                            <strong>2.Login: </strong>
                                Para realizar o login, o usuário só precisa inserir o ID ou e-mail e a senha utilizados quando se cadastrou no site.
                        </p>
                        <p>
                            <strong>3.Cadastro: </strong>
                                Para realizar o cadastro, será necessário que o usuário crie um ID - que ainda não exista e que não possua caracteres especiais, espaços e letras acentuadas -, tenha uma conta de e-mail válida e utilize uma senha com 8 caracteres no mínimo.
                        </p>
                        <p>
                            <strong>4.Funcionalidades: </strong>
                                Qualquer usuário, cadastrado ou não, pode criar tópicos, ou seja, fazer perguntas. Ademais, o Fórum For All disponibiliza "Salas" nas quais os usuários de determinado curso podem interagir com os outros membros também cadastrados na turma.
                        </p> 
                </td>

                <td>
                    <img src="img/versao.png" class="versao-footer">
                    <p>Versão 1.0 Alfa.</p>
                </td>
            </tr>
        </table> 
    </footer>

</body>
</html>