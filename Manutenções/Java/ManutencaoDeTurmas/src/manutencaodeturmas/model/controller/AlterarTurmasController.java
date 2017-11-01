/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutencaodeturmas.model.controller;

import java.io.IOException;
import java.net.URL;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.TextField;
import manutencaodeturmas.model.ManutencaoDeTurmas;

/**
 * FXML Controller class
 *
 * @author mathe
 */
public class AlterarTurmasController implements Initializable {
    private ManutencaoDeTurmas main;
    private com.mysql.jdbc.Connection link;
    
    @FXML
    private TextField nome;
    @FXML
    private TextField idAntigo;
    @FXML
    private TextField idCurso;
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // TODO
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");
        } catch (SQLException ex) {
            Logger.getLogger(AlterarTurmasController.class.getName()).log(Level.SEVERE, null, ex);
        }
        if(link == null)
            System.out.println("Erro!");
        else
            System.out.println("Conexao feita com sucesso!");
            
    } 
    
    
    @FXML
    public void alteraTurma() throws SQLException, IOException{
        ResultSet resultado = selecionarRegistros("turmas", "id", idAntigo.getText());
        resultado.first();
        Statement comando = link.createStatement();
        if(nome.getText().equals("") && idCurso.getText().equals("")){
            System.out.println("Dados inalterados.");
        }
        else if(!nome.getText().equals("") && idCurso.getText().equals("")){
            String query = "UPDATE `turmas` SET `nome` = '" + nome.getText() + "' WHERE `nome` = '" + resultado.getString("nome") + "'";
            comando.executeUpdate(query);
        }
        else if(nome.getText().equals("") && !idCurso.getText().equals("")){
            String query = "UPDATE `turmas` SET `idCurso` = '" + idCurso.getText() + "' WHERE `idCurso` = '" + resultado.getString("idCurso") + "'";
            comando.executeUpdate(query);
        }
        else{
            String query = "UPDATE `turmas` SET `idCurso` = '" + idCurso.getText() + "' WHERE `idCurso` = '" + resultado.getString("idCurso") + "'";
            comando.executeUpdate(query);
            query = "UPDATE `turmas` SET `nome` = '" + nome.getText() + "' WHERE `nome` = '" + resultado.getString("nome") + "'";
            comando.executeUpdate(query);
        }
        
       
        System.out.println("Alterei turma.");
        alteraTelaInicial();
    }
    
    public ResultSet selecionarRegistros(String tabela, String pesquisa, String pesquisado) throws SQLException{
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "` WHERE " + pesquisa + " = \'" + pesquisado + "\'";
        ResultSet resultado = comando.executeQuery(query); 
        return resultado;
    }
 
    public void alteraTelaInicial() throws IOException{
        main.abreTelaInicial();
    }
    public void setMain(ManutencaoDeTurmas main) {
        this.main = main;
    }
}
