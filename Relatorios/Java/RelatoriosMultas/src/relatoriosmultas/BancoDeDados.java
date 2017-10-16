
package relatoriosmultas;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class BancoDeDados {
    private Connection link = null;
    private ResultSet resultado;
   
    public BancoDeDados() throws SQLException{
       try{
            Class.forName("com.mysql.jdbc.Driver");
        }catch (ClassNotFoundException e) {
            System.out.println("Driver não encontrado!"+e);
        }
        System.out.println("Driver encontrado com sucesso!");
        
        
        
        link = (Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");
        if (link != null){
            System.out.println("Conexão realizada com sucesso");
        }else{
            System.out.println("Não foi possível realizar a conexão");
        }  
   }
    
   public void selecionaPeloIdAluno(String nome) throws SQLException{
       Statement comando = link.createStatement();
       String query = "SELECT * FROM alunos WHERE nome=\'"+nome+"\'";
       resultado = comando.executeQuery(query);
       resultado.next();
       query = "SELECT * FROM emprestimos WHERE idAluno=\'"+resultado.getString("idCPF")+"\'";
       resultado = comando.executeQuery(query);
      
       
        //System.out.println("\n"+"Coluna 1: Id do aluno, Coluna 2: Multas" );
        while (resultado.next()) {
           System.out.println("\n"+"Coluna 1: Id do aluno, Coluna 2: Multas" );
           
           String multa = resultado.getString("multa");
           System.out.println(nome + " | " + multa);
         }
   } 
   
    
}
