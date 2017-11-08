/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutencaodecurso.model.controller;

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
import manutencaodecurso.model.ManutencaoDeCurso;

/**
 * FXML Controller class
 *
 * @author mathe
 */
public class AlterarCursoController implements Initializable {

    private ManutencaoDeCurso main;
    private com.mysql.jdbc.Connection link;

    @FXML
    private TextField nome;
    @FXML
    private TextField idDepto;
    @FXML
    private TextField horasTotais;
    @FXML
    private TextField modalidade;
    @FXML
    private Label labelEnunciado;
    @FXML
    private Label labelNome;
    @FXML
    private Label labelIdDepto;
    @FXML
    private Label labelModalidade;
    @FXML
    private Label labelHorasTotais;
    
    
    

    @FXML
    private ChoiceBox campi;
    @FXML
    private ChoiceBox depto;
    @FXML
    private ListView curso;


    private ObservableList listaCampi = FXCollections.observableArrayList();
    private ObservableList listaDepto = FXCollections.observableArrayList();
    private ObservableList listaCurso = FXCollections.observableArrayList();

    /**
     * Initializes the controller class.
     *
     * @param url
     * @param rb
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // TODO
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");
        } catch (SQLException ex) {
            Logger.getLogger(AlterarCursoController.class.getName()).log(Level.SEVERE, null, ex);
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
            Logger.getLogger(AlterarCursoController.class.getName()).log(Level.SEVERE, null, ex);
        }

        campi.setItems(listaCampi);

        campi.getSelectionModel().selectedItemProperty().addListener(
                (observable, oldValue, newValue) -> {
                    try {
                        atualizaListaDepto(newValue.toString());
                    } catch (SQLException ex) {
                        Logger.getLogger(AlterarCursoController.class.getName()).log(Level.SEVERE, null, ex);
                    }
                });

        depto.getSelectionModel().selectedItemProperty().addListener(
                (observable, oldValue, newValue) -> {
                    try {
                        atualizaListaCurso(newValue.toString());
                    } catch (SQLException ex) {
                        Logger.getLogger(AlterarCursoController.class.getName()).log(Level.SEVERE, null, ex);
                    }
                });

        curso.getSelectionModel().selectedItemProperty().addListener(
                (observable, oldValue, newValue) -> {
                    setVisivel();
                });

    }

    @FXML
    public void alteraCurso() throws SQLException, IOException {
        String nomeFormatado = curso.getSelectionModel().getSelectedItems().toString().replace("[", "");
        nomeFormatado = nomeFormatado.replace("]", "");
        ResultSet resultado = selecionarRegistros("cursos", "nome", nomeFormatado);
        resultado.first();

        Statement comando = link.createStatement();
                
        if(!nome.getText().equals("")){
            String query = "UPDATE `cursos` SET `nome` = '" + nome.getText() + "' WHERE `id` = '" + resultado.getString("id") + "'";
            comando.executeUpdate(query);
        }
        
        if(!idDepto.getText().equals("")){
            String query = "UPDATE `cursos` SET `nome` = '" + idDepto.getText() + "' WHERE `id` = '" + resultado.getString("id") + "'";
            comando.executeUpdate(query);
        }
        
        if(!horasTotais.getText().equals("")){
            String query = "UPDATE `cursos` SET `horasTotal` = '" + horasTotais.getText() + "' WHERE `id` = '" + resultado.getString("id") + "'";
            comando.executeUpdate(query);
        }
        
        if(!modalidade.getText().equals("")){
            String query = "UPDATE `cursos` SET `horasTotal` = '" + modalidade.getText() + "' WHERE `id` = '" + resultado.getString("id") + "'";
            comando.executeUpdate(query);
        }

        alteraTelaInicial();
    }

    public ResultSet selecionarRegistros(String tabela, String pesquisa, String pesquisado) throws SQLException {
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "` WHERE " + pesquisa + " = \'" + pesquisado + "\'";
        ResultSet resultado = comando.executeQuery(query);
        return resultado;
    }

    public ResultSet selecionarRegistros(String tabela) throws SQLException {
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "`";
        ResultSet resultado = comando.executeQuery(query);
        return resultado;
    }

    public void alteraTelaInicial() throws IOException {
        main.abreTelaInicial();
    }

    public void setMain(ManutencaoDeCurso main) {
        this.main = main;
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

    public void setVisivel() {
        labelEnunciado.setVisible(true);
        labelNome.setVisible(true);
        labelIdDepto.setVisible(true);
        labelHorasTotais.setVisible(true);
        labelModalidade.setVisible(true);
        nome.setVisible(true);
        idDepto.setVisible(true);
        horasTotais.setVisible(true);
        modalidade.setVisible(true);
    }
}
