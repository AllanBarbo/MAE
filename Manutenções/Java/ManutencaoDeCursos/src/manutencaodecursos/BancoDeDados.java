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

/**
 *
 * @author Aluno
 */
public class BancoDeDados<E> {
    private com.mysql.jdbc.Connection link = null;
    
    public BancoDeDados() throws SQLException{
        try{
            Class.forName("com.mysql.jdbc.Driver");
        }
        catch(ClassNotFoundException e){
            System.err.println("Driver não encontrado.");
        }
        System.err.println("Driver encontrado com sucesso!");
        link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");
        if (link != null){
            System.err.println("Conexão realizada com sucesso!");
        }else{
            System.err.println("Não foi possível realizar a conexão.");
        }
    }
    
    public ResultSet selecionarRegistros(String tabela, String pesquisa, String pesquisado) throws SQLException{
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "` WHERE " + pesquisa + " = \'" + pesquisado + "\'";
        ResultSet resultado = comando.executeQuery(query); 
        return resultado;
    }  
   
    public void criaCurso(int idDepto, String nome, int horasTotal, String modalidade) throws SQLException{
        Statement comando = link.createStatement();
        PreparedStatement co = link.prepareStatement("INSERT INTO `cursos` (`idDepto`, `nome`, `horasTotal`, `modalidade`, `ativo`) VALUES (?,?,?,?,?,'S')");
        
        //String query = "INSERT INTO `cursos` (`id`, `idDepto`, `nome`, `horasTotal`, `modalidade`, `ativo`) VALUES ('" + id + "', '" + idDepto + "', '" + nome + "', '" + horasTotal + "', '" + modalidade + "' 'S')";
        co.setInt(1,idDepto);
        co.setString(2, nome);
        co.setInt(3, horasTotal);
        co.setString(4, modalidade);
        co.execute();
    }
    
    public void apagaCurso(int id) throws SQLException{
        Statement comando = link.createStatement();
        String query = "UPDATE `cursos` SET `ativo` = 'N' WHERE `id` = " + id;
        comando.executeUpdate(query);
    }
    
    public void alteraCurso(String item, E valorItemNovo, E valorItemAntigo) throws SQLException{
        Statement comando = link.createStatement();
        String query = "UPDATE `cursos` SET " + item + " = '" + valorItemNovo + "' WHERE " + item + " = '" + valorItemAntigo + "'";
        System.out.println(query);
        comando.executeUpdate(query);
    }
}
