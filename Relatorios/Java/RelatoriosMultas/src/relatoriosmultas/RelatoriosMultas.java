
package relatoriosmultas;

import java.sql.SQLException;
import java.util.Scanner;

public class RelatoriosMultas {
   
    public static void main(String[] args) throws SQLException {
        BancoDeDados bd = new BancoDeDados();
        Scanner sc = new Scanner(System.in);
        
        System.out.println("\n"+"Digite o nome do aluno: ");
        String idAluno = sc.next();
        
        bd.selecionaPeloIdAluno(idAluno);
        
    }
    
}
