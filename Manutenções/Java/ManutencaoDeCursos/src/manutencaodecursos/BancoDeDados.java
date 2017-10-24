/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutencaodecursos;

import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

/*
    Grupo:​ ​ MAE.
    Data​ ​ de​ ​ modificação:​ ​ 24/10/2017.
    Autor:​ ​Matheus Quintão Santiago.
    ​Objetivo​ ​ da​ ​ modificação:​ ​ Padronizando o codigo e comentando.
*/
public class BancoDeDados<E> {
    private com.mysql.jdbc.Connection link = null;
    
    public BancoDeDados() throws SQLException{
        
        //Testa se o driver de JDBC para Mysql esta no projeto.
        try{
            Class.forName("com.mysql.jdbc.Driver");
        }
        catch(ClassNotFoundException e){
            System.err.println("Driver não encontrado.");
        }
        System.err.println("Driver encontrado com sucesso!");
        
        //Faz a conexão com o banco de dados.
        link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");
        if (link != null){
            System.err.println("Conexão realizada com sucesso!");
        }else{
            System.err.println("Não foi possível realizar a conexão.");
        }
    }
    
    // Método para selecionar os registros de uma tabela que o usuario queira.
    public ResultSet selecionarRegistros(String tabela, String pesquisa, String pesquisado) throws SQLException{
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "` WHERE " + pesquisa + " = \'" + pesquisado + "\'";
        ResultSet resultado = comando.executeQuery(query); 
        return resultado;
    }  
   
    // Método para criar um curso.
    public void criaCurso(int idDepto, String nome, int horasTotal, String modalidade) throws SQLException{
        Statement comando = link.createStatement();
        PreparedStatement co = link.prepareStatement("INSERT INTO `cursos` (`idDepto`, `nome`, `horasTotal`, `modalidade`, `ativo`) VALUES (?,?,?,?,'S')");
        co.setInt(1,idDepto);
        co.setString(2, nome);
        co.setInt(3, horasTotal);
        co.setString(4, modalidade);
        co.execute();
    }
    
    // Método para deletar um curso.
    public void apagaCurso(int id) throws SQLException{
        Statement comando = link.createStatement();
        String query = "UPDATE `cursos` SET `ativo` = 'N' WHERE `id` = " + id;
        comando.executeUpdate(query);
    }
    
    // Método para alterar um curso.
    public void alteraCurso(String item, E valorItemNovo, E valorItemAntigo) throws SQLException{
        Statement comando = link.createStatement();
        String query = "UPDATE `cursos` SET " + item + " = '" + valorItemNovo + "' WHERE " + item + " = '" + valorItemAntigo + "'";
        System.out.println(query);
        comando.executeUpdate(query);
    }
}
