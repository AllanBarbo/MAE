/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutencaodecursos;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Scanner;

/*
    Grupo:​ ​ MAE.
    Data​ ​ de​ ​ modificação:​ ​ 24/10/2017.
    Autor:​ ​Matheus Quintão Santiago.
    ​Objetivo​ ​ da​ ​ modificação:​ ​ Padronizando o codigo e comentando.
*/
public class ManutencaoDeCursos {

    public static void main(String[] args) throws SQLException {
        
        // Instancia o Banco de Dados.
        BancoDeDados bancoDeDados = new BancoDeDados();
        
        // Dou opcao do usuario deletar, criar ou alterar um curso (primeiro switch).
        System.out.println("Digite 1 para criar, 2 para apagar e 3 para alterar um curso: ");
        Scanner leitor = new Scanner(System.in);
        switch(leitor.nextInt()){
            
            //Primeiro caso cria um curso.
            case 1:
                
                // Recebo o nome do novo curso.
                System.out.println("\n"+"Digite o nome do curso: ");
                String nome = leitor.next();
                
                // Recebo o departamento do novo curso.
                System.out.println("\n"+"Digite o id do departamento do curso: ");
                int idDepto = leitor.nextInt();
                
                // Recebo a quantidade de horas totais do novo curso.
                System.out.println("\n"+"Digite a quantidade de horas total do curso: ");
                int horasTotal = leitor.nextInt();
                
                // Recebo a modalidade do novo curso.
                System.out.println("\n"+"Digite a modalidade do curso: ");
                String modalidade = leitor.next();
                
                // Chamo o metodo criaCurso() da classe BancoDeDados.
                bancoDeDados.criaCurso(idDepto, nome, horasTotal, modalidade);
                break;
            
            // Segundo caso deleta um curso.
            case 2:
                
                // Recebo o id do curso que vai ser deletado.
                System.out.println("\n"+"Digite o id do curso: ");
                int id = leitor.nextInt();
                
                // Chamo o metodo apagaCurso() da classe BancoDeDados.
                bancoDeDados.apagaCurso(id);
                break;
                
            // Terceiro caso altera um curso.
            case 3:
                
                // Recebo o nome do curso para poder selecionar os dados que se quer alterar.
                System.out.println("Digite o nome do curso: ");
                nome = leitor.next();
                
                // Seleciona os registros da tabela cursos onde o nome do curso é igual a que o usuario informou.
                ResultSet resultado = bancoDeDados.selecionarRegistros("cursos", "nome", nome);
                resultado.first();
                
                // Verifica se o curso ja foi apagado.
                if("S".equals(resultado.getString("ativo"))){
                    
                    // Dou opcao do usuario alterar o id, idDepto, nome, quantidade horas totais e modalidade do curso.
                    System.out.println("Digite 1 para alterar o id, 2 para o id do departamento, 3 para o nome do curso, 4 para a quantidade de horas totais e 5 para a modalidade do curso: ");
                    resultado.first();
                    switch(leitor.nextInt()){
                        
                        // Primeiro caso altera o id do curso.
                        case 1:
                            System.out.println("Digite o novo valor: ");
                            bancoDeDados.alteraCurso("id", leitor.nextInt(), resultado.getString("id"));
                            break;
                            
                        // Segundo caso altera o id do departamento do curso.
                        case 2:
                            System.out.println("Digite o novo valor: ");
                            bancoDeDados.alteraCurso("idDepto", leitor.nextInt(), resultado.getString("idDepto"));
                            break;
                            
                        // Terceiro caso altera o nome do curso.
                        case 3:
                            System.out.println("Digite o novo valor: ");
                            bancoDeDados.alteraCurso("nome", leitor.next(), resultado.getString("nome"));
                            break;
                            
                        // Primeiro caso altera as horas totais do curso.
                        case 4:
                            System.out.println("Digite o novo valor: ");
                            bancoDeDados.alteraCurso("horasTotal", leitor.next(), resultado.getString("horasTotal"));
                            break;
                            
                        // Primeiro caso altera a modalidade do curso.
                        case 5:
                            System.out.println("Digite o novo valor: ");
                            bancoDeDados.alteraCurso("modalidade", leitor.next(), resultado.getString("modalidade"));
                            break;
                            
                        // Foi passado um valor diferente desses anteriores.
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
