/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package teste3;

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

/**
 *
 * @author Aluno
 * @param <E>
 */
public class ManutencaoDeTurmasController<E> implements Initializable {
    private com.mysql.jdbc.Connection link = null;
    private Teste3 main;
    @FXML
    private TextField idAntigo;
    @FXML
    private TextField idTurma;
    @FXML
    private TextField idCurso;
    @FXML
    private TextField nome;
      
    public ResultSet selecionarRegistros(String tabela, String pesquisa, String pesquisado) throws SQLException{
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "` WHERE " + pesquisa + " = \'" + pesquisado + "\'";
        ResultSet resultado = comando.executeQuery(query); 
        return resultado;
    }  
   
    @FXML
    public void criaTurma() throws SQLException{
        Statement comando = link.createStatement();
        String query = "INSERT INTO `turmas` (`idCurso`, `nome`, `ativo`) VALUES ('" + idCurso.getText() + "', '" + nome.getText() + "', 'S');";
        comando.executeUpdate(query);
        System.out.println("Criou uma turma.");
    }
    
    @FXML
    public void apagaTurma() throws SQLException{
        Statement comando = link.createStatement();
        String query = "UPDATE `turmas` SET `ativo` = 'N' WHERE `turmas`.`id` = " + idTurma.getText();
        comando.executeUpdate(query);
        System.out.println("Apaguei a turma.");
    }
    
    @FXML
    public void alteraTurma() throws SQLException{
        ResultSet resultado = selecionarRegistros("turmas", "id", idAntigo.getText());
        resultado.first();
        System.out.println(resultado.getString("nome"));
        Statement comando = link.createStatement();
        String query = "UPDATE `turmas` SET `nome` = '" + nome.getText() + "' WHERE `nome` = '" + resultado.getString("nome") + "'";
        comando.executeUpdate(query);
        System.out.println("Alterei turma.");
    }
    
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // TODO
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");
            if(link == null){
                System.out.println("Erro!");
            }else{
                System.out.println("Sout");
            }
        } catch (SQLException ex) {
            Logger.getLogger(ManutencaoDeTurmasController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    @FXML
    public void alteraTelaCriarTurma() throws IOException{

        main.abreCriaTurma();
    }
    
    @FXML
    public void alteraTelaAlterarTurma() throws IOException{
        main.abreAlteraTurma();
    }
    
    @FXML
    public void alteraTelaApagarTurma() throws IOException{
        main.abreApagaTurma();
    }

    public void setMain(Teste3 main) {
        this.main = main;
    }
    
    
}
