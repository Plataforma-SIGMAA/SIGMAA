"use client";

import Header from "@/components/Header/Header";
import api from "@/lib/api";
import { useApp } from "@/context/AppProvider";
import { useParams } from "next/navigation";
import { useEffect, useState } from "react";
import Swal from "sweetalert2";
import styles from "./page.materia.module.css";
import Link from "next/link";
import { Router } from "next/router";
import { Toast } from "@/components/Toast/Toast";

export default function DisciplinaPage() {
  const { user, authToken } = useApp();
  const { id } = useParams();

  const [disciplina, setDisciplina] = useState(null);

  const fetchDiscipline = async (id) => {
    if (!authToken) return;

    try {
      const response = await api.get(`/auth/disciplina/${id}/${user.id}`, {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      });

      setDisciplina(response.data);
    } catch (error) {
      console.error("Erro ao buscar disciplina:", error);
    }
  };

  useEffect(() => {
    if (!authToken || !id) return;
    fetchDiscipline(id);
  }, [authToken, id]);

  useEffect(() => {
    console.log(disciplina);
  }, [disciplina]);

  useEffect(() => {
    if (!user || user.tipo !== "Estudante") return;

    const temPermissao = user.disciplina_ids?.includes(id);

    if (!temPermissao) {
      Toast.error("Você não tem permissão para acessar esta disciplina.")
        .then(() => {
          Router.push("/home");
        });
    }
  }, [user, id]);



  if (!disciplina)
    return (
      <>
        <Header name={user?.nome} />
        <main style={{ padding: "2rem" }}>Carregando...</main>
      </>
    );

  const {
    disciplina: info,
    plano: plano,
    avaliacoes,
    estudantes,
    notas,
    tarefas,
  } = disciplina;

  return (
    <>
      <Header name={user.nome} />
      <main className={styles.corpo}>
        <div className={styles.conteudoesq}>
          <h1 className={styles.titlemateria}>{info.nome}</h1>
          <div className={styles.diretorios}>
            <Link href={`/participantes/${id}`}>
              <button className={styles.botaodir}>Participantes</button>
            </Link>

            <button
              className={styles.botaodir}
              onClick={() => {
                Swal.fire({
                  title: "Notas",
                  html: `<div style="display: flex; flex-direction: column; align-items: start; text-align: start; gap: 5px;">
                          <div><b>Avaliação: </b>${notas[0]?.avaliacao ?? "(Ainda não foi postada, peça ao seu professor)"}</div>
                          <div><b>Peso: </b>${notas[0]?.peso ?? "(Ainda não foi postado, peça ao seu professor)"}</div>
                          <div><b>Nota Obtida: </b>${notas[0]?.nota_obtida ?? "(Ainda não foi postada, peça ao seu professor)"}</div>
                          <div><b>Recuperação: </b>${notas[0]?.is_recuperacao ?? "(Ainda não foi postada, peça ao seu professor)"}</div>
                         </div>`,
                });
              }}
            >
              Notas
            </button>
            <button
              className={styles.botaodir}
              onClick={() => {
                Swal.fire({
                  title: "Plano de ensino",
                  html: `<div style="display: flex; flex-direction: column; align-items: start; text-align: start; gap: 5px;">
                          <div><b>Modalidade: </b>${plano[0]?.modalidade}</div>
                          <div><b>Horarios: </b>${plano[0]?.horarios}</div>
                          <div><b>Ementa: </b>${plano[0]?.ementa}</div>
                          <div><b>Ano: </b>${plano[0]?.ano}</div>
                          <div><b>Carga Horária: </b>${plano[0]?.carga_horaria}</div>
                          <div><b>Turno: </b>${plano[0]?.turno}</div>
                          <div><b>Objetivo: </b>${plano[0]?.objetivo}</div>
                          <div><b>Metodos Avaliativos: </b>${plano[0]?.metodos_avaliativos}</div>
                          <div><b>Criterios Avaliativos: </b>${plano[0]?.criterios_avaliativos}</div>
                          <div><b>Horario de Atendimento: </b>${plano[0]?.horario_atendimento}</div>
                         </div>`,
                });
              }}
            >
              Plano de Ensino
            </button>
          </div>

          <div className={styles.blocofreq}>
            <h2 className={styles.freq}>Avaliações</h2>
          </div>
          <div className={styles.avaliacoescontainer}>
            <table className={styles.avaliacoes}>
              <thead>
                <tr>
                  <th>Data</th>
                  <th>Disciplina</th>
                  <th>Avaliação</th>
                </tr>
              </thead>
              <tbody>
                {avaliacoes?.map((av, idx) => (
                  <tr key={idx}>
                    <td>{av.data}</td>
                    <td>{av.desc}</td>
                    <td>{av.horario}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
        <div className={styles.conteudodir}>
          <h2 className={styles.titulocont}>Tarefas</h2>
          <div className={styles.listacont}>
            {tarefas?.map((tar) => (
              <div className={styles.aula}>
                <strong>{tar.nome}</strong>
                <p>{tar.data_prazo}</p>
              </div>
            ))}
          </div>
        </div>
      </main>
    </>
  );
}
