/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutencaodecursos;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Scanner;

/**
 *
 * @author Aluno
 */
public class ManutencaoDeCursos {

    /**
     * @param args the command line arguments
     * @throws java.sql.SQLException
     */
    public static void main(String[] args) throws SQLException {
        // TODO code application logic here
        BancoDeDados bancoDeDados = new BancoDeDados();
        System.out.println("Digite 1 para criar, 2 para apagar e 3 para alterar um curso: ");
        Scanner leitor = new Scanner(System.in);
        switch(leitor.nextInt()){
            case 1:
                System.out.println("\n"+"Digite o nome do curso: ");
                String nome = leitor.next();

                System.out.println("\n"+"Digite o id do departamento do curso: ");
                int idDepto = leitor.nextInt();
                
                System.out.println("\n"+"Digite a quantidade de horas total do curso: ");
                int horasTotal = leitor.nextInt();
                
                System.out.println("\n"+"Digite a modalidade do curso: ");
                String modalidade = leitor.next();
                
                bancoDeDados.criaCurso(idDepto, nome, horasTotal, modalidade);
                break;
            case 2:
                System.out.println("\n"+"Digite o id do curso: ");
                int id = leitor.nextInt();
                
                bancoDeDados.apagaCurso(id);
                break;
                
            case 3:
                
                System.out.println("Digite o nome do curso: ");
                nome = leitor.next();
                ResultSet resultado = bancoDeDados.selecionarRegistros("cursos", "nome", nome);
                resultado.first();
                if("S".equals(resultado.getString("ativo"))){
                    System.out.println("Digite 1 para alterar o id, 2 para o id do curso, 3 para o nome do curso, 4 para a quantidade de horas totais e 5 para a modalidade do curso: ");
                    resultado.first();
                    switch(leitor.nextInt()){
                        case 1:
                            System.out.println("Digite o novo valor: ");
                            bancoDeDados.alteraCurso("id", leitor.nextInt(), resultado.getString("id"));
                            break;
                        case 2:
                            System.out.println("Digite o novo valor: ");
                            bancoDeDados.alteraCurso("idDepto", leitor.nextInt(), resultado.getString("idDepto"));
                            break;
                        case 3:
                            System.out.println("Digite o novo valor: ");
                            bancoDeDados.alteraCurso("nome", leitor.next(), resultado.getString("nome"));
                            break;
                        case 4:
                            System.out.println("Digite o novo valor: ");
                            bancoDeDados.alteraCurso("horasTotal", leitor.next(), resultado.getString("horasTotal"));
                            break;
                        case 5:
                            System.out.println("Digite o novo valor: ");
                            bancoDeDados.alteraCurso("modalidade", leitor.next(), resultado.getString("modalidade"));
                            break;
                        default:
                            System.out.println("Valor invalido.");
                    }
                }
                else
                    System.out.println("O curso ja foi apagada.");
                
                break;
            default:
                System.out.println("Valor invalido.");
        }
        


    }
    
}
