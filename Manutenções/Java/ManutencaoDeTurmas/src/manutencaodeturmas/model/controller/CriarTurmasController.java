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
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.Label;
import javafx.scene.control.ListView;
import javafx.scene.control.TextField;
import manutencaodeturmas.model.ManutencaoDeTurmas;

/**
 * FXML Controller class
 *
 * @author mathe
 */
public class CriarTurmasController implements Initializable {
    
    private com.mysql.jdbc.Connection link = null;
    private static ManutencaoDeTurmas main;
    
    @FXML
    private TextField nome;
    @FXML
    private TextField serie;
    @FXML
    private ChoiceBox campi;
    @FXML
    private ChoiceBox depto;
    @FXML
    private ChoiceBox curso;
   

    private ObservableList listaCampi = FXCollections.observableArrayList();
    private ObservableList listaDepto = FXCollections.observableArrayList();
    private ObservableList listaCurso = FXCollections.observableArrayList();
    private Label labelEnunciado;
    private Label labelNome;
    private Label labelSerie;
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
        if (link == null) {
            System.out.println("Erro!");
        } else {
            System.out.println("Conexao feita com sucesso!");
        }
        try {
            ResultSet resultado = selecionarRegistros("campi");
            while (resultado.next()) {
                listaCampi.add(resultado.getString("nome"));
            }
        } catch (SQLException ex) {
            Logger.getLogger(AlterarTurmasController.class.getName()).log(Level.SEVERE, null, ex);
        }

        campi.setItems(listaCampi);

        campi.getSelectionModel().selectedItemProperty().addListener(
                (observable, oldValue, newValue) -> {
                    try {
                        atualizaListaDepto(newValue.toString());
                    } catch (SQLException ex) {
                        Logger.getLogger(AlterarTurmasController.class.getName()).log(Level.SEVERE, null, ex);
                    }
                });

        depto.getSelectionModel().selectedItemProperty().addListener(
                (observable, oldValue, newValue) -> {
                    try {
                        atualizaListaCurso(newValue.toString());
                    } catch (SQLException ex) {
                        Logger.getLogger(AlterarTurmasController.class.getName()).log(Level.SEVERE, null, ex);
                    }
                });

        curso.getSelectionModel().selectedItemProperty().addListener(
                (observable, oldValue, newValue) -> {
                    setVisivel();
                });
            
    } 
    
    @FXML
    public void criaTurma() throws SQLException, IOException{
        Statement comando = link.createStatement();
        String query = "INSERT INTO `turmas` ( `idCurso`, `serie`, `nome`, `ativo`) VALUES ('" + curso.get + "', '" + serie.getText() + "', '" + nome.getText() + "', 'S');";
        comando.executeUpdate(query);
        System.out.println("Criou uma turma.");
        alteraTelaInicial();
    }
    
    @FXML
    public void alteraTelaInicial() throws IOException{
        main.abreTelaInicial();
    }
    public void setMain(ManutencaoDeTurmas main) {
        this.main = main;
    }
    
    public ResultSet selecionarRegistros(String tabela) throws SQLException {
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "`";
        ResultSet resultado = comando.executeQuery(query);
        return resultado;
    }
    
    @FXML
    public void atualizaListaDepto(String valor) throws SQLException {
        listaDepto.clear();
        listaCurso.clear();
        
        ResultSet resultado = selecionarRegistros("campi", "nome", valor);
        resultado.next();
        ResultSet resultado2 = selecionarRegistros("deptos", "idCampi", resultado.getString("id"));
        while (resultado2.next()) {
            listaDepto.add(resultado2.getString("nome"));
        }

        depto.setItems(listaDepto);
    }

    @FXML
    public void atualizaListaCurso(String valor) throws SQLException {

        listaCurso.clear();
        ResultSet resultado = selecionarRegistros("deptos", "nome", valor);
        resultado.next();
        ResultSet resultado2 = selecionarRegistros("cursos", "idDepto", resultado.getString("id"));
        while (resultado2.next()) {
            listaCurso.add(resultado2.getString("nome"));
        }

        curso.setItems(listaCurso);
    }
    public ResultSet selecionarRegistros(String tabela, String pesquisa, String pesquisado) throws SQLException {
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "` WHERE " + pesquisa + " = \'" + pesquisado + "\'";
        ResultSet resultado = comando.executeQuery(query);
        return resultado;
    }
    public void setVisivel() {
        labelEnunciado.setVisible(true);
        labelNome.setVisible(true);
        nome.setVisible(true);
        serie.setVisible(true);
        labelSerie.setVisible(true);
    }
}
