"use client";

import { useState, useEffect } from "react";
import { useSearchParams } from "next/navigation";
import api from "@/lib/api";
import Loader from "@/components/Loader/Loader";
import styles from "./page.notas.module.css";

export default function Notas() {
  const [disciplina, setDisciplina] = useState([]);
  const [dados, setDados] = useState([]);
  const [estudantes, setEstudantes] = useState([]);
  const [trimestre_atual, setTrimestreAtual] = useState(1);
  const [carregando, setCarregando] = useState(true);
  const [avaliacoes_trimestre, setAvaliacoesPorTrimestre] = useState({ 1: [], 2: [], 3: [] });
  const [editando, setEditando] = useState(false);
  const [notas_editadas, setNotasEditadas] = useState({});
  
  const searchParams = useSearchParams();
  const id = searchParams.get("id");

  useEffect(() => {
    if (id) buscarNotas();
  }, [id]);

  const extrairAvaliacoesPorTrimestre = (dados) => {
    const avaliacoes = { 1: new Set(), 2: new Set(), 3: new Set() };
    
    dados.forEach(estudante => {
      estudante.trimestres?.forEach(trimestre => {
        const num_trimestre = parseInt(trimestre.numero);
        trimestre.notas?.forEach(nota => {
          avaliacoes[num_trimestre]?.add(nota.avaliacao);
        });
      });
    });
    
    return {
      1: Array.from(avaliacoes[1]),
      2: Array.from(avaliacoes[2]),
      3: Array.from(avaliacoes[3])
    };
  };

  const buscarNotas = async () => {
    setCarregando(true);
    try {
      const resposta = await api.get(`/notas/${id}`);
      const dados_recebidos = resposta.data[0] || [];
      const estudantes_recebidos = resposta.data[1] || [];
      const disciplina_recebida = resposta.data[2] || [];
      
      setDados(dados_recebidos);
      setEstudantes(estudantes_recebidos);
      setDisciplina(disciplina_recebida);

      const avaliacoes = extrairAvaliacoesPorTrimestre(dados_recebidos);
      setAvaliacoesPorTrimestre(avaliacoes);
      
    } catch (erro) {
      console.error("Erro ao buscar:", erro);
    } finally {
      setCarregando(false);
    }
  };

  const getNotaAvaliacao = (estudante_id, nome_avaliacao) => {
    if (editando && notas_editadas[estudante_id]?.[nome_avaliacao] !== undefined) {
      return notas_editadas[estudante_id][nome_avaliacao];
    }
    
    const dados_estudante = dados.find(d => d.estudante_id === estudante_id);
    if (!dados_estudante?.trimestres) return "-";
    
    const trimestre = dados_estudante.trimestres.find(t => t.numero === trimestre_atual.toString());
    if (!trimestre?.notas) return "-";
    
    const avaliacao = trimestre.notas.find(n => n.avaliacao === nome_avaliacao);
    return avaliacao ? avaliacao.nota_obtida.toFixed(1) : "-";
  };

  const calcularNotaFinal = (estudante_id) => {
    const dados_estudante = dados.find(d => d.estudante_id === estudante_id);
    if (!dados_estudante?.trimestres) return 0;

    const trimestre = dados_estudante.trimestres.find(t => t.numero === trimestre_atual.toString());
    if (!trimestre) return 0;

    let soma_ponderada = 0;
    let soma_pesos = 0;

    avaliacoes_atuais.forEach(nome_avaliacao => {
      let peso_avaliacao = 0;
      let nota_avaliacao = 0;

      for (const estudante of dados) {
        const trimestre_ref = estudante.trimestres?.find(t => t.numero === trimestre_atual.toString());
        const avaliacao_ref = trimestre_ref?.notas?.find(n => n.avaliacao === nome_avaliacao);
        if (avaliacao_ref) {
          peso_avaliacao = avaliacao_ref.peso;
          break;
        }
      }

      const avaliacao_aluno = trimestre.notas?.find(n => n.avaliacao === nome_avaliacao);

      if (editando && notas_editadas[estudante_id]?.[nome_avaliacao] !== undefined) {
        nota_avaliacao = parseFloat(notas_editadas[estudante_id][nome_avaliacao]) || 0;
      } else {
        nota_avaliacao = avaliacao_aluno?.nota_obtida || 0;
      }

      soma_ponderada += nota_avaliacao * peso_avaliacao;
      soma_pesos += peso_avaliacao;
    });

    return soma_pesos > 0 ? (soma_ponderada / soma_pesos).toFixed(2) : 0;
  };

  const salvarNotas = async () => {
    try {
      const dados_salvar = [];
      
      Object.keys(notas_editadas).forEach(estudante_id => {
        Object.keys(notas_editadas[estudante_id]).forEach(nome_avaliacao => {
          const nota_valor = notas_editadas[estudante_id][nome_avaliacao];
          if (nota_valor !== "" && nota_valor !== "-") {
            dados_salvar.push({
              estudante_id: parseInt(estudante_id),
              nome_avaliacao,
              nota: parseFloat(nota_valor),
              trimestre: trimestre_atual,
              disciplina_id: id
            });
          }
        });
      });
      
      if (dados_salvar.length > 0) {
        await api.post('/notas/salvar', { notas: dados_salvar });
      }
      
      setEditando(false);
      setNotasEditadas({});
      buscarNotas();
    } catch (erro) {
      console.error("Erro ao salvar:", erro);
    }
  };

  if (carregando) return <Loader />;

  const avaliacoes_atuais = avaliacoes_trimestre[trimestre_atual] || [];

  return (
    <>
    
     <main className={styles.corpo}>
      <div className={styles.menu}>
        <ul>
          <li><span className={`material-symbols-outlined ${styles.icon}`}>menu</span></li>
          <li className={styles.perfil}>
            Perfil 
            <span className={`material-symbols-outlined ${styles.conta}`}>account_circle</span>
            <span className={`material-symbols-outlined ${styles.abaixar}`}>expand_circle_down</span>
          </li>
        </ul>
      </div>
    
      

      <div className={styles.pagina}>
        <div className={styles.headerBar}>
          <h1 className={styles.pageTitle}>{disciplina.nome} - Notas</h1>

          <button
            className={`${styles.botaoEditar} ${editando ? styles.botaoSalvar : ""}`}
            onClick={() => {
              if (editando) salvarNotas();
              else setEditando(true);
            }}
          >
            {editando ? "Salvar Notas" : "Editar Notas"}
          </button>
        </div>

        <div className={styles.contentRow}>
          <div className={styles.card}>
            <div className={styles.cardTop}>
              <div className={styles.tab}>
                {[1, 2, 3].map((num, idx, arr) => {
                  const isFirst = idx === 0;
                  const isLast = idx === arr.length - 1;
                  return (
                    <button
                      key={num}
                      className={[
                        styles.botao,
                        isFirst ? styles.tabFirst : "",
                        isLast ? styles.tabLast : "",
                        trimestre_atual === num ? styles.tabActive : ""
                      ].join(" ").trim()}
                      onClick={() => {
                        if (editando) {
                          if (window.confirm("Alterar trimestre perderá alterações não salvas. Continuar?")) {
                            setEditando(false);
                            setNotasEditadas({});
                            setTrimestreAtual(num);
                          }
                        } else {
                          setTrimestreAtual(num);
                        }
                      }}
                      disabled={editando && trimestre_atual !== num}
                    >
                      {num}º TRIMESTRE
                    </button>
                  );
                })}
              </div>
            </div>

            <div className={styles.cardBody}>
              <div className={styles.conteudoTabela}>
                <table className={styles.tabela}>
                  <thead>
                    <tr>
                      <th className={styles.alunoColuna}>Aluno</th>

                      {avaliacoes_atuais.map((nome_avaliacao, index) => {
                        let peso_encontrado = 0;
                        for (const estudante of dados) {
                          const trimestre = estudante.trimestres?.find(
                            (t) => t.numero === trimestre_atual.toString()
                          );
                          const avaliacao = trimestre?.notas?.find(
                            (n) => n.avaliacao === nome_avaliacao
                          );
                          if (avaliacao) {
                            peso_encontrado = avaliacao.peso;
                            break;
                          }
                        }

                        return (
                          <th key={index} style={{ textAlign: "center" }}>
                            <div>{nome_avaliacao}</div>
                            <div className={styles.pesoText}>Peso: {peso_encontrado}</div>
                          </th>
                        );
                      })}

                      <th className={styles.notaFinalColuna}>Nota Final</th>
                    </tr>
                  </thead>

                  <tbody>
                    {estudantes.length === 0 ? (
                      <tr>
                        <td
                          colSpan={avaliacoes_atuais.length + 2}
                          className={styles.noStudent}
                        >
                          Nenhum estudante encontrado
                        </td>
                      </tr>
                    ) : (
                      estudantes.map((estudante, index) => {
                        const nome = estudante[0];
                        const matricula = estudante[2];
                        const estudante_id = estudante[1];
                        const nota_final = calcularNotaFinal(estudante_id);

                        return (
                          <tr key={index}>
                            <td className={styles.alunoColuna}>
                              <strong>{nome}</strong>
                              <div className={styles.matriculaText}>
                                Matrícula: {matricula}
                              </div>
                            </td>

                            {avaliacoes_atuais.map((nome_avaliacao, idx) => {
                              const nota_atual = getNotaAvaliacao(
                                estudante_id,
                                nome_avaliacao
                              );

                              return (
                                <td key={idx} className={styles.centerCell}>
                                  {editando ? (
                                    <input
                                      type="number"
                                      step="0.1"
                                      min="0"
                                      max="10"
                                      defaultValue={nota_atual !== "-" ? nota_atual : ""}
                                      className={styles.inputNota}
                                      onChange={(e) => {
                                        const novas_notas = { ...notas_editadas };
                                        if (!novas_notas[estudante_id])
                                          novas_notas[estudante_id] = {};
                                        novas_notas[estudante_id][nome_avaliacao] = e.target.value;
                                        setNotasEditadas(novas_notas);
                                      }}
                                    />
                                  ) : (
                                    nota_atual
                                  )}
                                </td>
                              );
                            })}

                            <td className={styles.notaFinalColuna}>{nota_final}</td>
                          </tr>
                        );
                      })
                    )}
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
        </main>
        <footer className={styles.rodape}>
    Desenvolvido por...
  </footer>
    </>
  );
}
