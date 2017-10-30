







/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package teste3;

import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.application.Application;
import static javafx.application.Application.launch;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.StackPane;
import javafx.stage.Stage;

/**
 *
 * @author Aluno
 */
public class Teste3 extends Application {
    
    private Stage stage;
    private BorderPane borda;
    
    @Override
    public void start(Stage stage){
        
        this.stage = stage;
        try {
            abreBase();
            abreTelaInicial();
        } catch (IOException ex) {
            Logger.getLogger(Teste3.class.getName()).log(Level.SEVERE, null, ex);
        }
        
    }

    
    public void abreCriaTurma() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(Teste3.class.getResource("CriaTurma.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        ManutencaoDeTurmasController controller = loader.getController();
        controller.setMain(this);
    }
    
    public void abreAlteraTurma() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(Teste3.class.getResource("AlteraTurma.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        ManutencaoDeTurmasController controller = loader.getController();
        controller.setMain(this);
    }
    
    public void abreApagaTurma() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(Teste3.class.getResource("ApagaTurma.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        ManutencaoDeTurmasController controller = loader.getController();
        controller.setMain(this);
    }
    
    public void abreBase() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(Teste3.class.getResource("Base.fxml"));
        borda = (BorderPane) loader.load();
        
        Scene cena = new Scene(borda);
        stage.setScene(cena);
        stage.show();
    }
    
    public void abreTelaInicial() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(Teste3.class.getResource("ManutencaoDeTurmas.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        ManutencaoDeTurmasController controller = loader.getController();
        controller.setMain(this);
    }
    
    public static void main(String[] args) {
        launch(args);
    }
    
    
    
}
